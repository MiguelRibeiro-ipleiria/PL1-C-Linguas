<?php

namespace backend\controllers;

use common\models\Resultado;
use common\models\ResultadoSearch;
use yii\data\ActiveDataProvider;
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
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new ResultadoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($utilizador_id, $aula_idaula)
    {
        return $this->render('view', [
            'model' => $this->findModel($utilizador_id, $aula_idaula),
        ]);
    }

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

    public function actionDelete($utilizador_id, $aula_idaula)
    {
        $this->findModel($utilizador_id, $aula_idaula)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($utilizador_id, $aula_idaula)
    {
        if (($model = Resultado::findOne(['utilizador_id' => $utilizador_id, 'aula_idaula' => $aula_idaula])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}