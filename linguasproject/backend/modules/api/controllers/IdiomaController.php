<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

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

    public function actionIndex()
    {
        return $this->render('index');
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

    public function actionDeletepornome($nome){
        $IdiomaModel = new $this->modelClass;
        $deleted = $IdiomaModel::deleteAll(['lingua_descricao' => $nome]);
        if($deleted){
            return "Idioma ( $nome ) apagado com sucesso!";
        }else{
            return "Impossível apagar o Idioma ( $nome )!";
        }
    }



}
