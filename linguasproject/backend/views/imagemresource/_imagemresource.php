<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\Idioma $model */
?>

<style>
    .card-idioma:hover { transform: translateY(-1px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

</style>

<div class="col-md-6 col-lg-4 col-xl-3 mb-4">
    <div class="card h-100">

        <?= Html::a(
            Html::img(
                '../../../common/uploadImage/' . $model->nome_ficheiro,
                [
                    'class' => 'card-img-top',
                    'style' => 'height:180px; object-fit:cover;',
                    
                ]
            ),
            ['view', 'id' => $model->id]
        ) ?>

        <div class="card-body text-center">
            <h5 class="card-title">
                <?= Html::encode($model->nome_imagem) ?>

            </h5>

            <p class="card-text">
                
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
