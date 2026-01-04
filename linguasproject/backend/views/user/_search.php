<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'id')->label('ID') ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'username')->label('Username*') ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'email')->label('Email*') ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <?php // echo $form->field($model, 'idutilizador') ?>

    <div class="form-group mb-0">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>