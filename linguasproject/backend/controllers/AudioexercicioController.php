<?php

namespace backend\controllers;

use common\models\AudioExercicio;
use common\models\AudioExercicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AudioExercicioController implements the CRUD actions for AudioExercicio model.
 */
class AudioexercicioController extends Controller
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
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'roles' => ['ReadExerciseSound'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['CreateExerciseSound'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['UpdateExerciseSound'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['DeleteExerciseSound'],
                        ],
                    ],
                    'denyCallback' => function () {
                        return $this->redirect(['site/no_permisson']);
                    }
                ],
            ]
        );
    }

    /**
     * Lists all AudioExercicio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AudioExercicioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AudioExercicio model.
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
     * Creates a new AudioExercicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($aula,$tipoexercicio)
    {
        $model = new AudioExercicio();
        $model->aula_id = $aula;
        $model->tipoexercicio_id = $tipoexercicio;
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AudioExercicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $audio_resource_id Audio Resource ID
     * @param int $aula_id Aula ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($audio_resource_id, $aula_id)
    {
        $model = $this->findModel($audio_resource_id, $aula_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AudioExercicio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $audio_resource_id Audio Resource ID
     * @param int $aula_id Aula ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($audio_resource_id, $aula_id)
    {
        $this->findModel($audio_resource_id, $aula_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AudioExercicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $audio_resource_id Audio Resource ID
     * @param int $aula_id Aula ID
     * @return AudioExercicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($audio_resource_id, $aula_id)
    {
        if (($model = AudioExercicio::findOne(['audio_resource_id' => $audio_resource_id, 'aula_id' => $aula_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
