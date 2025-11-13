<?php

namespace common\models;
use common\models\User;
use backend\models\Utilizador;
use Yii;

/**
 * This is the model class for table "idioma".
 *
 * @property int $id
 * @property string $lingua_descricao
 * @property string $lingua_sigla
 * @property string $lingua_bandeira
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
            [['lingua_descricao', 'lingua_sigla', 'lingua_bandeira'], 'required'],
            [['lingua_descricao'], 'string', 'max' => 45],
            [['lingua_sigla'], 'string', 'max' => 5],
            [['lingua_bandeira'], 'string', 'max' => 100],
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

}
