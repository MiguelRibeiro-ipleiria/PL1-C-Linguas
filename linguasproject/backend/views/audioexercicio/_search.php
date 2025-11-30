<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AudioExercicioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="audio-exercicio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'audio_resource_id') ?>

    <?= $form->field($model, 'aula_id') ?>

    <?= $form->field($model, 'pergunta') ?>

    <?= $form->field($model, 'tipoexercicio_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
