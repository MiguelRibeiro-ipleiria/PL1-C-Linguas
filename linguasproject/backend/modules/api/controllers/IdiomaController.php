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
            'except' => ['index', 'view',],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
        ];

        return $behaviors;
    }

}
