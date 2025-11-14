<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Idioma $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="idioma-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lingua_descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lingua_sigla')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lingua_bandeira')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
