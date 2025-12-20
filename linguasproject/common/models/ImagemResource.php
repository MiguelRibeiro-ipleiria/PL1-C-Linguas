<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "imagem_resource".
 *
 * @property int $id
 * @property string $nome_imagem
 * @property string $nome_ficheiro
 *
 * @property Aula[] $aulas
 * @property Imagem[] $imagems
 */
class ImagemResource extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagem_resource';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_imagem', 'nome_ficheiro'], 'default', 'value' => null],
            [['nome_imagem'], 'string', 'max' => 45],
            [['nome_ficheiro'], 'file', 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => true]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome_imagem' => 'Nome Imagem',
            'nome_ficheiro' => 'Nome Ficheiro',
        ];
    }

    /**
     * Gets query for [[Aulas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::class, ['id' => 'aula_id'])->viaTable('imagem', ['imagem_resource_id' => 'id']);
    }

    /**
     * Gets query for [[Imagems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagem::class, ['imagem_resource_id' => 'id']);
    }
    
     public function upload()
    {
        if ($this->nome_ficheiro) {

        $fileName = $this->nome_ficheiro->baseName . '.' . $this->nome_ficheiro->extension;

        $this->nome_ficheiro->saveAs(Yii::getAlias('@common/uploadImage/') . $fileName);


         $this->nome_ficheiro = $fileName;

            return true;
        } else {
            return false;
        }
    }

}
