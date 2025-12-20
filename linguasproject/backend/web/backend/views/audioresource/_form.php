<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Audioresource $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="audioresource-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome_audio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome_ficheiro')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
