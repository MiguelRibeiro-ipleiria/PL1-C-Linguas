<?php

namespace frontend\controllers;

use common\models\Audio;
use common\models\Aula;
use common\models\Comentario;
use common\models\AulaSearch;
use common\models\Frase;
use common\models\Imagem;
use common\models\Inscricao;
use common\models\Opcoesai;
use common\models\Resultado;
use common\models\Utilizador;
use DateTime;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * AulaController implements the CRUD actions for Aula model.
 */
class AulaController extends Controller
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
     * Lists all Aula models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AulaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aula model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);

        if(!(\Yii::$app->user->isGuest)){
            $user = \Yii::$app->user;
            $utilizador = Utilizador::find()->where(['user_id' => $user->id])->one();

            if($model->curso->status_ativo == 1 && Inscricao::verificainscricao($model->curso_id, $utilizador->id) && $user->can('ReadLesson')){
                $modelcomentario = new Comentario();
                $resultado = Resultado::find()->where(['aula_idaula' => $id, 'utilizador_id' => $utilizador->id])->one();

                $query_comentarios = $model->getComentarios();
                $DataCommentsProvider = new ActiveDataProvider([
                    'query' => $query_comentarios,
                ]);

                return $this->render('view', [
                    'model' => $model,
                    'DataCommentsProvider' => $DataCommentsProvider,
                    'modelcomentario' => $modelcomentario,
                    'resultado' => $resultado,
                ]);
            }
            return $this->redirect(['curso/idiomacursos', 'id' => $model->curso->idioma_id]);

        }
        else{
            return $this->redirect('../site/login');
        }


    }

    /**
     * Creates a new Aula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Aula();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Aula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Aula model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Aula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aula::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAulacomecar($id)
    {
        $this->layout = false;
        $model = $this->findModel($id);
        return $this->render('aula_comecar', ['model' => $model]);
    }


    public function actionAulaemexecucao($id)
    {

        $this->layout = false;
        $model = Aula::findOne($id);
        $opcao_respondida = null;
        $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one();
        $resultado_utilizador = Resultado::find()->where(['utilizador_id' => $utilizador->id, 'aula_idaula' => $model->id])->one();
        $frase = null;
        $imagem = null;
        $audio = null;


        if($model->getExercisesFraseDoneSession() == null && $model->getExercisesImagensDoneSession() == null && $model->getExercisesAudiosDoneSession() == null){
            $resultado_utilizador->data_inicio = date('Y-m-d H:i:s');
            $resultado_utilizador->estado = "A estudar";
            $resultado_utilizador->respostas_certas = 0;
            $resultado_utilizador->respostas_erradas = 0;
            $frase = $model->getFrases()->one();
            if($frase == null){
                $imagem = $model->getImagems()->one();
                if($imagem == null){
                    $audio = $model->getAudios()->one();
                    if($audio == null){
                        return $this->redirect(['aulacancelar', 'id' => $id]);
                    }
                }
            }
            $count_exercicios_respondidos = 1;
        }
        elseif($model->getOpcaoRespondidaSession() != null){

            $opcao_respondida = Opcoesai::find()->where(['=', 'opcoesai.id', $model->getOpcaoRespondidaSession()])->one();
            $frase = $opcao_respondida->getFrase()->where(['id' => $opcao_respondida->frase_id])->one();
            if($frase == null){
                $imagem = $opcao_respondida->getImagemImagemResource()->where(['imagem_resource_id' => $opcao_respondida->imagem_imagem_resource_id])->one();
                if($imagem == null){
                    $audio = $opcao_respondida->getAudioAudioResource()->where(['audio_resource_id' => $opcao_respondida->audio_audio_resource_id])->one();
                }
            }
            $exercicios_respondidos_frases = $model->getExercisesFraseDoneSession();
            $exercicios_respondidos_imagens = $model->getExercisesImagensDoneSession();
            $exercicios_respondidos_audios = $model->getExercisesAudiosDoneSession();

            if($exercicios_respondidos_frases == null){
                $exercicios_respondidos_frases = [];
            }
            if($exercicios_respondidos_imagens == null){
                $exercicios_respondidos_imagens = [];
            }
            if($exercicios_respondidos_audios == null){
                $exercicios_respondidos_audios = [];
            }

            $count_exercicios_respondidos = (count($exercicios_respondidos_frases) + count($exercicios_respondidos_imagens) + + count($exercicios_respondidos_audios));

        }
        else{

            $exercicios_respondidos_frases = $model->getExercisesFraseDoneSession();
            $exercicios_respondidos_imagens = $model->getExercisesImagensDoneSession();
            $exercicios_respondidos_audios = $model->getExercisesAudiosDoneSession();

            if($exercicios_respondidos_frases == null){
                $exercicios_respondidos_frases = [];
            }
            if($exercicios_respondidos_imagens == null){
                $exercicios_respondidos_imagens = [];
            }
            if($exercicios_respondidos_audios == null){
                $exercicios_respondidos_audios = [];
            }

            $count_exercicios_respondidos = (count($exercicios_respondidos_frases) + count($exercicios_respondidos_imagens) + + count($exercicios_respondidos_audios)) + 1;


            // Logica para a continuacao da aula
            $frasesDone = $model->getExercisesFraseDoneSession();

            if ($frasesDone != null) {
                $frase = $model->getFrases()->where(['not in', 'frase.id', $frasesDone])->one();
            }
            else {
                $frase = $model->getFrases()->one();
            }


            if ($frase == null) {

                $imagensDone = $model->getExercisesImagensDoneSession();

                if ($imagensDone != null) {
                    $imagem = $model->getImagems()->where(['not in', 'imagem.imagem_resource_id', $imagensDone])->one();
                }
                else {
                    $imagem = $model->getImagems()->one();
                }

                if ($imagem == null) {

                    $audiosDone = $model->getExercisesAudiosDoneSession();
                    if ($audiosDone != null) {
                        $audio = $model->getAudios()->where(['not in', 'audio.audio_resource_id', $audiosDone])->one();
                    }
                    else {
                        $audio = $model->getAudios()->one();
                    }
                }
            }

        }

        if($frase == null && $imagem == null && $audio == null){
            return $this->redirect(['aulaterminar', 'id' => $id]);
        }

        if($resultado_utilizador->save()){

            return $this->render('aula_em_execucao', [
            'model' => $model,
            'frase' => $frase,
            'imagem' => $imagem,
            'audio' => $audio,
            'opcaorespondida' => $opcao_respondida,
            'count_exercicios' => $count_exercicios_respondidos,
            //'exercicio' => $exercicio,
            //'opcoes' => $opcoes,
            ]);
        }
        else{
            return $this->redirect(['aula_terminar', 'id' => $id]);
        }

    }

    public function actionAulaterminar($id){

//        $model = Aula::findOne($id);
//        $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one();
//        $resultado_utilizador = Resultado::find()->where(['utilizador_id' => $utilizador->id])->one();
//
//        $resultado_utilizador->data_fim = date('Y-m-d H:i:s');
//        $inicio = strtotime($resultado_utilizador->data_inicio);
//        $fim = strtotime($resultado_utilizador->data_fim);
//        $segundos = $fim - $inicio;
//
//        $resultado_utilizador->tempo_estimado = $segundos;
//
//        $resultado_utilizador->estado = "Terminada";
//        $resultado_utilizador->respostas_certas = $certas;
//        $resultado_utilizador->respostas_erradas = $erradas;
//        $resultado_utilizador->nota = (($certas) / $model->numero_de_exercicios) * 100;
//
//        if($resultado_utilizador->save()){
//
//            return $this->render('../resultado/view', [
//                'model' => $resultado_utilizador,
//            ]);
//
//        }
//        else{
//            return $this->redirect(['index']);
//        }
        $this->layout = false;
        $model = Aula::findOne($id);
        $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one();

        $resultado_utilizador = Resultado::find()->where(['utilizador_id' => $utilizador->id, 'aula_idaula' => $id])->one();
        $resultado_utilizador->data_fim = date('Y-m-d H:i:s');
        $data_inicio = strtotime($resultado_utilizador->data_inicio);
        $data_fim = strtotime($resultado_utilizador->data_fim);
        $resultado_utilizador->tempo_estimado = $data_fim - $data_inicio;
        $resultado_utilizador->estado = "Terminada";
        $resultado_utilizador->nota = (int)(($resultado_utilizador->respostas_certas / $model->numero_de_exercicios) * 100);


        if($resultado_utilizador->save()){
            $model->clearSessionExercises();

            $inscricao = Inscricao::findOne(['curso_idcurso' => $resultado_utilizador->aulaIdaula->curso_id, 'utilizador_id' => $resultado_utilizador->utilizador_id]);
            if ($inscricao->VerificaEstadoCurso($inscricao->curso_idcurso, $inscricao->utilizador_id)) {
                $inscricao->estado = "Concluído";
            }
            else{
                $inscricao->estado = "Em curso";
            }

            if($inscricao->save()){
                return $this->render('aula_terminada', ['resultado' => $resultado_utilizador, 'model' => $model]);
            }
            else{
                return $this->render('aula_cancelada', ['model' => $model]);
            }
        }
        else{
            return $this->render('aula_cancelada', ['model' => $model]);
        }


    }

    public function actionAulacancelar($id){

        $this->layout = false;
        $model = Aula::findOne($id);
        $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one();
        $resultado_utilizador = Resultado::find()->where(['utilizador_id' => $utilizador->id, 'aula_idaula' => $id])->one();

        $resultado_utilizador->data_inicio = null;
        $resultado_utilizador->data_fim = null;
        $resultado_utilizador->tempo_estimado = null;
        $resultado_utilizador->estado = "Por Começar";
        $resultado_utilizador->respostas_certas = null;
        $resultado_utilizador->respostas_erradas = null;
        $resultado_utilizador->nota = null;

        if($resultado_utilizador->save()){
            $model->clearSessionExercises();
            return $this->render('aula_cancelada', ['model' => $model]);
        }
        else{
            return $this->render('falha_na_aula', ['aula' => $model]);
        }
    }



}
