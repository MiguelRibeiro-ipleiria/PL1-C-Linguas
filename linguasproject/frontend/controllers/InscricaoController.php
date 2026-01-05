<?php

namespace frontend\controllers;

use common\models\Inscricao;
use common\models\Utilizador;
use app\models\InscricaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InscricaoController implements the CRUD actions for Inscricao model.
 */
class InscricaoController extends Controller
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
     * Lists all Inscricao models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InscricaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inscricao model.
     * @param int $utilizador_id Utilizador ID
     * @param int $curso_idcurso Curso Idcurso
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($utilizador_id, $curso_idcurso)
    {
        return $this->render('view', [
            'model' => $this->findModel($utilizador_id, $curso_idcurso),
        ]);
    }

    /**
     * Creates a new Inscricao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($curso_id){

        $model = new Inscricao();
        $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->identity->getId()])->one();

        $model->utilizador_id = $utilizador->id;
        $model->data_inscricao = date('y-m-d H:i:s');;
        $model->progresso = 0;
        $model->estado =  "Inscrito";
        $model->curso_idcurso = $curso_id;


        if(\Yii::$app->user->can('CreateInscricoesPessoal') && \Yii::$app->user->can('CreateResultadosPessoal')){
            if(!($model->verificainscricao($curso_id, $utilizador->id)) && $model->save()){

                $model->inscricaonasaulas($curso_id, $utilizador->id);
                $curso = $model->getCurso();
                return $this->render('inscricao_valida', [
                    'curso' => $curso,
                ]);
            }
            else{
                $curso = $model->getCurso();
                return $this->render('inscricao_jafeita', [
                    'curso' => $curso,
                ]);
            }
        }
        return $this->redirect('../site/login');

    }

    /**
     * Updates an existing Inscricao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $utilizador_id Utilizador ID
     * @param int $curso_idcurso Curso Idcurso
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($utilizador_id, $curso_idcurso)
    {
        $model = $this->findModel($utilizador_id, $curso_idcurso);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Inscricao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $utilizador_id Utilizador ID
     * @param int $curso_idcurso Curso Idcurso
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($utilizador_id, $curso_idcurso)
    {
        if(Inscricao::desinscricaonasaulas($curso_idcurso, $utilizador_id)){
            if(Inscricao::verificainscricao($curso_idcurso, $utilizador_id)){
                $inscricao = Inscricao::findOne(['utilizador_id' => $utilizador_id, 'curso_idcurso' => $curso_idcurso]);
                $inscricao->delete();
            }
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Finds the Inscricao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $utilizador_id Utilizador ID
     * @param int $curso_idcurso Curso Idcurso
     * @return Inscricao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($utilizador_id, $curso_idcurso)
    {
        if (($model = Inscricao::findOne(['utilizador_id' => $utilizador_id, 'curso_idcurso' => $curso_idcurso])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
