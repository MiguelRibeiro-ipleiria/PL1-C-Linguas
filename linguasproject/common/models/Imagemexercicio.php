<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "imagem".
 *
 * @property int $imagem_resource_id
 * @property int $aula_id
 * @property string $pergunta
 * @property int $tipoexercicio_id
 *
 * @property Aula $aula
 * @property ImagemResource $imagemResource
 * @property Tipoexercicio $tipoexercicio
 */
class Imagemexercicio extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagem';
    }

    /**
     * {@inheritdoc}
     */
public function rules()
{
    return [
        [['imagem_resource_id', 'pergunta', 'aula_id', 'tipoexercicio_id'], 'required'], 
        [['imagem_resource_id', 'aula_id', 'tipoexercicio_id'], 'integer'],
        [['pergunta'], 'string', 'max' => 45],
        [['imagem_resource_id', 'aula_id'], 'unique', 'targetAttribute' => ['imagem_resource_id', 'aula_id']],
        [['aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::class, 'targetAttribute' => ['aula_id' => 'id']],
        [['imagem_resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImagemResource::class, 'targetAttribute' => ['imagem_resource_id' => 'id']],
        [['tipoexercicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoexercicio::class, 'targetAttribute' => ['tipoexercicio_id' => 'id']],
    ];
}


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'imagem_resource_id' => 'Imagem Resource ID',
            'aula_id' => 'Aula ID',
            'pergunta' => 'Pergunta',
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
     * Gets query for [[ImagemResource]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagemResource()
    {
        return $this->hasOne(ImagemResource::class, ['id' => 'imagem_resource_id']);
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
