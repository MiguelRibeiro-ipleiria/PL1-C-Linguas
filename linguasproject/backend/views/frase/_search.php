<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FraseSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="frase-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'partefrases_1') ?>

    <?= $form->field($model, 'partefrases_2') ?>

    <?= $form->field($model, 'aula_id') ?>

    <?= $form->field($model, 'tipoexercicio_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
