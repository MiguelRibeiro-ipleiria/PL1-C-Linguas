<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "audio_resource".
 *
 * @property int $id
 * @property string $nome_audio
 * @property string $nome_ficheiro
 *
 * @property Audio[] $audios
 * @property Aula[] $aulas
 */
class AudioResource extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'audio_resource';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_audio', 'nome_ficheiro'], 'required'],
            [['nome_audio'], 'string', 'max' => 50],
            [['nome_ficheiro'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_audio' => 'Nome Audio',
            'nome_ficheiro' => 'Nome Ficheiro',
        ];
    }

    /**
     * Gets query for [[Audios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudios()
    {
        return $this->hasMany(Audio::class, ['audio_resource_id' => 'id']);
    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::class, ['id' => 'aula_id'])->viaTable('audio', ['audio_resource_id' => 'id']);
    }

     public function upload()
    {
        if ($this->nome_ficheiro) {

        $fileName = $this->nome_ficheiro->baseName . '.' . $this->nome_ficheiro->extension;

        $this->nome_ficheiro->saveAs(Yii::getAlias('@backend/web/uploads/uploadAudio/') . $fileName);


         $this->nome_ficheiro = $fileName;

            return true;
        } else {
            return false;
        }
    }

}
