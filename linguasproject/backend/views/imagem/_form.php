<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ImagemResource;

/** @var yii\web\View $this */
/** @var common\models\Imagem $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="imagemexercicio-form">

    
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']]);

        $arrayImagens = ArrayHelper::map(ImagemResource::find()->asArray()->all(), 'id', 'nome_ficheiro');      
    
    ?>

    <?php
    if($aula_id == null){?>

        <?=$form->field($model, 'aula_id')->dropDownList($arrayaulas)?>
    <?php
    }
    ?>


    <?=$form->field($model, 'tipoexercicio_id')->dropDownList($arrayTipoexercicio)?>

    <?= $form->field($model, 'imagem_resource_id')->dropDownList($arrayImagens) ?>

    <?= $form->field($model, 'pergunta')->textInput(['maxlength' => true]) ?>


    <h3>Opções</h3>
    <?php
    foreach ($opcoes as $i => $opcao){ ?>

    <div class="card" style="padding: 10px; margin-bottom: 15px;">
        <h4>Opção <?= $i+1 ?></h4>

        <?= $form->field($opcao, "[$i]descricao")->textInput(['maxlength' => true]) ?>
        <?= $form->field($opcao, "[$i]iscorreta")->checkbox() ?>
    </div>

    <?php }?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

