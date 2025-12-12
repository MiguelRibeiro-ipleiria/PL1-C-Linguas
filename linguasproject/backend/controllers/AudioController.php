<?php

namespace backend\controllers;

use common\models\Audio;
use common\models\AudioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\opcoesai;
use yii\helpers\ArrayHelper;
const OPCOES = null;

/**
 * AudioController implements the CRUD actions for Audio model.
 */
class AudioController extends Controller
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
     * Lists all Audio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AudioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Audio model.
     * @param int $audio_resource_id Audio Resource ID
     * @param int $aula_id Aula ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($audio_resource_id, $aula_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($audio_resource_id, $aula_id),
        ]);
    }

    /**
     * Creates a new Audio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($aula_id,$tipoexercicio_id)
    {
        $model = new Audio();
        $model->aula_id =$aula_id;
        $model->tipoexercicio_id = $tipoexercicio_id;
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {                


                $postOpcoes = $this->request->post('Opcoesai', []);

                foreach ($postOpcoes as $dadosOpcao) {
                    $opcao = new OpcoesAi();
                    $opcao->load(['Opcoesai' => $dadosOpcao]);
                    

                    $opcao->audio_aula_id = $aula_id;
                    $opcao->audio_audio_resource_id = $model->audio_resource_id;

                    $opcao->save();

                   
                }

                return $this->redirect(['view', 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        $opcoes = [
            new OpcoesAi(),
            new OpcoesAi(),
            new OpcoesAi(),
            new OpcoesAi(),
        ];
        return $this->render('create', [
            'model' => $model,
            'opcoes' => $opcoes 
        ]);
    }

    /**
     * Updates an existing Audio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $audio_resource_id Audio Resource ID
     * @param int $aula_id Aula ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($audio_resource_id, $aula_id)
    {
        $model = $this->findModel($audio_resource_id, $aula_id);
        $opcoes = $this->FindOpcoes($audio_resource_id, $aula_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'opcoes'=>$opcoes,
            
        ]);

    }



    /**
     * Deletes an existing Audio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $audio_resource_id Audio Resource ID
     * @param int $aula_id Aula ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($audio_resource_id, $aula_id)
    {
         
        $opcoes = $this->FindOpcoes($audio_resource_id, $aula_id);
        foreach($opcoes as $opcao){
            $opcao->delete();
        }
        $this->findModel($audio_resource_id, $aula_id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Audio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $audio_resource_id Audio Resource ID
     * @param int $aula_id Aula ID
     * @return Audio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($audio_resource_id, $aula_id)
    {
        if (($model = Audio::findOne(['audio_resource_id' => $audio_resource_id, 'aula_id' => $aula_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }   

    protected function FindOpcoes($audio_resource_id, $aula_id){

        $opcoes = Opcoesai::findAll(['audio_audio_resource_id' => $audio_resource_id, 'audio_aula_id' => $aula_id]);
        return $opcoes;

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
