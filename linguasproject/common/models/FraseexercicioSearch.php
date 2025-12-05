<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Fraseexercicio;

/**
 * FraseexercicioSearch represents the model behind the search form of `common\models\Fraseexercicio`.
 */
class FraseexercicioSearch extends Fraseexercicio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'aula_id', 'tipoexercicio_id'], 'integer'],
            [['partefrases_1', 'partefrases_2', 'resposta'], 'safe'],
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
        $query = Fraseexercicio::find();

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
            'aula_id' => $this->aula_id,
            'tipoexercicio_id' => $this->tipoexercicio_id,
        ]);

        $query->andFilterWhere(['like', 'partefrases_1', $this->partefrases_1])
            ->andFilterWhere(['like', 'partefrases_2', $this->partefrases_2]);

        return $dataProvider;
    }
}
