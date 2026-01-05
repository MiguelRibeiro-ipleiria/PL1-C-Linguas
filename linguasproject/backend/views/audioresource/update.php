<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AudioResource $model */

$this->title = 'Update Audio Resource: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Audio Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="audio-resource-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
