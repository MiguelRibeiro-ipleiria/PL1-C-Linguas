<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FeedbackSearch $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $estados_feedback */

?>

<div class="feedback-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-1">
            <?= $form->field($model, 'id')->label('ID') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'assunto_feedback')->label('Assunto*') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'descricao_feedback')->label('Mensagem*') ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'utilizador_id')->label('Utilizador*') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'hora_criada')->input('date')->label('Hora Criada') ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'estado_feedback')->dropDownList($estados_feedback) ?>
        </div>
    </div>

    <div class="form-group mb-0">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>