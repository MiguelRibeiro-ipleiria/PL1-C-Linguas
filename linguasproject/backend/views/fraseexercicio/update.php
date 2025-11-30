<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\FraseExercicio $model */

$this->title = 'Update Frase Exercicio: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Frase Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="frase-exercicio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
