<?php

namespace backend\controllers;

use common\models\Feedback;
use common\models\FeedbackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends Controller
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
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['admin', 'formador'],
                        ],
                    ],
                    'denyCallback' => function () {
                        return \Yii::$app->response->redirect(['../../frontend/web/']);
                    },
                ]
            ]
        );
    }

    /**
     * Lists all Feedback models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('ReadFeedback')) {

            $searchModel = new FeedbackSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);
            $estados_feedback = [
                'Submetido' => 'Submetido',
                'Necessita Informação' => 'Necessita Informação',
                'Em progresso' => 'Em progresso',
                'Arquivado' => 'Arquivado',
                'Concluído' => 'Concluído',
            ];

            return $this->render('index', [
                'estados_feedback' => $estados_feedback,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Displays a single Feedback model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('ReadFeedback')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Creates a new Feedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('CreateFeedback')) {

            $model = new Feedback();

            $estados_feedback = [
                'Submetido' => 'Submetido',
                'Necessita Informação' => 'Necessita Informação',
                'Em progresso' => 'Em progresso',
                'Arquivado' => 'Arquivado',
                'Concluído' => 'Concluído',
            ];

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'estados_feedback' => $estados_feedback,
                'model' => $model,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Updates an existing Feedback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('UpdateFeedback')) {

            $model = $this->findModel($id);
            $estados_feedback = [
                'Submetido' => 'Submetido',
                'Necessita Informação' => 'Necessita Informação',
                'Em progresso' => 'Em progresso',
                'Arquivado' => 'Arquivado',
                'Concluído' => 'Concluído',
            ];
            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'estados_feedback' => $estados_feedback,
                'model' => $model,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Deletes an existing Feedback model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('DeleteFeedback')) {

            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedback::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
