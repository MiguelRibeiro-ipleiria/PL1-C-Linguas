<?php

namespace backend\controllers;

use common\models\Idioma;
use common\models\IdiomaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * IdiomaController implements the CRUD actions for Idioma model.
 */
class IdiomaController extends Controller
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
     * Lists all Idioma models.
     *
     * @return string
     */
    public function actionIndex()
    {

        if(\Yii::$app->user->can('ReadLanguage')) {

            if ($this->request->isGet) {
                $searchModel = new IdiomaSearch();
                $dataProvider = $searchModel->search($this->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            } elseif ($this->request->isPost) {

                $searchModel = new IdiomaSearch();
                $dataProvider = $searchModel->search($this->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Displays a single Idioma model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->can('ReadLanguage')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Creates a new Idioma model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
        public function actionCreate()
        {
            if(\Yii::$app->user->can('CreateLanguage')) {

                $model = new Idioma();


                if ($this->request->isPost) {

                    if ($model->load($this->request->post())) {

                        $model->lingua_bandeira = UploadedFile::getInstance($model, 'lingua_bandeira');
                        if ($model->upload()) {

                            $model->data_criacao = date('Y-m-d H:i:s');
                            if ($model->save()) {
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        }

                    }
                } else {
                    $model->loadDefaultValues();
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
     * Updates an existing Idioma model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->can('UpdateLanguage')) {

            $model = $this->findModel($id);


            if ($this->request->isPost && $model->load($this->request->post())) {

                $ImagemCarregada = UploadedFile::getInstance($model, 'lingua_bandeira');

                if ($ImagemCarregada) {
                    $model->lingua_bandeira = $ImagemCarregada;

                    if ($model->upload()) {
                        if ($model->save()) {
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            return $this->render('update', [
                                'model' => $model,
                            ]);
                        }
                    } else {
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }
                }


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
     * Deletes an existing Idioma model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(\Yii::$app->user->can('DeleteLanguage')) {

            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Finds the Idioma model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Idioma the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Idioma::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
