<?php

use common\models\ImagemExercicio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ImagemExercicioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Imagem Exercicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagem-exercicio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Imagem Exercicio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'imagem_resource_id',
            'aula_id',
            'pergunta',
            'tipoexercicio_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ImagemExercicio $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id]);
                 }
            ],
        ],
    ]); ?>


</div>
