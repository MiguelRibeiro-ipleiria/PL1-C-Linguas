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
            'except' => ['index', 'view'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
//        if(isset(\Yii::$app->params['id'])){
//            if($action === "delete"){
//                if (!Yii::$app->user->can('DeleteLanguage')) {
//                    if($action === "delete"){
//                        throw new \yii\web\ForbiddenHttpException('Proibido');
//                    }
//                }
//
//            }
//        }
//        if(isset(\Yii::$app->params['id'])){
//
//            if(\Yii::$app->params['id'])
//            {
//                if($action === "delete"){
//                    throw new \yii\web\ForbiddenHttpException('Proibido');
//                }
//            }
//        }
        // Bloquear DELETE se não tiver permissão


    }

    public function actionGetcomentarioporaula($aula_id){

        $comentarioModel = new $this->modelClass;

        $aula = Aula::findOne($aula_id);
        if($aula){
            $comentarios = $comentarioModel::find()->where(['aula_id' => $aula_id])->all();

            if($comentarios) {
                return $comentarios;
            }
            else{
                return "Sem comentarios";
            }
        }
        else{
            return "A aula não existe";
        }


    }

    public function actionPostnovo(){

        $Comentariomodel = new $this->modelClass;

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

    public function actionDelporid($id){

        $comentarioModel = new $this->modelClass;

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
