<?php

namespace backend\modules\api\controllers;

use common\models\Aula;
use common\models\Comentario;
use common\models\Utilizador;
use yii\rest\ActiveController;
use Yii;
use backend\modules\api\components\CustomAuth;
/**
 * Default controller for the `api` module
 */
class ComentarioController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Comentario';

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

        if ($action === 'delete') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id || $model->user_id == null){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões eliminar comentários deste utilizador');
            }
        }
        elseif ($action === 'create') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id || $model->user_id == null){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões para criar um comentário para este utilizador');
            }
        }

    }

    public function actionGetcomentarioporaula($aula_id)
    {
        $aula = Aula::findOne($aula_id);

        if (!$aula) {
            throw new NotFoundHttpException('A aula não existe');
        }

        $comentarios = $this->modelClass::find()
            ->where(['aula_id' => $aula_id])
            ->with(['utilizador.user'])
            ->all();

        $comentariosDaAula = [];

        foreach ($comentarios as $c) {
            $comentariosDaAula[] = [
                'id' => $c->id,
                'descricao_comentario' => $c->descricao_comentario,
                'aula_id' => $c->aula_id,
                'hora_criada' => $c->hora_criada,
                'utilizador' => $c->utilizador->user->username ?? null,
            ];
        }

        return $comentariosDaAula;
    }

    public function actionPostnovo(){

        $Comentariomodel = new $this->modelClass;
        $utilizador_id = \Yii::$app->request->post('utilizador_id');

        $utilizador = Utilizador::findOne(['id' => $utilizador_id]);
        $this->checkAccess('create', $utilizador);

        $aula = Aula::findOne(\Yii::$app->request->post('aula_id'));
        if($aula){
            $Comentariomodel->descricao_comentario = \Yii::$app->request->post('descricao_comentario');
            $Comentariomodel->aula_id = \Yii::$app->request->post('aula_id');
            $Comentariomodel->hora_criada = \Yii::$app->request->post('hora_criada');
            $Comentariomodel->utilizador_id = \Yii::$app->request->post('utilizador_id');

            if($Comentariomodel->save()){
                return $Comentariomodel;
            }
            else{
                return "Erro a submeter o comentario";
            }
        }
        else{
            return "Aula não encontrada";
        }


    }

    public function actionDelporutilizadorecomentarioid($utilizador_id, $id){

        $comentarioModel = new $this->modelClass;
        $utilizador = Utilizador::find()->where(['id' => $utilizador_id])->one();
        $this->checkAccess('delete', $utilizador);

        $comentarios = $comentarioModel::findOne($id);
        if($comentarios) {
            $deleted = $comentarios->delete();
            return $deleted;
        }
        else{
            return "O comentário não existe";
        }

    }


}
