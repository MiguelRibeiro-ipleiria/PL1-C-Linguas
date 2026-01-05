<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\Frase $model */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\Opcoesai $modelopcao */
?>

<div class="frase-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'partefrases_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'partefrases_2')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'tipoexercicio_id')->dropDownList($arrayTipoexercicio)?>


    <?php
    foreach ($opcoes as $i => $opcao){ ?>

        <div class="card" style="padding: 10px; margin-bottom: 15px;">
            <h4>Opção <?= $i+1 ?></h4>

            <?= $form->field($opcao, "[$i]descricao")->textInput(['maxlength' => true]) ?>
            <?= $form->field($opcao, "[$i]iscorreta")->checkbox() ?>
        </div>

    <?php }?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
