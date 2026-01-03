<?php

use common\models\aula;
use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\aulaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aulas';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss("
    .card-success:not(.card-outline) > .card-header { background-color: #28a745; }
    .cards-grid { display: flex; flex-wrap: wrap; gap: 20px; padding: 20px 0; }
");
?>
<div class="aula-index">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p>
            <?= Html::a('Create Aula', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Sistema de Filtragem de Aulas</h3>
        </div>
        <div class="card-body">
            <?= $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_aula',
        'emptyText' => 'Este curso ainda não tem nenhuma aula.',
        'layout' => "<div class='cards-grid'>{items}</div>\n<div class='mt-4'>{pager}</div>",
        'itemOptions' => ['tag' => false],
    ]) ?>

</div>