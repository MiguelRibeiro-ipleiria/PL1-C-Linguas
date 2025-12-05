<?php

namespace backend\controllers;

use common\models\LoginForm;
use Couchbase\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'logout', 'error', 'no_permisson'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'timeline'],
                        'allow' => true,
                        'roles' => ['CanAccessBackend'],
                    ],
                ],
                'denyCallback' => function () {

                    if(Yii::$app->user->isGuest){
                        return $this->redirect(['login']);
                    }
                    else{
                        return $this->redirect(['no_permisson']);
                    }
                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTimeline()
    {
        return $this->render('timeline');
    }

    public function actionNo_permisson()
    {
        return $this->render('no_permisson', [
            'message' => 'Não tem permissão para aceder a esta página.'
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $auth = Yii::$app->authManager;

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            $modelrole = $auth->getRolesByUser(Yii::$app->user->identity->id);
            $userrole = key($modelrole);


            if ($userrole == 'formador' || $userrole == 'admin') {
                return $this->goBack();
            }
            else{
                Yii::$app->user->logout();
                return $this->render('login', [
                    'model' => $model,
                ]);
            }

        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
