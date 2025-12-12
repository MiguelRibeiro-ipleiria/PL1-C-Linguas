<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Idioma;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\IdiomaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="idioma-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    $arraysiglas = ArrayHelper::map(Idioma::find()->all(), 'lingua_sigla', 'lingua_sigla');
    ?>


    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Sistema de Filtragem de Idiomas</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-1">
                    <?= $form->field($model, 'id')->textInput(['type' => 'number']) ?>
                </div>
                <div class="col-3">
                    <?= $form->field($model, 'lingua_sigla') ->dropDownList($arraysiglas, ['prompt' => "Selecione a sigla..."])?>
                </div>
                <div class="col-8">
                    <?= $form->field($model, 'lingua_descricao') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
