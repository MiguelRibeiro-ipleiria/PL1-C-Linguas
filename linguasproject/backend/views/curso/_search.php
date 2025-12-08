<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Idioma;
use common\models\Dificuldade;

/** @var yii\web\View $this */
/** @var app\models\CursoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="curso-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',]);

    $arrayidiomas = ArrayHelper::map(Idioma::find()->all(), 'id', 'lingua_descricao');
    $arraydificuldade = ArrayHelper::map(Dificuldade::find()->all(), 'id', 'grau_dificuldade');
    ?>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Sistema de Filtragem de Cursos</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-1">
                    <?= $form->field($model, 'id')->textInput(['type' => 'number']) ?>
                </div>
                <div class="col-8">
                    <?= $form->field($model, 'titulo_curso') ?>
                </div>
                <div class="col-3">
                    <?= $form->field($model, 'status_ativo')->radioList([
                        1 => 'Ativado',
                        0 => 'Desativado']);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <?= $form->field($model, 'idioma_id')->dropDownList($arrayidiomas, ['prompt' => 'Selecione um idioma']) ?>
                </div>
                <div class="col-6">
                    <?= $form->field($model, 'dificuldade_id')->dropDownList($arraydificuldade, ['prompt' => 'Selecione uma dificuldade']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php // echo $form->field($model, 'data_criacao') ?>


    <?php ActiveForm::end(); ?>

</div>

<br>