<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Curso;
/** @var yii\web\View $this */
/** @var common\models\aula $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin();


        

    ?>

    <div class="row">
        <div class="col-9">
            <?= $form->field($model, 'titulo_aula')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <?= $form->field($model, 'numero_de_exercicios')->textInput() ?>
            <?= $form->field($model, 'tempo_estimado')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-9">
            <?= $form->field($model, 'descricao_aula')->textarea(['maxlength' => true]) ?>
        </div>
    </div>


    <?= $form->field($model, 'curso_id')->dropDownList($arraycursos) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar Aula', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
