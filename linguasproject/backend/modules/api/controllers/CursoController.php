<?php

namespace backend\modules\api\controllers;

use common\models\Idioma;
use common\models\Inscricao;
use common\models\Utilizador;
use yii\rest\ActiveController;
use Yii;
use backend\modules\api\components\CustomAuth;
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

    public function behaviors()
    {
        Yii::$app->params['id'] = 0;
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CustomAuth::className(),
            'except' => ['index', 'view', 'allcursos'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
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


    public function actionCount()
    {
        $CursosModel = new $this->modelClass;
        $cursos = $CursosModel::find()->all();
        return ['count' => count($cursos)];
    }

    public function actionAllcursos()
    {
        $CursosModel = new $this->modelClass;

        $cursos = $CursosModel::find()
            ->with(['idioma', 'dificuldade'])
            ->asArray()
            ->all();

        $result = array_map(function($curso) {
            return [
                'id' => $curso['id'],
                'titulo_curso' => $curso['titulo_curso'],
                'status_ativo' => $curso['status_ativo'],
                'curso_detalhe' => $curso['curso_detalhe'],
                'data_criacao' => $curso['data_criacao'],
                'idioma' => $curso['idioma']['lingua_descricao'] ?? null,
                'dificuldade' => $curso['dificuldade']['grau_dificuldade'] ?? null,
            ];
        }, $cursos);

        return $result;

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

    public function actionCursoporutilizadorid($id)
    {
        $CursosModel = new $this->modelClass;
        $utilizador = Utilizador::findOne(['id' => $id]);

        $cursos = $CursosModel::find()
            ->innerJoin('inscricao', 'inscricao.curso_idcurso = curso.id')
            ->where(['inscricao.utilizador_id' => $id])
            ->with(['idioma', 'dificuldade'])
            ->asArray()
            ->all();

        if (empty($cursos)) {
            return ['message' => 'Curso não encontrado!'];
        }

        $result = array_map(function($curso) {
            return [
                'id' => $curso['id'],
                'titulo_curso' => $curso['titulo_curso'],
                'status_ativo' => $curso['status_ativo'],
                'idioma' => $curso['idioma']['lingua_descricao'] ?? null,
                'dificuldade' => $curso['dificuldade']['grau_dificuldade'] ?? null,
                'curso_detalhe' => $curso['curso_detalhe'] ?? null,
                'data_criacao' => $curso['data_criacao'] ?? null,
            ];
        }, $cursos);

        return $result;
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
