<?php

namespace backend\controllers;
use common\models\User;
use common\models\Utilizador;
use common\models\Curso;
use app\models\CursoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use Yii;
use yii\filters\AccessControl;

/**
 * CursoController implements the CRUD actions for Curso model.
 */
class CursoController extends Controller
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
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'roles' => ['ReadCourse'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['CreateCourse'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['UpdateCourse'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['DeleteCourse'],
                        ],
                    ],
                    'denyCallback' => function () {
                        return $this->redirect(['site/no_permisson']);
                    }
                ],
            ]
        );
    }

    /**
     * Lists all Curso models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;

        $user = User::findOne(Yii::$app->user->id);
        $userRoles = $auth->getRolesByUser($user->id);
        $role = key($userRoles);



        if ($this->request->isGet) {


            if ($role == "formador") {
                $utilizador = Utilizador::findOne(['user_id' => $user->id]);
                $idioma = $utilizador->idioma_id;

                $searchModel = new CursoSearch();
                $dataProvider = $searchModel->search($this->request->queryParams);
                $dataProvider->query->andWhere(['idioma_id' => $idioma]);

            }
            elseif($role == "admin") {
                $searchModel = new CursoSearch();
                $dataProvider = $searchModel->search($this->request->queryParams);
            }


//            $searchModel = new IdiomaSearch();
//            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        elseif ($this->request->isPost) {

            $searchModel = new CursoSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }






//        if ($role == "formador") {
//
//            $utilizador = Utilizador::findOne(['user_id' => $user->id]);
//            $idioma = $utilizador->idioma_id;
//
//            $searchModel = new CursoSearch();
//            $QueryFindCursosDoIdioma = Curso::find()->where(['idioma_id' => $idioma]);
//
//            $dataProvider = new ActiveDataProvider([
//                'query' => $QueryFindCursosDoIdioma,
//            ]);
//
//            return $this->render('index', [
//                'searchModel' => $searchModel,
//                'dataProvider' => $dataProvider,
//            ]);
//        }
//        elseif($role == "admin"){
//            $searchModel = new CursoSearch();
//            $dataProvider = $searchModel->search($this->request->queryParams);
//
//            return $this->render('index', [
//                'searchModel' => $searchModel,
//                'dataProvider' => $dataProvider,
//            ]);
//        }


    }

    /**
     * Displays a single Curso model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Curso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Curso();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->data_criacao = date('Y-m-d H:i:s');
                $model->status_ativo = 1;

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

    /**
     * Updates an existing Curso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $auth = Yii::$app->authManager;

        $model = $this->findModel($id);
        $user = User::findOne(Yii::$app->user->id);
        $UserRoles = $auth->getRolesByUser($user->id);
        $userrole = key($UserRoles);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'userrole' => $userrole,
            'user' => $user,
        ]);

    }

    /**
     * Deletes an existing Curso model.
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
     * Finds the Curso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Curso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Curso::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
