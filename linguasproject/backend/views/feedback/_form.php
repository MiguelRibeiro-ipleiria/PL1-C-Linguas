<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Feedback $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $estados_feedback */
?>

<div class="feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'assunto_feedback')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao_feedback')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hora_criada')->textInput() ?>

    <?= $form->field($model, 'utilizador_id')->textInput() ?>

    <?= $form->field($model, 'estado_feedback')->dropDownList(
        $estados_feedback,
        ['class' => 'form-control select2']
    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
