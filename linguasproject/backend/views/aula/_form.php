<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
<<<<<<< HEAD
use yii\helpers\ArrayHelper;
use common\models\Curso;
=======
use common\models\Curso;
use yii\helpers\ArrayHelper;

>>>>>>> 3994628d8b9aaf6718ebd04e43e6e5b4b35615d9
/** @var yii\web\View $this */
/** @var common\models\aula $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin();

        $arraycursos = ArrayHelper::map(curso::find()->all(), 'id', 'titulo_curso');
    

    ?>

    <div class="row">
        <div class="col-9">
            <?= $form->field($model, 'titulo_aula')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-3">
            <?= $form->field($model, 'curso_id')->dropDownList(
                ArrayHelper::map(Curso::find()->asArray()->all(), 'id', 'titulo_curso'),
                ['prompt' => 'Selecione um curso']
            ) ?>
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

<<<<<<< HEAD
=======
    <?= $form->field($model, 'descricao_aula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_de_exercicios')->textInput() ?>

    <?= $form->field($model, 'tempo_estimado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_criacao')->textInput(['maxlength' => true]) ?>
>>>>>>> 3994628d8b9aaf6718ebd04e43e6e5b4b35615d9

    <?= $form->field($model, 'curso_id')->dropDownList($arraycursos) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar Aula', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
