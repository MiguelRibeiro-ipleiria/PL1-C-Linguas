<?php

namespace backend\controllers;

use common\models\Inscricao;
use common\models\InscricaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class InscricaoController extends Controller
{
    /**
     * Configuração de comportamentos (Access Control e Verbos HTTP).
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'], // Apenas permite apagar via POST por segurança
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'denyCallback' => function () {
                        // Se o acesso for negado, redireciona para a página inicial do frontend
                        return \Yii::$app->response->redirect(['../../frontend/web/']);
                    },
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['admin', 'formador'], // Apenas admins e formadores entram aqui
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lista todas as inscrições.
     */
    public function actionIndex()
    {
        // Verificação Rbac
        if(\Yii::$app->user->can('ReadInscricoes')) {
            $searchModel = new InscricaoSearch();
            $dataProvider = $searchModel->search($this->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else {
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Mostra os detalhes de uma inscrição específica através da chave composta (User ID e Curso ID).
     */
    public function actionView($utilizador_id, $curso_idcurso)
    {
        if(\Yii::$app->user->can('ReadInscricoes')) {
            return $this->render('view', [
                'model' => $this->findModel($utilizador_id, $curso_idcurso),
            ]);
        }
        else {
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Cria uma nova inscrição.
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('CreateInscricoes')) {
            $model = new Inscricao();

            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->save()) {
                    // Após guardar, vai para o 'view' da nova inscrição
                    return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else {
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Atualiza uma inscrição existente.
     */
    public function actionUpdate($utilizador_id, $curso_idcurso)
    {
        if(\Yii::$app->user->can('UpdateInscricoes')) {
            $model = $this->findModel($utilizador_id, $curso_idcurso);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
        else {
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Apaga uma inscrição.
     */
    public function actionDelete($utilizador_id, $curso_idcurso)
    {
        if(\Yii::$app->user->can('DeleteInscricoes')) {
            $this->findModel($utilizador_id, $curso_idcurso)->delete();
            return $this->redirect(['index']);
        }
        else {
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Procura o modelo baseado na chave primária (composta). Se não encontrar, lança erro 404.
     */
    protected function findModel($utilizador_id, $curso_idcurso)
    {
        if (($model = Inscricao::findOne(['utilizador_id' => $utilizador_id, 'curso_idcurso' => $curso_idcurso])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A página solicitada não existe.');
    }
}