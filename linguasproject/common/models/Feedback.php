<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $assunto_feedback
 * @property string $descricao_feedback
 * @property string $estado_feedback
 * @property string $hora_criada
 * @property int $utilizador_id
 *
 * @property Utilizador $utilizador
 */
class Feedback extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assunto_feedback', 'descricao_feedback', 'hora_criada', 'utilizador_id', 'estado_feedback'], 'required', 'message' => 'Este campo é obrigatório.'],
            [['hora_criada'], 'safe'],
            [['utilizador_id'], 'integer'],
            [['estado_feedback'], 'string', 'max' => 25],
            [['assunto_feedback'], 'string', 'max' => 45],
            [['descricao_feedback'], 'string', 'max' => 500],
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
            'assunto_feedback' => 'Assunto*',
            'descricao_feedback' => 'Mensagem*',
            'hora_criada' => 'Hora Criada',
            'utilizador_id' => 'Autor*',
            'estado_feedback' => 'Estado Feedback',
        ];
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

}
