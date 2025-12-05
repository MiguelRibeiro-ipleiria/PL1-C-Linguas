<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class DificuldadeController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Dificuldade';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDificuldade($id)
    {
        $DificuldadeModel = new $this->modelClass;
        $dificuldade = $DificuldadeModel::find()->where(['id' => $id])->one();

        if($dificuldade == null){
            return "Dificuldade não encontrada!";
        }
        else{
            return $dificuldade;
        }
    }








}
