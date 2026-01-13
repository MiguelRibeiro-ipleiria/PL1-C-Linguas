<?php

namespace backend\controllers;

use common\models\Resultado;
use common\models\ResultadoSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultadoController gere as notas e desempenhos dos alunos nas respetivas aulas.
 */
class ResultadoController extends Controller
{
    /**
     * Define as regras de acesso e comportamentos do controlador.
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'], // Segurança: só permite apagar via pedido POST
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'denyCallback' => function () {
                        // Caso o utilizador não tenha acesso, é expulso para o frontend
                        return \Yii::$app->response->redirect(['../../frontend/web/']);
                    },
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['admin', 'formador'], // Apenas cargos elevados gerem resultados
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lista todos os resultados com filtros de pesquisa.
     */
    public function actionIndex()
    {
        // Verifica permissão RBAC específica para ler resultados
        if (\Yii::$app->user->can('ReadResultados')) {
            $searchModel = new ResultadoSearch();
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
     * Visualiza um resultado específico através da chave composta (Utilizador + Aula).
     */
    public function actionView($utilizador_id, $aula_idaula)
    {
        if (\Yii::$app->user->can('ReadResultados')) {
            return $this->render('view', [
                'model' => $this->findModel($utilizador_id, $aula_idaula),
            ]);
        }
        else {
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Cria um novo registo de resultado (nota/desempenho).
     */
    public function actionCreate()
    {
        if (\Yii::$app->user->can('CreateResultados')) {
            $model = new Resultado();

            if ($this->request->isPost) {
                // Carrega os dados do formulário e guarda na base de dados
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]);
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Atualiza um resultado já existente.
     */
    public function actionUpdate($utilizador_id, $aula_idaula)
    {
        if (\Yii::$app->user->can('UpdateResultados')) {
            $model = $this->findModel($utilizador_id, $aula_idaula);

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]);
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
     * Elimina um resultado da base de dados.
     */
    public function actionDelete($utilizador_id, $aula_idaula)
    {
        if (\Yii::$app->user->can('DeleteResultados')) {
            $this->findModel($utilizador_id, $aula_idaula)->delete();
            return $this->redirect(['index']);
        }
        else {
            return $this->redirect(['site/no_permisson']);
        }
    }

    /**
     * Método auxiliar para encontrar o modelo pela chave composta.
     */
    protected function findModel($utilizador_id, $aula_idaula)
    {
        if (($model = Resultado::findOne(['utilizador_id' => $utilizador_id, 'aula_idaula' => $aula_idaula])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A página solicitada não existe.');
    }
}