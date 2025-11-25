<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoexercicio".
 *
 * @property int $id
 * @property string $descricao
 *
 * @property Audio[] $audios
 * @property Frase[] $frases
 * @property Imagem[] $imagems
 */
class Tipoexercicio extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoexercicio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * Gets query for [[Audios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAudios()
    {
        return $this->hasMany(Audio::class, ['tipoexercicio_id' => 'id']);
    }

    /**
     * Gets query for [[Frases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrases()
    {
        return $this->hasMany(Frase::class, ['tipoexercicio_id' => 'id']);
    }

    /**
     * Gets query for [[Imagems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagem::class, ['tipoexercicio_id' => 'id']);
    }

}
