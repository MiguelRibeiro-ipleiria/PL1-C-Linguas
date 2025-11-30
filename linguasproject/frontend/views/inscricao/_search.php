<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\InscricaoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="inscricao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'utilizador_id') ?>

    <?= $form->field($model, 'curso_idcurso') ?>

    <?= $form->field($model, 'data_inscricao') ?>

    <?= $form->field($model, 'progresso') ?>

    <?= $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
