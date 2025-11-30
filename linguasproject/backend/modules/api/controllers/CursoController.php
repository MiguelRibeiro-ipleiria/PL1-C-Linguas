<?php

namespace backend\modules\api\controllers;

use common\models\Idioma;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CursoController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Curso';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCount()
    {
        $CursosModel = new $this->modelClass;
        $cursos = $CursosModel::find()->all();
        return ['count' => count($cursos)];
    }


    public function actionCountporidioma($idiomanome)
    {
        $CursosModel = new $this->modelClass;
        $idioma = Idioma::find()->where(['lingua_descricao' => $idiomanome])->one();

        if($idioma == null){
            return "Idioma não encontrado!";
        }
        else{
            $cursos = $CursosModel::find()->where(['idioma_id' => $idioma->id])->all();
            return ['count' => count($cursos)];
        }

    }

    public function actionCurso($id)
    {
        $CursosModel = new $this->modelClass;
        $curso = $CursosModel::find()->where(['id' => $id])->one();

        if($curso == null){
            return "Curso não encontrado!";
        }
        else{
            return $curso;
        }
    }

    public function actionCursosporidioma($idiomanome)
    {
        $CursosModel = new $this->modelClass;
        $idioma = Idioma::find()->where(['lingua_descricao' => $idiomanome])->one();

        if($idioma == null){
            return "Idioma não encontrado!";
        }
        else{
            $cursos = $CursosModel::find()->where(['idioma_id' => $idioma->id])->all();
            return $cursos;
        }
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
