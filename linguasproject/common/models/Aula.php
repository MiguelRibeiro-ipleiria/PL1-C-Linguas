<?php

namespace common\models;
use common\models\Fraseexercicio;
use Yii;

/**
 * This is the model class for table "aula".
 *
 * @property int $id
 * @property string $titulo_aula
 * @property string $descricao_aula
 * @property int $numero_de_exercicios
 * @property string $tempo_estimado
 * @property int $curso_id
 * @property string $data_criacao
 *
 * @property AudioResource[] $audioResources
 * @property Audioexercicio[] $audios
 * @property Curso $curso
 * @property Frase[] $frases
 * @property ImagemResource[] $imagemResources
 * @property Imagemexercicio[] $imagems
 */
class Aula extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo_aula', 'descricao_aula', 'numero_de_exercicios', 'tempo_estimado', 'curso_id', 'data_criacao'], 'required'],
            [['numero_de_exercicios', 'curso_id'], 'integer'],
            [['titulo_aula'], 'string', 'max' => 50],
            [['descricao_aula'], 'string', 'max' => 80],
            [['tempo_estimado'], 'string', 'max' => 25],
            [['data_criacao'], 'string', 'max' => 45],
            [['curso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Curso::class, 'targetAttribute' => ['curso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo_aula' => 'Titulo Aula',
            'descricao_aula' => 'Descricao Aula',
            'numero_de_exercicios' => 'Numero De Exercicios',
            'tempo_estimado' => 'Tempo Estimado',
            'curso_id' => 'Curso',
            'data_criacao' => 'Data Criacao',
        ];
    }

    /**
     * Gets query for [[AudioResources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudioResources()
    {
        return $this->hasMany(AudioResource::class, ['id' => 'audio_resource_id'])->viaTable('audio', ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Audios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudios()
    {
        return $this->hasMany(Audioexercicio::class, ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Curso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::class, ['id' => 'curso_id']);
    }

    /**
     * Gets query for [[Frases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrases()
    {
        return $this->hasMany(Fraseexercicio::class, ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[ImagemResources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagemResources()
    {
        return $this->hasMany(ImagemResource::class, ['id' => 'imagem_resource_id'])->viaTable('imagem', ['aula_id' => 'id']);
    }

    /**
     * Gets query for [[Imagems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagemexercicio::class, ['aula_id' => 'id']);
    }

    public function setDataCriacao()
    {
        $hora = date('y-m-d H:i:s');
        return $this->data_criacao = $hora;
    }

    public function getCountImageExercicios($id)
    {
        $count = Imagemexercicio::find()->where(['aula_id' => $id])->count();
        return $count;
    }

    public function getCountAudioExercicios($id)
    {
        $count = Audioexercicio::find()->where(['aula_id' => $id])->count();
        return $count;
    }

    public function getCountFraseExercicios($id)
    {
        $count = Fraseexercicio::find()->where(['aula_id' => $id])->count();
        return $count;
    }

    public function getCountComments($id)
    {
        $count = Comentario::find()->where(['aula_id' => $id])->count();
        return $count;
    }
    public function getComments($id)
    {
        $comentarios = Comentario::find()->where(['aula_id' => $id]);
        return $comentarios;
    }

}
