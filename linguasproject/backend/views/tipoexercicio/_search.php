<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\TipoexercicioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tipoexercicio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'id')->label('ID') ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'descricao')->label('Descrição do Tipo*') ?>
        </div>
    </div>

    <div class="form-group mb-0">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>