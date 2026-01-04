<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("
    .grid-view th a, .grid-view .action-column a { color: #28a745 !important; font-weight: bold; }
    .table-responsive { margin-top: 1.5rem; }
    .card-success:not(.card-outline) > .card-header { background-color: #28a745; }
");
?>

<div class="user-index">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p>
            <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Sistema de Filtragem de Users</h3>
        </div>
        <div class="card-body">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => false,
                    'tableOptions' => ['class' => 'table table-striped m-0'],
                    'layout' => "{items}\n<div class='card-footer clearfix'>{pager}</div>",
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'contentOptions' => ['style' => 'width: 60px;'],
                        ],
                        'username',
                        'email:email',
                        'utilizador.data_inscricao',
                        'utilizador.numero_telefone',
                        'utilizador.nacionalidade',
                        'utilizador.data_nascimento',
                        [
                            'class' => ActionColumn::className(),
                            'header' => 'Ações',
                            'contentOptions' => ['class' => 'action-column', 'style' => 'width: 100px;'],
                            'urlCreator' => function ($action, User $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                        [
                            'label' => 'Role',
                            'format' => 'raw',
                            'value' => function($model) {
                                return Html::a('Alterar Role', ['user/role', 'id' => $model->id], [
                                    'class' => 'btn btn-success btn-sm',
                                    'title' => 'Alterar Role',
                                ]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>