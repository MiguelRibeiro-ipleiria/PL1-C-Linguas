<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\aula;
use common\models\User;

/** @var yii\web\View $this */
/** @var common\models\comentario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comentario-form">

    <?php $form = ActiveForm::begin(); 
    
    $arrayaulas = ArrayHelper::map(aula::find()->all(), 'id', 'titulo_aula');
        
    ?>

        <?= $form->field($model, 'descricao_comentario')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'aula_id')->dropDownlist($arrayaulas) ?>

        <?= $form->field($model, 'utilizador_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
