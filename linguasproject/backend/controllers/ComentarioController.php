<?php

namespace backend\controllers;

use common\models\comentario;
use common\models\User;
use common\models\Aula;
use common\models\ComentarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * ComentarioController implements the CRUD actions for comentario model.
 */
class ComentarioController extends Controller
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
     * Lists all comentario models.
     *
     * @return string
     */
    public function actionIndex($aula_id = null)
    {
        if(\Yii::$app->user->can('ReadComment')) {

            $arrayUsers= ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username');
            $arrayAula= ArrayHelper::map(Aula::find()->asArray()->all(), 'id', 'titulo_aula');

            if($aula_id != null){
                $searchModel = new ComentarioSearch();
                $dataProvider = $searchModel->search($this->request->queryParams);
                $dataProvider->query->andWhere(['aula_id' => $aula_id]);

            }
            else{
                $searchModel = new ComentarioSearch();
                $dataProvider = $searchModel->search($this->request->queryParams);
            }

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'arrayUsers' => $arrayUsers,
                'arrayAula' => $arrayAula,
            ]);

        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Displays a single comentario model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->can('ReadComment')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Creates a new comentario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('CreateComment')) {

            $model = new Comentario();

            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->hora_criada = date('Y-m-d H:i:s');
                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->id]);
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
     * Updates an existing comentario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->can('UpdateComment')) {

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
     * Deletes an existing comentario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(\Yii::$app->user->can('DeleteComment')) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Finds the comentario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return comentario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = comentario::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
