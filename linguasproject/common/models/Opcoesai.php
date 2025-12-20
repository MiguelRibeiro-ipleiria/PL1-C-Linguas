<?php

namespace common\models;
use common\models\FraseExercicio;

use Yii;

/**
 * This is the model class for table "opcoesai".
 *
 * @property int $id
 * @property int $iscorreta
 * @property string $descricao
 * @property int|null $audio_audio_resource_id
 * @property int|null $audio_aula_id
 * @property int|null $imagem_imagem_resource_id
 * @property int|null $imagem_aula_id
 * @property int|null $frase_id
 *
 * @property Audio $audioAudioResource
 * @property Frase $frase
 * @property Imagem $imagemImagemResource
 */
class Opcoesai extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opcoesai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iscorreta', 'audio_audio_resource_id', 'audio_aula_id', 'imagem_imagem_resource_id', 'imagem_aula_id', 'frase_id'], 'default', 'value' => null],
            [['iscorreta', 'audio_audio_resource_id', 'audio_aula_id', 'imagem_imagem_resource_id', 'imagem_aula_id', 'frase_id'], 'integer'],
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45],
            [['frase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Frase::class, 'targetAttribute' => ['frase_id' => 'id']],
            [['audio_audio_resource_id', 'audio_aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Audio::class, 'targetAttribute' => ['audio_audio_resource_id' => 'audio_resource_id', 'audio_aula_id' => 'aula_id']],
            [['imagem_imagem_resource_id', 'imagem_aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Imagem::class, 'targetAttribute' => ['imagem_imagem_resource_id' => 'imagem_resource_id', 'imagem_aula_id' => 'aula_id']],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iscorreta' => 'Iscorreta',
            'descricao' => 'Descricao',
            'audio_audio_resource_id' => 'Audio Audio Resource ID',
            'audio_aula_id' => 'Audio Aula ID',
            'imagem_imagem_resource_id' => 'Imagem Imagem Resource ID',
            'imagem_aula_id' => 'Imagem Aula ID',
            'frase_id' => 'Frase ID',
        ];
    }

    /**
     * Gets query for [[AudioAudioResource]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudioAudioResource()
    {
        return $this->hasOne(Audio::class, ['audio_resource_id' => 'audio_audio_resource_id', 'aula_id' => 'audio_aula_id']);
    }

    /**
     * Gets query for [[Frase]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrase()
    {
        return $this->hasOne(Frase::class, ['id' => 'frase_id']);
    }

    /**
     * Gets query for [[ImagemImagemResource]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagemImagemResource()
    {
        return $this->hasOne(ImagemResource::class, ['imagem_resource_id' => 'imagem_imagem_resource_id', 'aula_id' => 'imagem_aula_id']);
    }

}
