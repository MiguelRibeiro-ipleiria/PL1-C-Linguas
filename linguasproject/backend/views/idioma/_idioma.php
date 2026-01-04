<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\Idioma $model */
?>

<style>
    .card-idioma:hover { transform: translateY(-1px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    
    .btn-hover-view:hover { background-color: #17a2b8; color: #fff} 
    .btn-hover-update:hover { background-color: #ffc107; color: #fff} 
    .btn-hover-delete:hover { background-color: #dc3545; color: #fff; } 
</style>

<div class="col-md-6 col-lg-4 col-xl-3 mb-4">
    <div class="card h-100 card-idioma">

        <?= Html::a(
            Html::img(
                '../../../common/UploadBandeiras/' . $model->lingua_bandeira,
                [
                    'class' => 'card-img-top',
                    'style' => 'height:180px; object-fit:cover; border-bottom: 1px solid #eee;',
                    'alt' => $model->lingua_descricao
                ]
            ),
            ['view', 'id' => $model->id]
        ) ?>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="card-title m-0 font-weight-bold">
                    <?= Html::encode($model->lingua_descricao) ?>
                </h5>
                <span class="badge badge-secondary p-2">
                    <?= Html::encode($model->lingua_sigla) ?>
                </span>
            </div>

            <p class="card-text text-muted small" style="min-height: 40px;">
                <?= Html::encode($model->lingua_objetivo) ?>
            </p>
        </div>

        <div class="card-footer d-flex p-0 border-top">
            <a class="btn btn-light rounded-0 flex-fill p-3 btn-hover-view"
               href="<?= Url::to(['view', 'id' => $model->id]) ?>" title="Ver">
                <i class="fas fa-eye"></i>
            </a>

            <a class="btn btn-light rounded-0 flex-fill p-3 border-left border-right btn-hover-update"
               href="<?= Url::to(['update', 'id' => $model->id]) ?>" title="Editar">
                <i class="fas fa-pen"></i>
            </a>

            <a class="btn btn-light rounded-0 flex-fill p-3 btn-hover-delete"
               href="<?= Url::to(['delete', 'id' => $model->id]) ?>"
               data-confirm="Tem certeza de que deseja eliminar este item?"
               data-method="post" title="Apagar">
                <i class="fas fa-trash"></i>
            </a>
        </div>

    </div>
</div>