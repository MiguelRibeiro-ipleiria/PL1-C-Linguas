<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ImagemExercicio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="imagem-exercicio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'imagem_resource_id')->textInput() ?>

    <?= $form->field($model, 'pergunta')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
