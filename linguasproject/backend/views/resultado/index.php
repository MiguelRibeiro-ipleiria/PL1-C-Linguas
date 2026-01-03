<?php

use common\models\Resultado;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ResultadoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Resultados';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("
    .grid-view th a, .grid-view .action-column a { color: #28a745 !important; font-weight: bold; }
    .table-responsive { margin-top: 1.5rem; }
    .card-success:not(.card-outline) > .card-header { background-color: #28a745; }
");
?>

<div class="resultado-index">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p>
            <?= Html::a('Create Resultado', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Sistema de Filtragem de Resultados</h3>
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
                    'tableOptions' => [
                        'class' => 'table table-striped m-0',
                    ],
                    'layout' => "{items}\n<div class='card-footer clearfix'>{pager}</div>",
                    'columns' => [
                        [
                            'attribute' => 'utilizador_id',
                            'contentOptions' => ['style' => 'width: 100px;'],
                        ],
                        'aula_idaula',
                        'data_inicio',
                        'estado',
                        'data_fim',
                        //'nota',
                        //'tempo_estimado',
                        //'data_agendamento',
                        //'respostas_certas',
                        //'respostas_erradas',
                        [
                            'class' => ActionColumn::className(),
                            'header' => 'Ações',
                            'contentOptions' => ['class' => 'action-column', 'style' => 'width: 100px;'],
                            'urlCreator' => function ($action, Resultado $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>