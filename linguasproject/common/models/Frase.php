<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "frase".
 *
 * @property int $id
 * @property string|null $partefrases_1
 * @property string|null $partefrases_2
 * @property int $aula_id
 * @property int $tipoexercicio_id
 *
 * @property Aula $aula
 * @property Opcoesai[] $opcoesais
 * @property Tipoexercicio $tipoexercicio
 */
class Frase extends \yii\db\ActiveRecord
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
            [['partefrases_1', 'partefrases_2'], 'default', 'value' => null],
            [['aula_id', 'tipoexercicio_id'], 'required'],
            [['aula_id', 'tipoexercicio_id'], 'integer'],
            [['partefrases_1', 'partefrases_2'], 'string', 'max' => 100],
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
     * Gets query for [[Opcoesais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpcoesais()
    {
        return $this->hasMany(Opcoesai::class, ['frase_id' => 'id']);
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

    /**
     * Gets query for [[Opcoesais]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpcoesais()
    {
        return $this->hasMany(Opcoesai::class, ['frase_id' => 'id']);
    }

}
