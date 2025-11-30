<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "audio".
 *
 * @property int $audio_resource_id
 * @property int $aula_id
 * @property string $pergunta
 * @property int $tipoexercicio_id
 *
 * @property AudioResource $audioResource
 * @property Aula $aula
 * @property Tipoexercicio $tipoexercicio
 */
class AudioExercicio extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'audio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['audio_resource_id', 'aula_id', 'pergunta', 'tipoexercicio_id'], 'required'],
            [['audio_resource_id', 'aula_id', 'tipoexercicio_id'], 'integer'],
            [['pergunta'], 'string', 'max' => 80],
            [['audio_resource_id', 'aula_id'], 'unique', 'targetAttribute' => ['audio_resource_id', 'aula_id']],
            [['audio_resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => AudioResource::class, 'targetAttribute' => ['audio_resource_id' => 'id']],
            [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::class, 'targetAttribute' => ['aula_id' => 'id']],
            [['tipoexercicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoexercicio::class, 'targetAttribute' => ['tipoexercicio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'audio_resource_id' => 'Audio Resource ID',
            'aula_id' => 'Aula ID',
            'pergunta' => 'Pergunta',
            'tipoexercicio_id' => 'Tipoexercicio ID',
        ];
    }

    /**
     * Gets query for [[AudioResource]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudioResource()
    {
        return $this->hasOne(AudioResource::class, ['id' => 'audio_resource_id']);
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
     * Gets query for [[Tipoexercicio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoexercicio()
    {
        return $this->hasOne(Tipoexercicio::class, ['id' => 'tipoexercicio_id']);
    }

}
