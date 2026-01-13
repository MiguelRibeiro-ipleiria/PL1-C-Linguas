<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Aula;
use common\models\Inscricao;
use common\models\User;
use common\models\Curso;
use common\models\Utilizador;
use yii\rest\ActiveController;
use Yii;

/**
 * Default controller for the `api` module
 */
class InscricaoController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Inscricao';

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
            //'except' => ['index', 'view'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
        ];

        return $behaviors;
    }


    public function checkAccess($action, $model = null, $params = [])
    {

        if ($action === 'view') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id ){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões ver as inscricoes deste utilizador');
            }
        }
        elseif ($action === 'update') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id || $model->user_id == null){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões alterar dados de inscricoes deste utilizador');
            }
        }
        elseif ($action === 'create') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id || $model->user_id == null){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões para criar uma inscricão para este utilizador');
            }
        }
        elseif ($action === 'delete') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id || $model->user_id == null){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões eliminar inscricoes deste utilizador');
            }
        }

    }

    public function actionCountporuser($utilizador_id)
    {
        $InscricaoModel = new $this->modelClass;
        $utilizador = Utilizador::find()->where(['id' => $utilizador_id])->one();
        $this->checkAccess('view', $utilizador);

        if($utilizador == null){
            return "Utilizador não encontrado!";
        }
        else{
            $inscricoes = $InscricaoModel::find()->where(['utilizador_id' => $utilizador->id])->all();
            return ['count' => count($inscricoes)];
        }

    }

    public function actionInscricoesporuser($utilizador_id)
    {
        $InscricaoModel = new $this->modelClass;
        $utilizador = Utilizador::find()->where(['id' => $utilizador_id])->one();
        $this->checkAccess('view', $utilizador);

        if($utilizador == null){
            return "Utilizador não encontrado!";
        }
        else{
            $inscricoes = $InscricaoModel::find()->where(['utilizador_id' => $utilizador->id])->all();
            return $inscricoes;
        }
    }


    public function actionNovainscricao(){

        $Inscricaomodel = new $this->modelClass;
        $curso_id = \Yii::$app->request->post('curso_idcurso');
        $utilizador_id = \Yii::$app->request->post('utilizador_id');

        $utilizador = Utilizador::findOne(['id' => $utilizador_id]);
        $this->checkAccess('create', $utilizador);

        if ($Inscricaomodel::verificainscricao($curso_id, $utilizador_id)) {
            return false;
        }
        else{

            $Inscricaomodel->utilizador_id = \Yii::$app->request->post('utilizador_id');
            $Inscricaomodel->curso_idcurso = \Yii::$app->request->post('curso_idcurso');
            $Inscricaomodel->data_inscricao = \Yii::$app->request->post('data_inscricao');
            $Inscricaomodel->progresso = \Yii::$app->request->post('progresso');
            $Inscricaomodel->estado = \Yii::$app->request->post('estado');

            if($Inscricaomodel->save()){
                if($Inscricaomodel::inscricaonasaulas($curso_id, $utilizador_id)){
                    return $Inscricaomodel;
                }
                else{
                    return "Erro a inscrever nos resultados";
                }
            }
            else{
                return "Erro a submeter o inscrição";
            }

        }

    }

    public function actionDelinscricaoporid($curso_idcurso, $utilizador_id){

        $Inscricaomodel = new $this->modelClass;
        $utilizador = Utilizador::findOne(['id' => $utilizador_id]);
        $this->checkAccess('delete', $utilizador);

        if ($Inscricaomodel::verificainscricao($curso_idcurso, $utilizador_id)) {

            $inscricao = Inscricao::find()->where(['curso_idcurso' => $curso_idcurso, 'utilizador_id' => $utilizador_id])->one();
            if(Inscricao::desinscricaonasaulas($curso_idcurso, $utilizador_id)){
                $deleted = $inscricao->delete();
                return $deleted;
            }
        }
        else{
            return false;
        }

    }

    public function actionPutdadosporcursoeutilizador($curso_idcurso, $utilizador_id){

        $Inscricaomodel = new $this->modelClass;
        $utilizador = Utilizador::findOne(['id' => $utilizador_id]);
        $this->checkAccess('update', $utilizador);

        $inscricao = $Inscricaomodel::find()->where(['curso_idcurso' => $curso_idcurso, 'utilizador_id' => $utilizador_id])->one();

        if($inscricao){
            $novo_progresso =\Yii::$app->request->post('progresso');
            $novo_estado =\Yii::$app->request->post('estado');

            if($novo_progresso != null){
                $inscricao->progresso = $novo_progresso;
            }

            if($novo_estado != null){
                $inscricao->estado = $novo_estado;
            }

            if($inscricao->save()){
                return "Inscrição atualizado com sucesso";
            }
            else{
                return "Erro ao atualizar a inscrição";
            }

        }
        else{
            throw new \yii\web\NotFoundHttpException("Inscrição não encontrada");
        }

    }


}
