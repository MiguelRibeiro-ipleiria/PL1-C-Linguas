<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Aula;

/**
 * aulaSearch represents the model behind the search form of `common\models\aula`.
 */
class AulaSearch extends Aula
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'numero_de_exercicios', 'curso_id'], 'integer'],
            [['titulo_aula', 'descricao_aula', 'tempo_estimado', 'data_criacao'], 'safe'],
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
        $query = aula::find();

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
            'id' => $this->id,
            'numero_de_exercicios' => $this->numero_de_exercicios,
            'curso_id' => $this->curso_id,
        ]);

        $query->andFilterWhere(['like', 'titulo_aula', $this->titulo_aula])
            ->andFilterWhere(['like', 'descricao_aula', $this->descricao_aula])
            ->andFilterWhere(['like', 'tempo_estimado', $this->tempo_estimado])
            ->andFilterWhere(['like', 'data_criacao', $this->data_criacao]);

        return $dataProvider;
    }
}
