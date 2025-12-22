<?php

namespace frontend\controllers;

use common\models\User;
use common\models\UserSearch;
use common\models\Utilizador;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new User();
        $model->status = 10;
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


    public function actionMeusProgressos($id)
    {

        $utilizador = Utilizador::findOne(['user_id' => $id]);

        if (!$utilizador) {
            throw new \yii\web\NotFoundHttpException('Perfil não encontrado.');
        }

        $meusProgressos = (new \yii\db\Query())
            ->from('inscricao') 
            ->where(['utilizador_id' => $utilizador->id])
            ->all();

        return $this->render('meus-progressos', [
            'utilizador' => $utilizador,
            'meusProgressos' => $meusProgressos,
        ]);
    }

    
    public function actionMeusCursosAulas($id)
    {
        $utilizador = Utilizador::findOne(['user_id' => $id]);

        if (!$utilizador) {
            throw new \yii\web\NotFoundHttpException('Utilizador não encontrado.');
        }

        $dadosCursos = (new \yii\db\Query())
            ->select([
                'i.curso_idcurso',
                'i.data_inscricao',
                'i.progresso',
                'i.estado AS estado_inscricao',
                'r.nota',
                'r.estado AS estado_aula',
                'r.data_inicio',
                'r.data_fim',
                'r.data_agendamento',
                'r.tempo_estimado'
            ])
            ->from(['i' => 'inscricao'])
            ->leftJoin(['r' => 'resultado'], 'i.utilizador_id = r.utilizador_id')
            ->where(['i.utilizador_id' => $utilizador->id])
            ->all();

        return $this->render('meus-cursos-aulas', [
            'utilizador' => $utilizador,
            'dadosCursos' => $dadosCursos,
        ]);
    }



    public function actionUpdate()
    {
        $user = User::findOne(Yii::$app->user->identity->id);
        $utilizador = Utilizador::findOne(['user_id' => $user->id]);

        if ($this->request->isPost) {

            $username = $this->request->post('username');
            $email = $this->request->post('email');
            $data_nascimento = $this->request->post('data_nascimento');
            $numero_telefone = $this->request->post('telefone');
            $nacionalidade = $this->request->post('nacionalidade');

            $user->username = $username;
            $user->email = $email;
            $utilizador->data_nascimento = $data_nascimento;
            $utilizador->numero_telefone = $numero_telefone;
            $utilizador->nacionalidade = $nacionalidade;

            if($utilizador->save() && $user->save()) {
                return $this->render('update', [
                    'user' => $user,
                    'utilizador' => $utilizador,
                ]);
            }
            else{

            }

            //&& $model->load($this->request->post()) && $model->save();

        }

        return $this->render('update', [
            'user' => $user,
            'utilizador' => $utilizador,
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
}
