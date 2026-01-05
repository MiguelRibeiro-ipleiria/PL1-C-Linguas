<?php

namespace backend\controllers;

use common\models\Opcoesai;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OpcoesaiController implements the CRUD actions for Opcoesai model.
 */
class OpcoesaiController extends Controller
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
     * Lists all Opcoesai models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('ReadOpcoes')) {

            $dataProvider = new ActiveDataProvider([
                'query' => Opcoesai::find(),
                /*
                'pagination' => [
                    'pageSize' => 50
                ],
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ]
                ],
                */
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Displays a single Opcoesai model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('ReadOpcoes')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Creates a new Opcoesai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('CreateOpcoes')) {

            $model = new Opcoesai();

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
        }else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Updates an existing Opcoesai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('UpdateOpcoes')) {

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
     * Deletes an existing Opcoesai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('DeleteOpcoes')) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Finds the Opcoesai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Opcoesai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Opcoesai::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
