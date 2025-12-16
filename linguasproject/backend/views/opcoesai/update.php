<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Opcoesai $model */

$this->title = 'Update Opcoesai: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Opcoesais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="opcoesai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
