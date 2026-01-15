<?php

namespace backend\modules\api\controllers;

use common\models\Aula;
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
            'except' => ['index', 'view', 'allcursos', 'countporidioma', 'allcursosporidioma'],  //Excluir a autenticação aos metedos do controllador (excluir aos gets)
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {

        if ($action === 'view') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id ){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões ver os cursos inscritos deste utilizador');
            }
        }

    }

    public function actionAllcursos()
    {
        $CursosModel = new $this->modelClass;

        $cursos = $CursosModel::find()
            ->with(['idioma', 'dificuldade'])
            ->asArray()
            ->all();

        $result = array_map(function($curso) {

            $aula_count = (int) Aula::find()->where(['curso_id' => $curso['id']])->count();
            return [
                'id' => $curso['id'],
                'titulo_curso' => $curso['titulo_curso'],
                'status_ativo' => $curso['status_ativo'],
                'curso_detalhe' => $curso['curso_detalhe'],
                'data_criacao' => $curso['data_criacao'],
                // Usando null coalescing para evitar erros de índice inexistente
                'idioma' => $curso['idioma']['lingua_descricao'] ?? null,
                'dificuldade' => $curso['dificuldade']['grau_dificuldade'] ?? null,
                'aula_count' => $aula_count,
            ];
        }, $cursos);

        return $result;

    }

    public function actionCountporidioma($idioma_id)
    {
        $CursosModel = new $this->modelClass;
        $idioma = Idioma::find()->where(['id' => $idioma_id])->one();

        if($idioma == null){
            return "Idioma não encontrado!";
        }
        else{
            $cursos_all = $CursosModel::find()->where(['idioma_id' => $idioma->id])->all();
            $cursos_desativos = $CursosModel::find()->where(['idioma_id' => $idioma->id, 'status_ativo' => 0])->all();

            return [
                'count_all' => count($cursos_all),
                'count_desativados' => count($cursos_desativos)
            ];
        }

    }

    public function actionCursoporutilizadorid($utilizador_id)
    {
        $CursosModel = new $this->modelClass;
        $utilizador = Utilizador::findOne(['id' => $utilizador_id]);

        if(!$utilizador){
            throw new \yii\web\NotFoundHttpException("Utilizador não encontrado");
        }
        else{
            $this->checkAccess('view', $utilizador);
        }


        $cursos = $CursosModel::find()
            ->innerJoin('inscricao', 'inscricao.curso_idcurso = curso.id')
            ->where(['inscricao.utilizador_id' => $utilizador_id])
            ->with(['idioma', 'dificuldade'])
            ->asArray()
            ->all();

        if (empty($cursos)) {
            return "Sem Inscrições";
        }

        $result = array_map(function($curso) {
            $aula_count = (int) Aula::find()->where(['curso_id' => $curso['id']])->count();

            return [
                'id' => $curso['id'],
                'titulo_curso' => $curso['titulo_curso'],
                'status_ativo' => $curso['status_ativo'],
                'idioma' => $curso['idioma']['lingua_descricao'] ?? null,
                'dificuldade' => $curso['dificuldade']['grau_dificuldade'] ?? null,
                'curso_detalhe' => $curso['curso_detalhe'] ?? null,
                'data_criacao' => $curso['data_criacao'] ?? null,
                'aula_count' => $aula_count,
            ];
        }, $cursos);

        return $result;
    }

    public function actionAllcursosporidioma($idioma_id)
    {
        $CursosModel = new $this->modelClass;
        $idioma = Idioma::find()->where(['id' => $idioma_id])->one();

        if($idioma == null){
            return "Idioma não encontrado!";
        }
        else{
            $cursos = $CursosModel::find()->where(['idioma_id' => $idioma->id])->all();

            if($cursos){
                return $cursos;
            }
            else{
                return "Este idioma não tem cursos";
            }
        }
    }


}
