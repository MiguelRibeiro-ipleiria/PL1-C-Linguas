<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use Yii;
use backend\modules\api\components\CustomAuth;
use yii\web\User;


/**
 * Default controller for the `api` module
 */
class IdiomaController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Idioma';
    public $user = null;
    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
            'except' => ['index', 'view', 'count'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if(isset(\Yii::$app->params['id'])){
            if($action === "delete"){
                if (!Yii::$app->user->can('DeleteLanguage')) {
                    if($action === "delete"){
                        throw new \yii\web\ForbiddenHttpException('Proibido');
                    }
                }

            }


        }
//        if(isset(\Yii::$app->params['id'])){
//
//            if(\Yii::$app->params['id'])
//            {
//                if($action === "delete"){
//                    throw new \yii\web\ForbiddenHttpException('Proibido');
//                }
//            }
//        }
    }

    public function actionCount()
    {
        $IdiomaModel = new $this->modelClass;
        $idiomas = $IdiomaModel::find()->all();
        return ['count' => count($idiomas)];
    }

    public function actionNomes()
    {
        $IdiomaModel = new $this->modelClass;
        $nomes_idiomas = $IdiomaModel::find()->select(['lingua_descricao'])->all();
        return $nomes_idiomas;
    }

    public function actionIdiomapornome($nome)
    {
        $IdiomaModel = new $this->modelClass;
        $idioma = $IdiomaModel::find()->where(['lingua_descricao' => $nome])->one();
        return $idioma;
    }



}
