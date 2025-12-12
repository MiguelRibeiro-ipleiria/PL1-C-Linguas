<?php

namespace frontend\controllers;

use common\models\AudioExercicio;
use common\models\Aula;
use common\models\Comentario;
use common\models\AulaSearch;
use common\models\Fraseexercicio;
use common\models\Imagemexercicio;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * AulaController implements the CRUD actions for Aula model.
 */
class AulaController extends Controller
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
     * Lists all Aula models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AulaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aula model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        $modelcomentario = new Comentario();

        $query_comentarios = $model->getComments($id);
        $DataCommentsProvider = new ActiveDataProvider([
            'query' => $query_comentarios,
        ]);

        return $this->render('view', [
            'model' => $model,
            'imgexercicios' => $model->getCountImageExercicios($id),
            'audioexercicios' => $model->getCountAudioExercicios($id),
            'fraseexercicios' => $model->getCountFraseExercicios($id),
            'commentscount' => $model->getCountComments($id),
            'DataCommentsProvider' => $DataCommentsProvider,
            'modelcomentario' => $modelcomentario,
        ]);
    }

    /**
     * Creates a new Aula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Aula();

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
    }

    /**
     * Updates an existing Aula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Aula model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Aula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aula::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAulaemexecucao($id)
    {
        $this->layout = false;
        $model = Aula::findOne($id);
        return $this->render('aula_em_execucao', [
            'model' => $model,
        ]);

    }
}
