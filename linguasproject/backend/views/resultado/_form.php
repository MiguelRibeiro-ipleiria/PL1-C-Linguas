<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Resultado $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="resultado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'utilizador_id')->textInput() ?>

    <?= $form->field($model, 'aula_idaula')->textInput() ?>

    <?= $form->field($model, 'data_inicio')->textInput() ?>

    <?= $form->field($model, 'data_fim')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nota')->textInput() ?>

    <?= $form->field($model, 'tempo_estimado')->textInput() ?>

    <?= $form->field($model, 'data_agendamento')->textInput() ?>

    <?= $form->field($model, 'respostas_certas')->textInput() ?>

    <?= $form->field($model, 'respostas_erradas')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
