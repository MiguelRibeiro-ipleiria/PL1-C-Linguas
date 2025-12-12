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
?>
<div class="resultado-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Resultado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'utilizador_id',
            'aula_idaula',
            'data_inicio',
            'data_fim',
            'estado',
            //'nota',
            //'tempo_estimado',
            //'data_agendamento',
            //'respostas_certas',
            //'respostas_erradas',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Resultado $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]);
                 }
            ],
        ],
    ]); ?>

    <div class="container">
        <div class="row">
            <div class="col-11">
                <div class="progress">
                    <div class="progress-bar" style="width: 70%;"></div>
                </div>
            </div>
            <div class="col-1">
                <p>70%</p>
            </div>
        </div>
    </div>


</div>
