<?php

namespace backend\modules\api\controllers;

use common\models\Inscricao;
use common\models\Resultado;
use common\models\User;
use common\models\Utilizador;
use yii\rest\ActiveController;
use Yii;
use backend\modules\api\components\CustomAuth;
/**
 * Default controller for the `api` module
 */
class UtilizadorController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Utilizador';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
            'except' => ['index', 'view'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {

        if ($action === 'view') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id ){
                throw new \yii\web\ForbiddenHttpException('Não tem permissão para ver os dados deste utilizador');
            }
        }
        elseif ($action === 'update') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id || $model->user_id == null){
                throw new \yii\web\ForbiddenHttpException('Não tem permissão para alterar os dados deste utilizador');
            }
        }

    }

    public function actionPerfilutilizador($id){

        $utilizadorModel = new $this->modelClass;

        $utilizador = $utilizadorModel::find()
            ->where(['id' => $id])
            ->with(['user', 'idioma'])
            ->one();

        if(!$utilizador){
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
        }
        else{
            $this->checkAccess('view', $utilizador);
        }

        $resultado = [
            'id' => $utilizador['id'],
            'data_nascimento' => $utilizador['data_nascimento'],
            'numero_telefone' => $utilizador['numero_telefone'],
            'nacionalidade' => $utilizador['nacionalidade'],
            'data_inscricao' => $utilizador['data_inscricao'],
            'email' => $utilizador['user']['email'] ?? null,
            'username' => $utilizador['user']['username'] ?? null,
            'idioma'=> $utilizador['idioma']['lingua_descricao'] ?? null,
        ];

        return $resultado;


    }


    public function actionCountcursosinscritos($id){

        $utilizadorModel = new $this->modelClass;
        $utilizador = $utilizadorModel::findOne(['id' => $id]);
        $this->checkAccess('view', $utilizador);


        if($utilizador)
        {

            $inscrito_count = Inscricao::find()->where(['utilizador_id' => $utilizador->id])->count();
            if($inscrito_count != null){
                return $inscrito_count;
            }
            else{
                $inscrito_count = 0;
                return $inscrito_count;
            }

        }
        else
        {
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
        }

    }

    public function actionCountaulasterminadas($id){

        $utilizadorModel = new $this->modelClass;
        $utilizador = $utilizadorModel::findOne(['id' => $id]);
        $this->checkAccess('view', $utilizador);

        if($utilizador)
        {

            $aulas_concluidas_count = Resultado::find()->where(['utilizador_id' => $utilizador->id, 'estado' => "Terminada"])->count();
            if($aulas_concluidas_count != null){
                return $aulas_concluidas_count;
            }
            else{
                $aulas_concluidas_count = 0;
                return $aulas_concluidas_count;
            }

        }
        else
        {
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
        }

    }

    public function actionCountprogresso($id){

        $utilizadorModel = new $this->modelClass;
        $utilizador = $utilizadorModel::findOne(['id' => $id]);
        $this->checkAccess('view', $utilizador);

        if($utilizador)
        {

            $cursos_totais_count = Inscricao::find()->where(['utilizador_id' => $utilizador->id])->count();
            if($cursos_totais_count){
                $cursos_concluidos_count = Inscricao::find()->where(['utilizador_id' => $utilizador->id, 'estado' => "Concluído"])->count();

                $perc_total = (int)(($cursos_concluidos_count / $cursos_totais_count) * 100);

                return $perc_total."%";
            }
            else{
                return "0%";
            }

        }
        else
        {
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
        }

    }


    public function actionPutdadosporid($id){

        $utilizadorModel = new $this->modelClass;
        $utilizador = $utilizadorModel::findOne(['id' => $id]);
        $this->checkAccess('update', $utilizador);

        $nova_nacionalidade =\Yii::$app->request->post('nacionalidade');
        $novo_telefone =\Yii::$app->request->post('numero_telefone');
        $nova_data_nascimento =\Yii::$app->request->post('data_nascimento');

        if($utilizador)
        {

            if($nova_nacionalidade != null){
                $utilizador->nacionalidade = $nova_nacionalidade;
            }

            if($novo_telefone != null){
                $utilizador->numero_telefone = $novo_telefone;
            }

            if($nova_data_nascimento != null){
                $utilizador->data_nascimento = $nova_data_nascimento;
            }

            if($utilizador->save()){
                return "Utilizador atualizado com sucesso";

            }
            else{
                return "Erro ao atualizar o Utilizador";

            }
        }
        else
        {
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
        }

    }


}
