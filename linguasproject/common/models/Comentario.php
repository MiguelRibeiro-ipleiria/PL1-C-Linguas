<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id
 * @property string $descricao_comentario
 * @property int $aula_id
 * @property string $hora_criada
 * @property int $utilizador_id
 *
 * @property Aula $aula
 * @property Utilizador $utilizador
 */
class Comentario extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao_comentario', 'aula_id', 'hora_criada', 'utilizador_id'], 'required'],
            [['aula_id', 'utilizador_id'], 'integer'],
            [['hora_criada'], 'safe'],
            [['descricao_comentario'], 'string', 'max' => 45],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::class, 'targetAttribute' => ['aula_id' => 'id']],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::class, 'targetAttribute' => ['utilizador_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao_comentario' => 'Comentário*',
            'aula_id' => 'Aula ID',
            'hora_criada' => 'Hora Criada',
            'utilizador_id' => 'Utilizador ID',
        ];
    }

    /**
     * Gets query for [[Aula]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAula()
    {
        return $this->hasOne(Aula::class, ['id' => 'aula_id']);
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::class, ['id' => 'utilizador_id']);
    }

    public function setDataCriacao()
    {
        $hora = date('y-m-d H:i:s');
        return $this->hora_criada = $hora;
    }

    public function setUtilizador()
    {
        $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->identity->getId()])->one();
        return $this->utilizador_id = $utilizador->id;
    }


}
