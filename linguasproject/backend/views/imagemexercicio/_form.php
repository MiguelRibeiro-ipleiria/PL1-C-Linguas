<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ImagemResource;

/** @var yii\web\View $this */
/** @var common\models\imagemexercicio $model */
/** @var common\models\Imagemexercicio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="imagemexercicio-form">

    
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']]);

        $arrayImagens = ArrayHelper::map(ImagemResource::find()->asArray()->all(), 'id', 'nome_ficheiro');      
                            
    ?>

    
    <?= $form->field($model, 'imagem_resource_id')->dropDownList($arrayImagens) ?>

    <?= $form->field($model, 'pergunta')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
