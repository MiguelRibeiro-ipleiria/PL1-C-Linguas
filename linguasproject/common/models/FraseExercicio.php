<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "frase".
 *
 * @property int $id
 * @property string $partefrases_1
 * @property string $partefrases_2
 * @property string $resposta
 * @property int $aula_id
 * @property int $tipoexercicio_id
 *
 * @property Aula $aula
 * @property Tipoexercicio $tipoexercicio
 */
class FraseExercicio extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'frase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partefrases_1', 'partefrases_2', 'resposta', 'aula_id', 'tipoexercicio_id'], 'required'],
            [['aula_id', 'tipoexercicio_id'], 'integer'],
            [['partefrases_1', 'partefrases_2'], 'string', 'max' => 100],
            [['resposta'], 'string', 'max' => 60],
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
            'id' => 'ID',
            'partefrases_1' => 'Partefrases 1',
            'partefrases_2' => 'Partefrases 2',
            'resposta' => 'Resposta',
            'aula_id' => 'Aula ID',
            'tipoexercicio_id' => 'Tipoexercicio ID',
        ];
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
