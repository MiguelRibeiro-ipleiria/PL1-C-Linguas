<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Audioresource $model */

$this->title = 'Update Audioresource: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Audioresources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="audioresource-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
