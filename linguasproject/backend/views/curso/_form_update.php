<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Idioma;
use common\models\Dificuldade;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var common\models\Curso $model */
/** @var yii\widgets\ActiveForm $form */
/** @var string $userrole */
/** @var common\models\User $user */
?>

<div class="curso-form">

    <?php $form = ActiveForm::begin();

    $arrayidiomas = ArrayHelper::map(Idioma::find()->all(), 'id', 'lingua_descricao');
    $arraydificuldade = ArrayHelper::map(Dificuldade::find()->all(), 'id', 'grau_dificuldade');

    ?>

    <?php
        if($userrole == "formador"){ ?>
            <?=
                $form->field($model, 'idioma_id')->dropDownList(
                    ArrayHelper::map(Idioma::find()->asArray()->all(), 'id', 'lingua_descricao'),
                    ['prompt' => 'Selecione um idioma', 'class' => 'form-controlle', 'disabled' => true])->label(false) ?>
        <?php
        }
        else{ ?>
        <?=
            $form->field($model, 'idioma_id')->dropDownList(
                ArrayHelper::map(Idioma::find()->asArray()->all(), 'id', 'lingua_descricao'),
                ['prompt' => 'Selecione um idioma', 'class' => 'form-controlle', 'disabled' => false])->label(false);
        }
    ?>


    <?= $form->field($model, 'dificuldade_id')->radioList($arraydificuldade) ?>

    <?= $form->field($model, 'titulo_curso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curso_detalhe')->textInput(['maxlength' => true]) ?>

    <?php
    if(\Yii::$app->user->can('ToggleCourse')){ ?>
        <?=
        $form->field($model, 'status_ativo')->radioList([
            1 => 'Ativado',
            0 => 'Desativado'], ['itemOptions' => ['disabled' => true]]);
        ?>

        <?php
    }
    else{ ?>
    <?=
        $form->field($model, 'status_ativo')->radioList([
            1 => 'Ativado',
            0 => 'Desativado'], ['itemOptions' => ['disabled' => false]]);
    ?><?php
    }
    ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<!-- <div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Custom Elements</h3>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Dificuldade</h3>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="custom-control custom-radio">


                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" checked>
                                    <label for="customRadio2" class="custom-control-label">Custom Radio checked</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="customRadio3" disabled>
                                    <label for="customRadio3" class="custom-control-label">Custom Radio disabled</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input custom-control-input-danger" type="radio" id="customRadio4" name="customRadio2" checked>
                                    <label for="customRadio4" class="custom-control-label">Custom Radio with custom color</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" id="customRadio5" name="customRadio2">
                                    <label for="customRadio5" class="custom-control-label">Custom Radio with custom color outline</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-red">
                        <div class="card-header">
                            <h3 class="card-title">Idioma</h3>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input custom-control-input-danger" type="radio" id="customRadio4" name="customRadio2" checked>
                                    <label for="customRadio4" class="custom-control-label">Custom Radio with custom color</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" id="customRadio5" name="customRadio2">
                                    <label for="customRadio5" class="custom-control-label">Custom Radio with custom color outline</label>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Custom Select</label>
                <select class="custom-select">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Custom Select Disabled</label>
                <select class="custom-select" disabled>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Custom Select Multiple</label>
                <select multiple class="custom-select">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Custom Select Multiple Disabled</label>
                <select multiple class="custom-select" disabled>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 4</option>
                    <option>option 5</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="customSwitch1">
            <label class="custom-control-label" for="customSwitch1">Toggle this custom switch element</label>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
            <input type="checkbox" class="custom-control-input" id="customSwitch3">
            <label class="custom-control-label" for="customSwitch3">Toggle this custom switch element with custom colors danger/success</label>
        </div>
    </div>
    <div class="form-group">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
            <label class="custom-control-label" for="customSwitch2">Disabled custom switch element</label>
        </div>
    </div>
    <div class="form-group">
        <label for="customRange1">Custom range</label>
        <input type="range" class="custom-range" id="customRange1">
    </div>
    <div class="form-group">
        <label for="customRange2">Custom range (custom-range-danger)</label>
        <input type="range" class="custom-range custom-range-danger" id="customRange2">
    </div>
    <div class="form-group">
        <label for="customRange3">Custom range (custom-range-teal)</label>
        <input type="range" class="custom-range custom-range-teal" id="customRange3">
    </div>
    <div class="form-group">

        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>
    <div class="form-group">
    </div>
    </form>
</div>
</div> -->