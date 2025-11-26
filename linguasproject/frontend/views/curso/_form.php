<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Curso $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idioma_id')->textInput() ?>

    <?= $form->field($model, 'dificuldade_id')->textInput() ?>

    <?= $form->field($model, 'titulo_curso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_ativo')->textInput() ?>

    <?= $form->field($model, 'data_criacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
