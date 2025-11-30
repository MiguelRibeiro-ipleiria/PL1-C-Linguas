<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AudioExercicio $model */

$this->title = 'Update Audio Exercicio: ' . $model->audio_resource_id;
$this->params['breadcrumbs'][] = ['label' => 'Audio Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->audio_resource_id, 'url' => ['view', 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="audio-exercicio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
