<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Idioma;
use common\models\Dificuldade;

/** @var yii\web\View $this */
/** @var common\models\CursoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="curso-search">


    <div class="container">
        <aside class="col-lg-12 col-md-12 col-12">
            <div class="sidebar">
                <div class="filter popular-tag-widget">
                    <div class="tags">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                        ]); ?>
                        <div class="row align-items-end"> <div class="col-lg-3 col-md-6 col-sm-6">
                                <?= $form->field($model, 'idioma_id')->dropDownList(ArrayHelper::map(Idioma::find()->asArray()->all(), 'id', 'lingua_descricao'),
                                    ['prompt' => 'Idioma', 'class' => 'form-filter']
                                )->label(false) ?>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <?= $form->field($model, 'dificuldade_id')->dropDownList(ArrayHelper::map(Dificuldade::find()->asArray()->all(), 'id', 'grau_dificuldade'),
                                    ['prompt' => 'Dificuldade', 'class' => 'form-filter']
                                )->label(false) ?>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <?= $form->field($model, 'titulo_curso')->textInput(['class' => 'form-filter',
                                    'placeholder' => 'Título'])->label(false) ?>
                            </div>

                            <div class="button col-lg-3 col-md-6 col-sm-6 d-flex justify-content-end">
                                <?= Html::submitButton('Search', ['class' => 'btn']) ?>
                                <?= Html::resetButton('Reset', ['class' => 'btn-red']) ?>
                            </div>

                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </aside>
    </div>

</div>