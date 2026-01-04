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

    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'id') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'titulo_aula') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'descricao_aula') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'numero_de_exercicios') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'tempo_estimado') ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'curso_id') ?>

    <?php // echo $form->field($model, 'data_criacao') ?>

    <div class="form-group mb-0">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>