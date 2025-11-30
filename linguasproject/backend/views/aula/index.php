<?php

use common\models\aula;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\aulaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aulas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aula-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Aula', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'titulo_aula',
            'descricao_aula',
            'numero_de_exercicios',
            'tempo_estimado',
            //'curso_id',
            //'data_criacao',
            [
                'label' => 'Atribuir Exercícios',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('Atribuir Exercícios', ['aula/exercicios', 'id' => $model->id], [
                        'class' => 'btn btn-success',
                        'title' => 'Atribuir Exercícios',
                    ]);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, aula $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
