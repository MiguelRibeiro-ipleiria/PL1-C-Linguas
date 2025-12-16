<?php

use common\models\Dificuldade;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\DificuldadeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dificuldades';

$this->registerCss("
    .grid-view th a, .grid-view .action-column a { color: #28a745 !important; font-weight: bold; }
    .table-responsive { margin-top: 1.5rem; }
");
?>

<p><?= Html::a('Create Dificuldade', ['create'], ['class' => 'btn btn-success']) ?></p>

<div class="card card-success">
    <div class="card-body">
        <?= $this->render('_search', ['model' => $searchModel]) ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false, 
            'tableOptions' => ['class' => 'table table-striped m-0'],
            'layout' => "{items}\n<div class='card-footer clearfix'>{pager}</div>",
            'columns' => [
                'id',
                'grau_dificuldade',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Ações',
                    'contentOptions' => ['class' => 'action-column', 'style' => 'width: 100px;'],
                ],
            ],
        ]); ?>
    </div>
</div>