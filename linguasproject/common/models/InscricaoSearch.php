<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Inscricao;

/**
 * InscricaoSearch represents the model behind the search form of `common\models\Inscricao`.
 */
class InscricaoSearch extends Inscricao
{
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['utilizador_id', 'curso_idcurso', 'progresso'], 'integer'],
            [['data_inscricao', 'estado'], 'safe'],
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
        $query = Inscricao::find();

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
            'curso_idcurso' => $this->curso_idcurso,
            'progresso' => $this->progresso,
        ]);

        $query->andFilterWhere(['like', 'data_inscricao', $this->data_inscricao])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
