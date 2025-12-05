<?php

namespace frontend\controllers;

use common\models\Resultado;
use common\models\ResultadoSearch;
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
    public function actionIndex()
    {
        $searchModel = new ResultadoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
    public function actionUpdate($utilizador_id, $aula_idaula)
    {
        $model = $this->findModel($utilizador_id, $aula_idaula);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
