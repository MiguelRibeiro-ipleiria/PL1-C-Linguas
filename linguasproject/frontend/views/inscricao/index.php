<?php

use common\models\Inscricao;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\InscricaoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Inscricaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricao-index mt-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Inscricao', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'utilizador_id',
            'curso_idcurso',
            'data_inscricao',
            'progresso',
            'estado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Inscricao $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso]);
                 }
            ],
        ],
    ]); ?>


</div>
