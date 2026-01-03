<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ImagemResourceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="imagem-resource-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'id') ?>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'nome_imagem') ?>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'nome_ficheiro') ?>
        </div>
    </div>

    <div class="form-group mb-0">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>