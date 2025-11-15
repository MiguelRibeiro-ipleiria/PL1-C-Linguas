<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Feedback $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <?= $form->field($model, 'assunto_feedback')->textInput(['maxlength' => true, 'placeholder' => 'Assunto do seu feedback']) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <label>Autor*</label>
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
        <div class="col-12">
            <?= $form->field($model, 'descricao_feedback')->textarea(['maxlength' => true, 'placeholder' => 'Mensagem de feedback']) ?>
        </div>
    </div>
    <div class="button">
        <?php
            if (Yii::$app->user->isGuest) {?>
                <?= Html::submitButton('Enviar Feedback', ['class' => 'btn btn-success', 'disabled' => true]) ?>
                <label>Inicie Sessão para enviar um feedback!</label>
            <?php }
            else { ?>
                <?= Html::submitButton('Enviar Feedback', ['class' => 'btn btn-success']) ?>
            <?php } ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
