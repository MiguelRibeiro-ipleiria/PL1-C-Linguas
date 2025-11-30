<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FraseExercicio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="frase-exercicio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'partefrases_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partefrases_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resposta')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
