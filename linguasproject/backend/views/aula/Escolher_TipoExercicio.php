<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container text-center">
    <h3 class="mb-4">Escolha o tipo de exercício</h3>
    
    <div class="d-flex justify-content-center gap-3">
        <?= Html::a('Imagens', Url::to(['imagem/create', 'aula_id' => $aula_id]), [
            'class' => 'btn btn-primary btn-lg px-4'
        ]) ?>

        <?= Html::a('Frases', Url::to(['frase/create', 'aula_id' => $aula_id]), [
            'class' => 'btn btn-success btn-lg px-4'
        ]) ?>

        <?= Html::a('Áudios', Url::to(['audio/create', 'aula_id' => $aula_id]), [
            'class' => 'btn btn-info btn-lg px-4 text-white'
        ]) ?>
    </div>
</div>