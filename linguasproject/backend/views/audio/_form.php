<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\AudioResource;

/** @var yii\web\View $this */
/** @var common\models\Audio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="audio-form">

    <?php $form = ActiveForm::begin(); 
     $arrayAudios = ArrayHelper::map(AudioResource::find()->asArray()->all(), 'id', 'nome_ficheiro');      
    ?>

    <?= $form->field($model, 'audio_resource_id')->dropDownList($arrayAudios) ?>



    <?= $form->field($model, 'pergunta')->textInput(['maxlength' => true]) ?>

    <h3>Opções da IA</h3>
    <?php foreach ($opcoes as $i => $opcao){ ?>

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
