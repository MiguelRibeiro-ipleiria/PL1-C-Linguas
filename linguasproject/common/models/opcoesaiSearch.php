<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\opcoesai;

/**
 * opcoesaiSearch represents the model behind the search form of `common\models\opcoesai`.
 */
class opcoesaiSearch extends opcoesai
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'iscorreta', 'audio_audio_resource_id', 'audio_aula_id', 'imagem_imagem_resource_id', 'imagem_aula_id', 'frase_id'], 'integer'],
            [['descricao'], 'safe'],
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
        $query = opcoesai::find();

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
            'iscorreta' => $this->iscorreta,
            'audio_audio_resource_id' => $this->audio_audio_resource_id,
            'audio_aula_id' => $this->audio_aula_id,
            'imagem_imagem_resource_id' => $this->imagem_imagem_resource_id,
            'imagem_aula_id' => $this->imagem_aula_id,
            'frase_id' => $this->frase_id,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao]);

        return $dataProvider;
    }
}
