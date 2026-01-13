<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comentario;

/**
 * comentarioSearch represents the model behind the search form of `common\models\comentario`.
 */
class ComentarioSearch extends Comentario
{
    /**
     * {@inheritdoc}
     */


    public function rules()
    {
        return [
            [['id', 'aula_id', 'utilizador_id'], 'integer'],
            [['descricao_comentario', 'hora_criada'], 'safe'],
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
        $query = Comentario::find();


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
            'hora_criada' => $this->hora_criada,
            'utilizador_id' => $this->utilizador_id,
        ]);

        $query->andFilterWhere(['like', 'descricao_comentario', $this->descricao_comentario]);

        return $dataProvider;
    }
}
