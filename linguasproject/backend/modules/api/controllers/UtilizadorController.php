<?php

namespace backend\modules\api\controllers;

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
            'except' => ['index', 'view', 'perfilutilizador'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
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

    public function actionPerfilutilizador($id){

        $utilizadorModel = new $this->modelClass;

        $utilizador = $utilizadorModel::find()
            ->where(['id' => $id])
            ->with(['user', 'idioma'])
            ->asArray()
            ->one();


        if($utilizador != null) {

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
        else{
            return "Utilizador não encontrado";
        }


    }


}
