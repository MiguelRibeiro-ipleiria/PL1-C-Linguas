<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ResultadoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="resultado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'utilizador_id')->label('ID Utilizador') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'aula_idaula')->label('ID Aula') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'estado')->label('Estado*') ?>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'data_inicio')->input('date')->label('Data Início') ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'data_fim') ?>

    <?php // echo $form->field($model, 'nota') ?>

    <?php // echo $form->field($model, 'tempo_estimado') ?>

    <?php // echo $form->field($model, 'data_agendamento') ?>

    <?php // echo $form->field($model, 'respostas_certas') ?>

    <?php // echo $form->field($model, 'respostas_erradas') ?>

    <div class="form-group mb-0">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>