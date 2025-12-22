<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resultado".
 *
 * @property int $utilizador_id
 * @property int $aula_idaula
 * @property string|null $data_inicio
 * @property string|null $data_fim
 * @property string $estado
 * @property int|null $nota
 * @property string|null $tempo_estimado
 * @property string|null $data_agendamento
 * @property int|null $respostas_certas
 * @property int|null $respostas_erradas
 *
 * @property Aula $aulaIdaula
 * @property Utilizador $utilizador
 */
class Resultado extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resultado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_inicio', 'data_fim', 'nota', 'tempo_estimado', 'data_agendamento', 'respostas_certas', 'respostas_erradas'], 'default', 'value' => null],
            [['utilizador_id', 'aula_idaula', 'estado'], 'required'],
            [['utilizador_id', 'aula_idaula', 'nota', 'respostas_certas', 'respostas_erradas'], 'integer'],
            [['data_inicio', 'data_fim', 'data_agendamento', 'tempo_estimado'], 'safe'],
            [['estado'], 'string', 'max' => 45],
            [['utilizador_id', 'aula_idaula'], 'unique', 'targetAttribute' => ['utilizador_id', 'aula_idaula']],
            [['aula_idaula'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::class, 'targetAttribute' => ['aula_idaula' => 'id']],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::class, 'targetAttribute' => ['utilizador_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'utilizador_id' => 'Utilizador ID',
            'aula_idaula' => 'Aula Idaula',
            'data_inicio' => 'Data Inicio',
            'data_fim' => 'Data Fim',
            'estado' => 'Estado',
            'nota' => 'Nota',
            'tempo_estimado' => 'Tempo Estimado',
            'data_agendamento' => 'Data Agendamento',
            'respostas_certas' => 'Respostas Certas',
            'respostas_erradas' => 'Respostas Erradas',
        ];
    }

    /**
     * Gets query for [[AulaIdaula]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAulaIdaula()
    {
        return $this->hasOne(Aula::class, ['id' => 'aula_idaula']);
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::class, ['id' => 'utilizador_id']);
    }

}
