<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Resultado;

/**
 * ResultadoSearch represents the model behind the search form of `common\models\Resultado`.
 */
class ResultadoSearch extends Resultado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['utilizador_id', 'aula_idaula', 'nota', 'tempo_estimado', 'respostas_certas', 'respostas_erradas'], 'integer'],
            [['data_inicio', 'data_fim', 'estado', 'data_agendamento'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Resultado::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'utilizador_id' => $this->utilizador_id,
            'aula_idaula' => $this->aula_idaula,
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            'nota' => $this->nota,
            'tempo_estimado' => $this->tempo_estimado,
            'data_agendamento' => $this->data_agendamento,
            'respostas_certas' => $this->respostas_certas,
            'respostas_erradas' => $this->respostas_erradas,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
