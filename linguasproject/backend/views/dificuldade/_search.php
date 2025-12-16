<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\DificuldadeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dificuldade-search">

    <?php 
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Sistema de Filtragem de Dificuldades</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2"> <?= $form->field($model, 'id')->textInput(['type' => 'number']) ?>
                </div>
                <div class="col-md-10"> <?= $form->field($model, 'grau_dificuldade') ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>