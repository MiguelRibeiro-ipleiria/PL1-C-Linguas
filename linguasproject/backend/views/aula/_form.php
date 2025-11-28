<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Curso;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\aula $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin();

        $arraycursos = ArrayHelper::map(curso::find()->all(), 'id', 'titulo_curso');
    

    ?>

    <?= $form->field($model, 'titulo_aula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao_aula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_de_exercicios')->textInput() ?>

    <?= $form->field($model, 'tempo_estimado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_criacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curso_id')->dropDownList($arraycursos) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
