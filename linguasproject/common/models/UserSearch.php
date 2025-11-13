<?php

namespace common\models;
use backend\models\Utilizador;
use common\models\Idioma;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    // Campos da tabela relacionada (Utilizador)
    public $data_nascimento;
    public $numero_telefone;
    public $nacionalidade;
    public $data_inscricao;

    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['data_nascimento', 'nacionalidade', 'numero_telefone','data_inscricao', 'idioma_id', 'user_id'], 'safe'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'safe'],
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
        $query = User::find()
            ->joinWith(['utilizador']); // relação definida em User.php: getUtilizador()

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user.id' => $this->id,
            'user.status' => $this->status,
            'user.created_at' => $this->created_at,
            'user.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'user.email', $this->email])
            ->andFilterWhere(['like', 'user.auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'user.password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'user.password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'user.verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'utilizador.data_inscricao', $this->data_inscricao])
            ->andFilterWhere(['like', 'utilizador.numero_telefone', $this->numero_telefone])
            ->andFilterWhere(['like', 'utilizador.nacionalidade', $this->nacionalidade])
            ->andFilterWhere(['like', 'utilizador.data_nascimento', $this->data_nascimento]);

        return $dataProvider;
    }

}
