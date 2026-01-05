<?php

namespace backend\controllers;

use common\models\Aula;
use common\models\Curso;
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
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'timeline', 'error', 'no_permisson', 'logout'],
                        'allow' => true,
                        'roles' => ['admin', 'formador'],
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
        $aulas = Aula::find()->all();
        if($aulas){
            $count_dos_exercicios = 0;
            foreach ($aulas as $aula) {
                $aula_audio = $aula->getAudios()->count();
                $aula_imagem = $aula->getImagems()->count();
                $aula_frase = $aula->getFrases()->count();

                $count_dos_exercicios = $count_dos_exercicios + $aula_audio + $aula_frase + $aula_imagem;
            }
        }
        else{
            $count_dos_exercicios = 0;
        }

        return $this->render('index', ['count_dos_exercicios' => $count_dos_exercicios]);
    }

    public function actionTimeline()
    {
        if (\Yii::$app->user->can('ReadTimeline')) {
            return $this->render('timeline');
        }
        else{
            return $this->redirect(['no_permisson']);
        }
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
