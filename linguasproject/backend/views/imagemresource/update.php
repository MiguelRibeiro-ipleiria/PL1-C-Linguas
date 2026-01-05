<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ImagemResource $model */

$this->title = 'Update Imagem Resource: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Imagem Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagem-resource-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
