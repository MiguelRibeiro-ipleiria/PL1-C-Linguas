<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\aulaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo_aula') ?>

    <?= $form->field($model, 'descricao_aula') ?>

    <?= $form->field($model, 'numero_de_exercicios') ?>

    <?= $form->field($model, 'tempo_estimado') ?>

    <?php // echo $form->field($model, 'curso_id') ?>

    <?php // echo $form->field($model, 'data_criacao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
