<?php

namespace backend\controllers;

use common\models\imagemexercicio;
use common\models\imagemexercicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImagemexercicioController implements the CRUD actions for imagemexercicio model.
 */
class ImagemexercicioController extends Controller
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
     * Lists all imagemexercicio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new imagemexercicioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single imagemexercicio model.
     * Displays a single Imagemexercicio model.
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($imagem_resource_id, $aula_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($imagem_resource_id, $aula_id),
        ]);
    }

    /**
     * Creates a new imagemexercicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($aula_id, $tipoexercicio_id)
    {
        $model = new imagemexercicio();
        $model->aula_id = $aula_id;
        $model->tipoexercicio_id = $tipoexercicio_id;


        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->aula_id = $aula_id;
                $model->tipoexercicio_id = $tipoexercicio_id;

                if ($model->save()) {
                    return $this->redirect(['view', 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id]);
                }
            }
        } else {

            $model->loadDefaultValues();
        }

        return $this->render('create', [

            'model' => $model,

        ]);
    }

    /**
     * Updates an existing imagemexercicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($imagem_resource_id, $aula_id)
    {
        $model = $this->findModel($imagem_resource_id, $aula_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing imagemexercicio model.
     * Deletes an existing Imagemexercicio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($imagem_resource_id, $aula_id)
    {
        $this->findModel($imagem_resource_id, $aula_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the imagemexercicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @return imagemexercicio the loaded model
     * Finds the Imagemexercicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @return Imagemexercicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($imagem_resource_id, $aula_id)
    {
        if (($model = imagemexercicio::findOne(['imagem_resource_id' => $imagem_resource_id, 'aula_id' => $aula_id])) !== null) {
            if (($model = Imagemexercicio::findOne(['imagem_resource_id' => $imagem_resource_id, 'aula_id' => $aula_id])) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
