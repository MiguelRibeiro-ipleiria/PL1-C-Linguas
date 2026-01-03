<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ImagemSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="imagem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'imagem_resource_id')->label('ID Recurso') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'aula_id')->label('ID Aula') ?>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'pergunta')->label('Pergunta*') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'tipoexercicio_id')->label('ID Tipo Ex.') ?>
        </div>
    </div>

    <div class="form-group mb-0">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>