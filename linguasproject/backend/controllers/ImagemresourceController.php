<?php

namespace backend\controllers;

use common\models\ImagemResource;
use common\models\ImagemResourceSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImagemresourceController implements the CRUD actions for ImagemResource model.
 */
class ImagemresourceController extends Controller
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
                'access' => [
                    'class' => AccessControl::class,
                    'denyCallback' => function () {
                        return \Yii::$app->response->redirect(['../../frontend/web/']);
                    },
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['admin', 'formador'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ImagemResource models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('ReadLessonImage')) {

            $searchModel = new ImagemResourceSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['site/no_permisson']);
        }

    }

    /**
     * Displays a single ImagemResource model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('ReadLessonImage')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }

    }

    /**
     * Creates a new ImagemResource model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('CreateLessonImage')) {

            $model = new ImagemResource();

            if ($this->request->isPost) {

                $model->load($this->request->post());

                $model->nome_ficheiro = UploadedFile::getInstance($model, 'nome_ficheiro');

                if ($model->upload()) {

                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Updates an existing ImagemResource model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('UpdateLessonImage')) {

            $model = $this->findModel($id);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Deletes an existing ImagemResource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('DeleteLessonImage')) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Finds the ImagemResource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ImagemResource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ImagemResource::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
