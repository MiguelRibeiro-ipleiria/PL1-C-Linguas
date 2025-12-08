<?php

use common\models\Dificuldade;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\DificuldadeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dificuldades';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <?= Html::a('Create Dificuldade', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-striped m-0',
                ],
                'layout' => "{items}\n<div class='card-footer clearfix'>{pager}</div>",
                'columns' => [
                    'id',
                    'grau_dificuldade',
                    [
                        'class' => ActionColumn::class,
                        'header' => 'Ações',
                        'urlCreator' => function ($action, Dificuldade $model, $key, $index, $column) {
                            return Url::to([$action, 'id' => $model->id]);
                        },
                        'contentOptions' => ['style' => 'width: 120px;'],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
