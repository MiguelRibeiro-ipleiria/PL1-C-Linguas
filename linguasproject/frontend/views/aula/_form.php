<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Aula $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo_aula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao_aula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_de_exercicios')->textInput() ?>

    <?= $form->field($model, 'tempo_estimado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curso_id')->textInput() ?>

    <?= $form->field($model, 'data_criacao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
