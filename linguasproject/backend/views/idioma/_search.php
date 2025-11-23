<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\IdiomaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="idioma-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'lingua_descricao') ?>

    <?= $form->field($model, 'lingua_sigla') ?>

    <?= $form->field($model, 'lingua_objetivo') ?>

    <?= $form->field($model, 'lingua_bandeira') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
