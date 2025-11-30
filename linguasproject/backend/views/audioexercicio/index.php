<?php

use common\models\AudioExercicio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AudioExercicioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Audio Exercicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audio-exercicio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Audio Exercicio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'audio_resource_id',
            'aula_id',
            'pergunta',
            'tipoexercicio_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AudioExercicio $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id]);
                 }
            ],
        ],
    ]); ?>


</div>
