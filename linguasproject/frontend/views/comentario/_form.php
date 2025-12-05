<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Comentario $model */
/** @var common\models\Aula $aula    */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="form">

    <?php $form = ActiveForm::begin(['action' => ['comentario/create'],'options' => ['method' => 'post']]); ?>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <label class="label-comment">Autor*</label>
            <div class="form-group">
                <r><input disabled type="text" placeholder="<?php
                    if (Yii::$app->user->isGuest) {
                        echo "Utilizador não autenticado";
                    } else {
                        echo Yii::$app->user->identity->username;
                    }
                    ?>"</r>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="comment-container">
                    <?= $form->field($model, 'descricao_comentario')->textarea(['maxlength' => true, 'rows' => 6, 'placeholder' => 'Escreva aqui o seu comentário'])->label('Comentário*') ?>
                    <?= $form->field($model, 'aula_id')->hiddenInput(['value' => $aula->id])->label(false) ?>

                    <div class="button">
                        <?= Html::submitButton('Enviar Comentário', ['class' => 'btn btn-success button']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
