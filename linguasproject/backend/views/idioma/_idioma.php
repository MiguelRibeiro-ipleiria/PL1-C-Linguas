<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\Idioma $model */
?>

<div class="col-md-6 col-lg-4 col-xl-3 mb-4">
    <div class="card h-100">

        <?= Html::a(
            Html::img(
                '../../../common/UploadBandeiras/' . $model->lingua_bandeira,
                [
                    'class' => 'card-img-top',
                    'style' => 'height:180px; object-fit:cover;',
                    'alt' => $model->lingua_descricao
                ]
            ),
            ['view', 'id' => $model->id]
        ) ?>

        <div class="card-body text-center">
            <h5 class="card-title">
                <?= Html::encode($model->lingua_descricao) ?>
                <small class="text-muted"> (<?= Html::encode($model->lingua_sigla) ?>)</small>
            </h5>

            <p class="card-text">
                <?= Html::encode($model->lingua_objetivo) ?>
            </p>
        </div>

        <div class="card-footer d-flex justify-content-center p-0 border-top-0">
            <a class="btn btn-outline border-0 rounded-0 flex-fill p-3"
               href="<?= Url::to(['view', 'id' => $model->id]) ?>">
                <i class="fas fa-eye"></i>
            </a>

            <a class="btn btn-outline border-0 rounded-0 flex-fill p-3 border-left border-right"
               href="<?= Url::to(['update', 'id' => $model->id]) ?>">
                <i class="fas fa-pen"></i>
            </a>

            <a class="btn btn-outline border-0 rounded-0 flex-fill p-3"
               href="<?= Url::to(['delete', 'id' => $model->id]) ?>"
               data-confirm="Tem certeza de que deseja eliminar este item?"
               data-method="post">
                <i class="fas fa-trash"></i>
            </a>
        </div>

    </div>
</div>
