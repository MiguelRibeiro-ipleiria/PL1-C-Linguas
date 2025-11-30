<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "idioma".
 *
 * @property int $id
 * @property string $lingua_descricao
 * @property string $lingua_sigla
 * @property string $lingua_bandeira
 * @property string $data_criacao
 * @property string $lingua_objetivo
 *
 * @property Curso[] $cursos
 * @property Utilizador[] $utilizadors
 */
class Idioma extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'idioma';
    }


    /**
     * {@inheritdoc}
     */ 
    public function rules()
    {
return [
    [['lingua_descricao', 'lingua_sigla', 'data_criacao', 'lingua_objetivo'], 'required'],
    [['data_criacao'], 'safe'],
    [['lingua_descricao'], 'string', 'max' => 45],
    [['lingua_sigla'], 'string', 'max' => 5],
    [['lingua_bandeira'], 'file', 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => true],
    [['lingua_objetivo'], 'string', 'max' => 150],
];

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lingua_descricao' => 'Lingua Descricao',
            'lingua_sigla' => 'Lingua Sigla',
            'lingua_bandeira' => 'Lingua Bandeira',
            'data_criacao' => 'Data Criacao',
            'lingua_objetivo' => 'Lingua Objetivo',
        ];
    }


    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::class, ['idioma_id' => 'id']);
    }

    /**
     * Gets query for [[Utilizadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors()
    {
        return $this->hasMany(Utilizador::class, ['idioma_id' => 'id']);
    }

    public function upload()
    {
        if ($this->lingua_bandeira) {

        $fileName = $this->lingua_bandeira->baseName . '.' . $this->lingua_bandeira->extension;

        $this->lingua_bandeira->saveAs(Yii::getAlias('@common/UploadBandeiras/') . $fileName);


         $this->lingua_bandeira = $fileName;

            return true;
        } else {
            return false;
        }
    }

}
