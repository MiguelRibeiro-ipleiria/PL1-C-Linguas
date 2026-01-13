<?php

namespace backend\controllers;

use common\models\Aula;
use common\models\Frase;
use common\models\FraseSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Opcoesai;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Utilizador;
use common\models\Tipoexercicio;


/**
 * FraseController implements the CRUD actions for Frase model.
 */
class FraseController extends Controller
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
     * Lists all Frase models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->user->can('ReadExerciseFrase')) {

            $searchModel = new FraseSearch();
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
     * Displays a single Frase model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (\Yii::$app->user->can('ReadExerciseFrase')) {

            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Creates a new Frase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($aula_id = null)
    {
        if (\Yii::$app->user->can('CreateExerciseFrase')) {

            $model = new Frase();

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
                        $opcao = new Opcoesai();
                        $opcao->load(['Opcoesai' => $dadosOpcao]);
                        $opcao->frase_id = $model->id;
                        $opcao->save();
                    }

                    $aula = Aula::findOne($model->aula_id);
                    $aula->numero_de_exercicios = $aula->VerificaNumeroDeExercicios($model->aula_id);
                    $aula->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->loadDefaultValues();
            }

            $opcoes = [
                new Opcoesai(),
                new Opcoesai(),
                new Opcoesai(),
                new Opcoesai(),
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
     * Updates an existing Frase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (\Yii::$app->user->can('UpdateExerciseFrase')) {

            $model = $this->findModel($id);

            $opcoes = $this->FindOpcoes($id);
            $arrayTipoexercicio = ArrayHelper::map(Tipoexercicio::find()->all(), 'id', 'descricao');

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

                if (Opcoesai::loadMultiple($opcoes, $this->request->post()) && Opcoesai::validateMultiple($opcoes)) {
                    foreach ($opcoes as $opcao) {
                        $opcao->save(false);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
                'opcoes' => $opcoes,
                'arrayTipoexercicio' => $arrayTipoexercicio
            ]);
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Deletes an existing Frase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('DeleteExerciseFrase')) {

            $opcoes = $this->FindOpcoes($id);
            foreach ($opcoes as $opcao) {
                $opcao->delete();
            }
            $frase = $this->findModel($id);
            $aula = Aula::findOne($frase->aula_id);
            $frase->delete();

            $aula->numero_de_exercicios = $aula->VerificaNumeroDeExercicios($aula->id);
            if($aula->save()){
                return $this->redirect(['index']);
            }
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Finds the Frase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Frase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Frase::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function FindOpcoes($frase_id){

        if (\Yii::$app->user->can('ReadOpcoes')) {

            $opcoes = Opcoesai::findAll(['frase_id' => $frase_id]);
            return $opcoes;

            throw new NotFoundHttpException('The requested page does not exist.');
        }
        else{
            return $this->redirect(['site/no_permisson']);
        }
    }
}
