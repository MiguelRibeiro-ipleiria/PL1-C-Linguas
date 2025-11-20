<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\Idioma $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="col-md-12 col-lg-6 col-xl-4">
    <div class="card mb-2">
        <img class="card-img-top" src="<?= Html::encode($model->lingua_bandeira) ?>" alt="Dist Photo 2">

        <div class="card-img-overlay d-flex flex-column justify-content-center">
            <h5 class="card-title text-white mt-5 pt-2">
                <?= Html::encode($model->lingua_descricao) ?>
            </h5>

            <p class="card-text pb-2 pt-1 text-white">
                <?= Html::encode($model->lingua_sigla) ?>
            </p>

            <p class="card-text text-white">
                <?= Html::encode($model->data_criacao) ?>
            </p>
        </div>
    </div>
</div>
