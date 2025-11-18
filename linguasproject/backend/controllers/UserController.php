<?php

namespace backend\controllers;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\helpers\ArrayHelper;

use common\models\Idioma;
use backend\models\Utilizador;



/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('ReadUser')) {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        return $this->redirect(['no_permisson']);
    }
    public function actionNo_permisson()
    {
        return $this->render('//site/no_permisson', [
            'message' => 'Não tem permissão para aceder a esta página.'
        ]);
    }



    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $auth = Yii::$app->authManager;
        $model = $this->findModel($id);
        $UserRoles = $auth->getRolesByUser($model->id);
        $userrole = key($UserRoles);

        return $this->render('view', [
            'model' => $model,
            'userrole' => $userrole,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

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
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
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
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRole($id)
    {
        $auth = Yii::$app->authManager;
        $user = $this->findModel($id);
        $roles = $auth->getRoles();

        if ($this->request->isPost) {

            $RoleSelecionada = $this->request->post('role');
            $auth->revokeAll($user->id);

            if ($RoleSelecionada != null) {
                $NovaRole = $auth->getRole($RoleSelecionada);
                $auth->assign($NovaRole, $user->getId());
                return $this->render('view', [
                    'model' => $user,
                    'userrole' => $NovaRole->name
                ]);
            }
        }

        $UserRoles = $auth->getRolesByUser($user->id);
        $userrole = key($UserRoles);
        $ListadeRoles = \yii\helpers\ArrayHelper::map($roles, 'name', 'name');

        return $this->render('role', [
            'user' => $user,
            'ListadeRoles' => $ListadeRoles,
            'userrole' => $userrole,
        ]);


        //vai buscar ao authmanager, vai buscar o user a ser alterado vai buscar as roles do user, e todas as roles

        //se for um post então removem as roles todas do user e adicionam a role que enviarem no post
        //se for um GET então devolvem uma vista "Role" onde vão ter um formulario simples com o user e uma dropdown de roles
    }

    public function actionFormador()
    {
        if (\Yii::$app->user->can('ReadUser')) {


            $auth = Yii::$app->authManager;

            $utilizadores = Utilizador::find()->where(['not', ['idioma_id' => null]])->all();
            $utilizadorerole = array();

            foreach ($utilizadores as $utilizador) {

                $UserRoles = $auth->getRolesByUser($utilizador->user_id);
                $userrole = key($UserRoles);

                $utilizadorerole[] = [
                    "user" => $utilizador,
                    "role" => $userrole,
                ];
            }

            if ($this->request->isPost) {

                $RoleSelecionada = $this->request->post('role');
                $user = $this->request->post('userid');
                $auth->revokeAll($user);

                if ($RoleSelecionada != null) {
                    $NovaRole = $auth->getRole($RoleSelecionada);
                    $auth->assign($NovaRole, $user);
                }
            }

            return $this->render('formador', [
                'arrayusererole' => $utilizadorerole
            ]);
        }
        else {
            return $this->redirect(['no_permisson']);
        }

    }


}
