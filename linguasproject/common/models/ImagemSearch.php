<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Imagem;

/**
 * ImagemSearch represents the model behind the search form of `common\models\Imagem`.
 */
class ImagemSearch extends Imagem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imagem_resource_id', 'aula_id', 'tipoexercicio_id'], 'integer'],
            [['pergunta'], 'safe'],
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
        $query = Imagem::find();

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
            'imagem_resource_id' => $this->imagem_resource_id,
            'aula_id' => $this->aula_id,
            'tipoexercicio_id' => $this->tipoexercicio_id,
        ]);

        $query->andFilterWhere(['like', 'pergunta', $this->pergunta]);

        return $dataProvider;
    }
}
