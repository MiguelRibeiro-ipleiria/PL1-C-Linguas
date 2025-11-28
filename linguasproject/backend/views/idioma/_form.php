<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Idioma $model */
/** @var yii\widgets\ActiveForm $form */
?>




<div class="idioma-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'lingua_descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lingua_objetivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lingua_sigla')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lingua_bandeira')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
