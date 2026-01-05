<?php

namespace backend\controllers;

use common\models\Resultado;
use common\models\ResultadoSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ResultadoController extends Controller
{
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

    public function actionIndex()
    {
        if (\Yii::$app->user->can('ReadResultados')) {

            $searchModel = new ResultadoSearch();
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

    public function actionView($utilizador_id, $aula_idaula)
    {
        if (\Yii::$app->user->can('ReadResultados')) {

            return $this->render('view', [
                'model' => $this->findModel($utilizador_id, $aula_idaula),
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    public function actionCreate()
    {
        if (\Yii::$app->user->can('CreateResultados')) {

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
        }else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    public function actionUpdate($utilizador_id, $aula_idaula)
    {
        if (\Yii::$app->user->can('UpdateResultados')) {

            $model = $this->findModel($utilizador_id, $aula_idaula);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    public function actionDelete($utilizador_id, $aula_idaula)
    {
        if (\Yii::$app->user->can('DeleteResultados')) {

            $this->findModel($utilizador_id, $aula_idaula)->delete();

            return $this->redirect(['index']);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    protected function findModel($utilizador_id, $aula_idaula)
    {
        if (($model = Resultado::findOne(['utilizador_id' => $utilizador_id, 'aula_idaula' => $aula_idaula])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}