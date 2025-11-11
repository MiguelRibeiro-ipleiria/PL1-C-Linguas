<?php

namespace backend\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $idutilizador
 * @property string|null $data_nascimento
 * @property int|null $numero_telefone
 * @property string $nacionalidade
 * @property string $data_inscricao
 * @property int|null $iduser
 *
 * @property Aula[] $aulas
 * @property Comentario[] $comentarios
 * @property Curso[] $cursos
 * @property Feedback[] $feedbacks
 * @property User $iduser0
 * @property Inscricao[] $inscricaos
 * @property Resultado[] $resultados
 */
class Utilizador extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_nascimento', 'numero_telefone', 'iduser'], 'default', 'value' => null],
            [['idutilizador', 'nacionalidade', 'data_inscricao'], 'required'],
            [['idutilizador', 'numero_telefone', 'iduser'], 'integer'],
            [['data_nascimento', 'data_inscricao'], 'safe'],
            [['nacionalidade'], 'string', 'max' => 25],
            [['iduser'], 'unique'],
            [['idutilizador'], 'unique'],
            [['iduser'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['iduser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idutilizador' => 'Idutilizador',
            'data_nascimento' => 'Data Nascimento',
            'numero_telefone' => 'Numero Telefone',
            'nacionalidade' => 'Nacionalidade',
            'data_inscricao' => 'Data Inscricao',
            'iduser' => 'Iduser',
        ];
    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::class, ['idaula' => 'aula_id'])->viaTable('resultado', ['utilizador_id' => 'idutilizador']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['utilizador_id' => 'idutilizador']);
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::class, ['idcurso' => 'curso_id'])->viaTable('inscricao', ['utilizador_id' => 'idutilizador']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, ['utilizador_id' => 'idutilizador']);
    }

    /**
     * Gets query for [[Iduser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIduser0()
    {
        return $this->hasOne(User::class, ['id' => 'iduser']);
    }

    /**
     * Gets query for [[Inscricaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscricaos()
    {
        return $this->hasMany(Inscricao::class, ['utilizador_id' => 'idutilizador']);
    }

    /**
     * Gets query for [[Resultados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResultados()
    {
        return $this->hasMany(Resultado::class, ['utilizador_id' => 'idutilizador']);
    }

}
