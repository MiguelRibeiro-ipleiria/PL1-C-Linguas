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

    <?= $form->field($model, 'utilizador_id') ?>

    <?= $form->field($model, 'aula_idaula') ?>

    <?= $form->field($model, 'data_inicio') ?>

    <?= $form->field($model, 'data_fim') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'nota') ?>

    <?php // echo $form->field($model, 'tempo_estimado') ?>

    <?php // echo $form->field($model, 'data_agendamento') ?>

    <?php // echo $form->field($model, 'respostas_certas') ?>

    <?php // echo $form->field($model, 'respostas_erradas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
