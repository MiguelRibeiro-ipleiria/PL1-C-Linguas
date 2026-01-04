<?php

use common\models\Feedback;
use common\models\User;
use common\models\Utilizador;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\FeedbackSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $estados_feedback */


$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;

// 1. Registro do CSS para manter as cores verdes nos links e ações
$this->registerCss("
    .grid-view th a, .grid-view .action-column a { color: #28a745 !important; font-weight: bold; }
    .table-responsive { margin-top: 1.5rem; }
    .card-success:not(.card-outline) > .card-header { background-color: #28a745; }
");
?>

<div class="feedback-index">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p>
            <?= Html::a('Create Feedback', ['create', 'estados_feedback' => $estados_feedback], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Sistema de Filtragem de Feedbacks</h3>
        </div>
        <div class="card-body">
            <?php // Renderiza o formulário de busca. Certifica-te que o ficheiro _search.php existe na pasta feedback ?>
            <?= $this->render('_search', ['model' => $searchModel, 'estados_feedback' => $estados_feedback]); ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // Removemos o 'filterModel' => $searchModel para o filtro não aparecer dentro da tabela
                    'summary' => false, 
                    'tableOptions' => [
                        'class' => 'table table-striped m-0',
                    ],
                    'layout' => "{items}\n<div class='card-footer clearfix'>{pager}</div>",
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'contentOptions' => ['style' => 'width: 60px;'],
                        ],
                        'assunto_feedback',
                        'descricao_feedback',
                        'hora_criada',
                        [
                            'label' => 'Utilizador',
                            'format' => 'raw',
                            'value' => function($model) {
                                $utilizador = Utilizador::findOne(['id' => $model->utilizador_id]);
                                if ($utilizador) {
                                    $user = User::findOne(['id' => $utilizador->user_id]);
                                    return $user ? Html::encode($user->username) : '(sem user)';
                                }
                                return '(não encontrado)';
                            }
                        ],
                        'estado_feedback',
                        [
                            'class' => ActionColumn::className(),
                            'header' => 'Ações',
                            'contentOptions' => ['class' => 'action-column', 'style' => 'width: 100px;'],
                            'urlCreator' => function ($action, Feedback $model) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            },
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>