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
            [['nome_ficheiro'], 'string', 'max' => 100],
            [['ficheiro'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif'],

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

}
