<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dificuldade".
 *
 * @property int $id
 * @property string $grau_dificuldade
 *
 * @property Curso[] $cursos
 */
class Dificuldade extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dificuldade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grau_dificuldade'], 'required'],
            [['grau_dificuldade'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grau_dificuldade' => 'Grau Dificuldade',
        ];
    }

    /**
     * Gets query for [[Cursos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCursos()
    {
        return $this->hasMany(Curso::class, ['dificuldade_id' => 'id']);
    }

}
