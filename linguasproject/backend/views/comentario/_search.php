<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ComentarioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comentario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Sistema de Filtragem de Comentários</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <?= $form->field($model, 'id')->input('number') ?>
                </div>

                <div class="col-md-5">
                    <?= $form->field($model, 'descricao_comentario') ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'aula_id')->input('number') ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'utilizador_id')->input('number') ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'hora_criada')->textInput(['type' => 'date']) ?>
                </div>
            </div>

            <div class="form-group mt-3">
                <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>