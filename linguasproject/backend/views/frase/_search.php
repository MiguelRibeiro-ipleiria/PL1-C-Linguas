<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FraseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="frase-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'id')->label('ID') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'partefrases_1')->label('Parte 1*') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'partefrases_2')->label('Parte 2*') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'aula_id')->label('ID Aula') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'tipoexercicio_id')->label('Tipo exercicio Id') ?>
        </div>
    </div>

    <div class="form-group mb-0">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>