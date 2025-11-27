<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "imagem_resource".
 *
 * @property int $idimagem
 * @property string|null $nome_imagem
 * @property string|null $nome_ficheiro
 */
class ImagemResource extends \yii\db\ActiveRecord
{

    public $ficheiro;
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
            'idimagem' => 'Idimagem',
            'nome_imagem' => 'Nome Imagem',
            'nome_ficheiro' => 'Nome Ficheiro',
        ];
    }

    public function upload()
    {
        if ($this->nome_ficheiro) {

        $fileName = $this->nome_ficheiro->baseName . '.' . $this->nome_ficheiro->extension;

        $this->nome_ficheiro->saveAs(Yii::getAlias('@backend/web/uploadImage/') . $fileName);


         $this->nome_ficheiro = $fileName;

            return true;
        } else {
            return false;
        }
    }

}
