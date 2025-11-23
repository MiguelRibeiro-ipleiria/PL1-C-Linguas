<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property int $id
 * @property int $idioma_id
 * @property int $dificuldade_id
 * @property string $titulo_curso
 * @property int $status_ativo
 * @property string $data_criacao
 *
 * @property Aula[] $aulas
 * @property Dificuldade $dificuldade
 * @property Idioma $idioma
 * @property Inscricao[] $inscricaos
 * @property Utilizador[] $utilizadors
 */
class Curso extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idioma_id', 'dificuldade_id', 'titulo_curso', 'status_ativo', 'data_criacao'], 'required'],
            [['idioma_id', 'dificuldade_id', 'status_ativo'], 'integer'],
            [['data_criacao'], 'safe'],
            [['titulo_curso'], 'string', 'max' => 70],
            [['dificuldade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dificuldade::class, 'targetAttribute' => ['dificuldade_id' => 'id']],
            [['idioma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Idioma::class, 'targetAttribute' => ['idioma_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idioma_id' => 'Idioma ID',
            'dificuldade_id' => 'Dificuldade ID',
            'titulo_curso' => 'Titulo Curso',
            'status_ativo' => 'Status Ativo',
            'data_criacao' => 'Data Criacao',
        ];
    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::class, ['curso_id' => 'id']);
    }

    /**
     * Gets query for [[Dificuldade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDificuldade()
    {
        return $this->hasOne(Dificuldade::class, ['id' => 'dificuldade_id']);
    }

    /**
     * Gets query for [[Idioma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdioma()
    {
        return $this->hasOne(Idioma::class, ['id' => 'idioma_id']);
    }

    /**
     * Gets query for [[Inscricaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInscricaos()
    {
        return $this->hasMany(Inscricao::class, ['curso_idcurso' => 'id']);
    }

    /**
     * Gets query for [[Utilizadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors()
    {
        return $this->hasMany(Utilizador::class, ['id' => 'utilizador_id'])->viaTable('inscricao', ['curso_idcurso' => 'id']);
    }

}
