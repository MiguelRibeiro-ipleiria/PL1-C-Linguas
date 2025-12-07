<?php

namespace backend\controllers;

use common\models\Inscricao;
use common\models\InscricaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * InscricaoController implements the CRUD actions for Inscricao model.
 */
class InscricaoController extends Controller
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
     * Lists all Inscricao models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(\Yii::$app->user->can('ReadInscricoes')) {
            $searchModel = new InscricaoSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Displays a single Inscricao model.
     * @param int $utilizador_id Utilizador ID
     * @param int $curso_idcurso Curso Idcurso
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($utilizador_id, $curso_idcurso)
    {
        if(\Yii::$app->user->can('ReadInscricoes')) {

            return $this->render('view', [
                'model' => $this->findModel($utilizador_id, $curso_idcurso),
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Creates a new Inscricao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('CreateInscricoes')) {

            $model = new Inscricao();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso]);
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
     * Updates an existing Inscricao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $utilizador_id Utilizador ID
     * @param int $curso_idcurso Curso Idcurso
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($utilizador_id, $curso_idcurso)
    {
        if(\Yii::$app->user->can('UpdateInscricoes')) {

            $model = $this->findModel($utilizador_id, $curso_idcurso);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso]);
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
     * Deletes an existing Inscricao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $utilizador_id Utilizador ID
     * @param int $curso_idcurso Curso Idcurso
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($utilizador_id, $curso_idcurso)
    {
        if(\Yii::$app->user->can('DeleteInscricoes')) {

            $this->findModel($utilizador_id, $curso_idcurso)->delete();

            return $this->redirect(['index']);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Finds the Inscricao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $utilizador_id Utilizador ID
     * @param int $curso_idcurso Curso Idcurso
     * @return Inscricao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($utilizador_id, $curso_idcurso)
    {
        if (($model = Inscricao::findOne(['utilizador_id' => $utilizador_id, 'curso_idcurso' => $curso_idcurso])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
