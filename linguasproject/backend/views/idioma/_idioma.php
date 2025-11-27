<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \common\models\Idioma $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="col-md-6 col-lg-4 col-xl-3 mb-4 px-2">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" >
                <?= Html::a(
        Html::img('@web/UploadBanders/' . $model->lingua_bandeira,[ 
                'class' => 'card-img-top',
                'style' => 'height:180px;width:240px; object-fit:cover;'])
        ) ?>
        <div class="card-body">
            <h5 class="card-title"><?= Html::encode($model->lingua_descricao) ?> - <?= Html::encode($model->lingua_sigla) ?></h5>
            <p class="card-text"><?= Html::encode($model->lingua_objetivo) ?></p>
        </div>
        <div class="card-footer d-flex justify-content-center p-0 border-top-0">
            <a class="btn btn-outline border-0 rounded-0 flex-fill p-3" href="<?= Url::to(['/idioma/view', 'id' => $model->id]) ?>">
                <i class="fas fa-eye"></i>
            </a>
            <a class="btn btn-outline border-0 rounded-0 flex-fill p-3 border-left border-right" href="<?= Url::to(['/idioma/update', 'id' => $model->id]) ?>">
                <i class="fas fa-pen"></i>
            </a>
            <a class="btn btn-outline border-0 rounded-0 flex-fill p-3" href="<?= Url::to(['/idioma/delete', 'id' => $model->id]) ?>" title="Eliminar" data-confirm="Tem certeza de que deseja eliminar este item?" data-method="post">
                <i class="fas fa-trash"></i>
            </a>
        </div>

    </div>
</div>