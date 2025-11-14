<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\Idioma $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card">
    <img src="<?= Html::encode($model->lingua_bandeira) ?>" class="card-img-top" alt="<?= Html::encode($model->lingua_descricao) ?>">
    <div class="card-body">
        <h5 class="card-title"><?= Html::encode($model->lingua_descricao) ?></h5>
        <p class="card-text"> <?= Html::encode($model->lingua_sigla) ?></p>
    </div>
    <div class="card-footer">
        <small class="text-body-secondary">Last updated 3 mins ago</small>
    </div>
</div>