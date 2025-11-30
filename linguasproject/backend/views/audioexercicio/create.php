<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AudioExercicio $model */

$this->title = 'Create Audio Exercicio';
$this->params['breadcrumbs'][] = ['label' => 'Audio Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audio-exercicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
