<?php

namespace backend\modules\api\controllers;

use backend\modules\api\components\CustomAuth;
use common\models\Aula;
use common\models\Inscricao;
use common\models\Resultado;
use common\models\User;
use common\models\Curso;
use common\models\Utilizador;
use yii\rest\ActiveController;
use Yii;

/**
 * Default controller for the `api` module
 */
class ResultadoController extends ActiveController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $modelClass = 'common\models\Resultado';

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

        if ($action === 'view') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id ){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões ver as inscricoes deste utilizador');
            }
        }
        elseif ($action === 'update') {
            $user_id = Yii::$app->params['id'];
            if($model->user_id !== $user_id || $model->user_id == null){
                throw new \yii\web\ForbiddenHttpException('Não tem permissões alterar dados de inscricoes deste utilizador');
            }
        }
    }

    public function actionPutdadosporaulaeutilizador($utilizador_id, $aula_idaula){

        $Resultadomodel = new $this->modelClass;

        $utilizador = Utilizador::find()->where(['id' => $utilizador_id])->one();
        $this->checkAccess('update', $utilizador);

        $resultado = $Resultadomodel::find()->where(['aula_idaula' => $aula_idaula, 'utilizador_id' => $utilizador_id])->one();

        if($resultado){

            $data_inicio =\Yii::$app->request->post('data_inicio');
            $data_fim =\Yii::$app->request->post('data_fim');
            $nota =\Yii::$app->request->post('nota');
            $estado =\Yii::$app->request->post('estado');
            $tempo_estimado =\Yii::$app->request->post('tempo_estimado');
            $respostas_certas =\Yii::$app->request->post('respostas_certas');
            $respostas_erradas =\Yii::$app->request->post('respostas_erradas');

            if($data_inicio != null){
                $resultado->data_inicio = $data_inicio;
            }

            if($data_fim != null){
                $resultado->data_fim = $data_fim;
            }

            if($nota != null){
                $resultado->nota = $nota;
            }

            if($estado != null){
                $resultado->estado = $estado;
            }

            if($tempo_estimado != null){
                $resultado->tempo_estimado = $tempo_estimado;
            }

            if($respostas_certas != null){
                $resultado->respostas_certas = $respostas_certas;
            }

            if($respostas_erradas != null){
                $resultado->respostas_erradas = $respostas_erradas;
            }

            if($resultado->save()){

                $aula = Aula::findOne($aula_idaula);
                $curso = Curso::findOne(['id' => $aula->curso_id]);

                $inscricao = Inscricao::find()->where(['curso_idcurso' => $curso->id, 'utilizador_id' => $utilizador_id])->one();
                if(Inscricao::VerificaEstadoCurso($curso->id, $utilizador_id)){
                    if($inscricao){
                        $inscricao->estado = "Concluído";
                    }
                }
                else{
                    $inscricao->estado = "Em Curso";
                }

                $aulas_terminadas_do_curso = $inscricao->CountResultadoDaInscricaoDoCurso($aula->curso_id, $utilizador_id);
                if(count($inscricao->curso->aulas) != 0){
                    $numero_total_aulas = count($inscricao->curso->aulas);
                }
                $progresso = (int)(($aulas_terminadas_do_curso / $numero_total_aulas) * 100);
                $inscricao->progresso = $progresso;
                $inscricao->save();

                return "Resultado atualizado com sucesso";
            }
            else{
                return "Erro ao atualizar o resultado";
            }
        }
        else{
            throw new \yii\web\NotFoundHttpException("Resultado não foi encontrado");
        }

    }

    public function actionResultadosporuser($utilizador_id){

        $Resultadomodel = new $this->modelClass;

        $utilizador = Utilizador::find()->where(['id' => $utilizador_id])->one();
        $this->checkAccess('view', $utilizador);

        $resultados = $Resultadomodel::find()->where(['utilizador_id' => $utilizador_id])->all();

        if($resultados){
            return $resultados;
        }
        else{
            return "Nunhum resultado encontrado";
        }
    }


}
