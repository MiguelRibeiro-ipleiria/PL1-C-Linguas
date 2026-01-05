<?php

namespace backend\controllers;

use common\models\Aula;
use common\models\Imagem;
use common\models\ImagemSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\OpcoesAi;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Utilizador;
use common\models\Tipoexercicio;

/**
 * ImagemController implements the CRUD actions for Imagem model.
 */
class ImagemController extends Controller
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
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'findopcoes'],
                            'roles' => ['admin', 'formador'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Imagem models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('ReadExerciseImage')) {

            $searchModel = new ImagemSearch();
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

    /**
     * Displays a single Imagem model.
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($imagem_resource_id, $aula_id)
    {
        if (\Yii::$app->user->can('ReadExerciseImage')) {

            return $this->render('view', [
                'model' => $this->findModel($imagem_resource_id, $aula_id),
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Creates a new Imagem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($aula_id = null)
    {
        if (\Yii::$app->user->can('CreateExerciseImage')) {

            $model = new Imagem();
            $model->aula_id = $aula_id;


            $auth = Yii::$app->authManager;
            $user_id = Yii::$app->user->id;
            $utilizador = Utilizador::findOne(['user_id' => $user_id]);
            $userRoles = $auth->getRolesByUser($user_id);
            $role = key($userRoles);

            $query = Aula::find();


            if ($role !== 'admin') {
                $query->where(['utilizador_id' => $utilizador->id]);
            }

            $arrayaulas = ArrayHelper::map($query->all(), 'id', 'titulo_aula');
            $arrayTipoexercicio = ArrayHelper::map(Tipoexercicio::find()->all(), 'id', 'descricao');

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {


                    $postOpcoes = $this->request->post('Opcoesai', []);

                    foreach ($postOpcoes as $dadosOpcao) {
                        $opcao = new OpcoesAi();
                        $opcao->load(['Opcoesai' => $dadosOpcao]);


                        $opcao->imagem_aula_id = $model->aula_id;

                        $opcao->imagem_imagem_resource_id = $model->imagem_resource_id;

                        $opcao->save();

                    }


                    $aula = Aula::findOne($model->aula_id);

                    $aula->numero_de_exercicios = $aula->VerificaNumeroDeExercicios($model->aula_id);
                    $aula->save();
                    //return $this->redirect(['view', 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            $opcoes = [
                new OpcoesAi(),
                new OpcoesAi(),
                new OpcoesAi(),
                new OpcoesAi(),
            ];

            return $this->render('create', [
                'model' => $model,
                'opcoes' => $opcoes,
                'arrayaulas' => $arrayaulas,
                'aula_id' => $aula_id,
                'arrayTipoexercicio' => $arrayTipoexercicio,


            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
        

    }

    /**
     * Updates an existing Imagem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($imagem_resource_id, $aula_id)
    {
        if (\Yii::$app->user->can('UpdateExerciseImage')) {

            $model = $this->findModel($imagem_resource_id, $aula_id);

            $arrayTipoexercicio = ArrayHelper::map(Tipoexercicio::find()->all(), 'id', 'descricao');
            $opcoes = $this->FindOpcoes($imagem_resource_id, $aula_id);


            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    if (Opcoesai::loadMultiple($opcoes, $this->request->post()) && Opcoesai::validateMultiple($opcoes)) {
                        foreach ($opcoes as $opcao) {
                            $opcao->save(false);
                        }
                    }
                    return $this->redirect(['view', 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'opcoes' => $opcoes,
                'arrayTipoexercicio' => $arrayTipoexercicio,
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Deletes an existing Imagem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($imagem_resource_id, $aula_id)
    {
        if (\Yii::$app->user->can('DeleteExerciseImage')) {

            $opcoes = $this->FindOpcoes($imagem_resource_id, $aula_id);

            foreach ($opcoes as $opcao) {
                $opcao->delete();
            }
            $this->findModel($imagem_resource_id, $aula_id)->delete();

            return $this->redirect(['index']);
        }else{

        }
    }

    /**
     * Finds the Imagem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $imagem_resource_id Imagem Resource ID
     * @param int $aula_id Aula ID
     * @return Imagem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($imagem_resource_id, $aula_id)
    {
        if (($model = Imagem::findOne(['imagem_resource_id' => $imagem_resource_id, 'aula_id' => $aula_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    
    }

    protected function FindOpcoes($imagem_resource_id, $aula_id){

        if (\Yii::$app->user->can('ReadOpcoes')) {

            $opcoes = Opcoesai::findAll(['imagem_imagem_resource_id' => $imagem_resource_id, 'imagem_aula_id' => $aula_id]);
            return $opcoes;

            throw new NotFoundHttpException('The requested page does not exist.');
        }else{

        }
    }
}

