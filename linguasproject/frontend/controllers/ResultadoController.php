<?php

namespace frontend\controllers;

use common\models\Audio;
use common\models\Aula;
use common\models\Frase;
use common\models\Imagem;
use common\models\Opcoesai;
use common\models\Resultado;
use common\models\ResultadoSearch;
use common\models\Utilizador;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultadoController implements the CRUD actions for Resultado model.
 */
class ResultadoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Resultado models.
     *
     * @return string
     */
    public function actionIndex($aula_id)
    {
//        $searchModel = new ResultadoSearch();
//        $dataProvider = $searchModel->search($this->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);

        if ($this->request->isPost) {
            $opcao_respondida = Opcoesai::find()->where(['id' => $this->request->post('opcao_id')])->one();
            $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one();
            $resultado_user = Resultado::find()->where(['utilizador_id' => $utilizador->id, 'aula_idaula' => $aula_id])->one();
            if($opcao_respondida->iscorreta == 1){
                $resultado_user->respostas_certas++;
            }
            else{
                $resultado_user->respostas_erradas++;
            }
            if($resultado_user->save()){

                var_dump($resultado_user);
                die();
            }

        }
    }


    /**
     * Displays a single Resultado model.
     * @param int $utilizador_id Utilizador ID
     * @param int $aula_idaula Aula Idaula
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($utilizador_id, $aula_idaula)
    {
        return $this->render('view', [
            'model' => $this->findModel($utilizador_id, $aula_idaula),
        ]);
    }

    /**
     * Creates a new Resultado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Resultado();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Resultado model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $utilizador_id Utilizador ID
     * @param int $aula_idaula Aula Idaula
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($aula_id, $frase_id = null, $imagem_resource_id = null, $audio_resource_id = null)
    {
//        $model = $this->findModel($utilizador_id, $aula_idaula);
//
//        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);

        $frase = null;
        $imagem = null;
        $audio = null;

        if ($this->request->isPost) {
            $aula = Aula::findOne($aula_id);
            //$aula->clearSessionExercises();
            if($frase_id != null){
                $frase = Frase::findOne($frase_id);
                $opcao_respondida = $frase->getOpcoesais()->where(['=', 'opcoesai.id', $this->request->post('opcao_frase_id')])->one();
            }
            elseif($imagem_resource_id != null){
                $imagem = Imagem::findOne(['imagem_resource_id' => $imagem_resource_id, 'aula_id' => $aula_id]);
                $opcao_respondida = $imagem->getOpcoesais()->where(['=', 'opcoesai.id', $this->request->post('opcao_imagem_id')])->one();
            }
            elseif($audio_resource_id != null){
                $audio = Audio::findOne(['audio_resource_id' => $audio_resource_id, 'aula_id' => $aula_id]);
                $opcao_respondida = $audio->getOpcoesais()->where(['=', 'opcoesai.id', $this->request->post('opcao_audio_id')])->one();
            }

            $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one();
            $resultado_user = Resultado::find()->where(['utilizador_id' => $utilizador->id, 'aula_idaula' => $aula_id])->one();


            if($opcao_respondida->iscorreta == 1){
                $resultado_user->respostas_certas++;
            }
            else{
                $resultado_user->respostas_erradas++;
            }

            if($frase != null){
                $aula->setExercisesFrasesDoneSession($frase_id);
            }
            elseif($imagem != null){
                $aula->setExercisesImagensDoneSession($imagem->imagem_resource_id); //pq existe uma protecao que nao permite inserir dois exercicios com a mesma imagem!
            }
            elseif($audio != null){
                $aula->setExercisesAudiosDoneSession($audio->audio_resource_id); //pq existe uma protecao que nao permite inserir dois exercicios com a mesma imagem!
            }

            $aula->setOpcaoRespondidaSession($opcao_respondida->id);
            if($resultado_user->save()){

                //var_dump($resultado_user);
                //die();
                $this->redirect(['aula/aulaemexecucao', 'id' => $aula_id]);
            }

        }
    }


    public function actionAgendamento($aula_id)
    {
        $user_id = \Yii::$app->user->id;
        $utilizador = Utilizador::find()->where(['user_id' => $user_id])->one();
        $resultado = Resultado::find()->where(['aula_idaula' => $aula_id, 'utilizador_id' => $utilizador->id])->one();

        if ($this->request->isPost) {

            if ($resultado->load($this->request->post())) {

                if ($resultado->data_agendamento > date('Y-m-d')) {
                    $resultado->estado = "Agendada";
                    $resultado->data_inicio = null;
                    $resultado->data_fim = null;
                    $resultado->respostas_erradas = null;
                    $resultado->respostas_certas = null;
                    $resultado->nota = null;
                    $resultado->tempo_estimado = null;
                    if($resultado->save()){
                        return $this->render('agendamento_validado', [
                            'resultado' => $resultado,
                        ]);
                    }
                    else{
                        return $this->redirect(['aula/view',
                            'id' => $resultado->aulaIdaula->id]);
                    }
                }
                return $this->redirect(['aula/view',
                    'id' => $resultado->aulaIdaula->id]);
            }

            else{
                return $this->redirect(['aula/view',
                    'id' => $resultado->aulaIdaula->id]);
            }
        }

    }


    /**
     * Deletes an existing Resultado model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $utilizador_id Utilizador ID
     * @param int $aula_idaula Aula Idaula
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($utilizador_id, $aula_idaula)
    {
        $this->findModel($utilizador_id, $aula_idaula)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Resultado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $utilizador_id Utilizador ID
     * @param int $aula_idaula Aula Idaula
     * @return Resultado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($utilizador_id, $aula_idaula)
    {
        if (($model = Resultado::findOne(['utilizador_id' => $utilizador_id, 'aula_idaula' => $aula_idaula])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
