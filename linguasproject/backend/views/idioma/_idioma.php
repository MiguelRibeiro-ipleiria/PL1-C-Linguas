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
        <img class="card-img-top" src="<?= Html::encode($model->lingua_bandeira) ?>" alt="<?= Html::encode($model->lingua_descricao) ?>">
        <div class="card-body">
            <h5 class="card-title"><?= Html::encode($model->lingua_descricao) ?> - <?= Html::encode($model->lingua_sigla) ?></h5>
            <p class="card-text"><?= Html::encode($model->lingua_objetivo) ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <a class="button" href="<?= Url::to(['/idioma/view', 'id' => $model->id]) ?>"><li class="list-group-item"><i class="fas fa-eye"></i>&nbsp;&nbsp;&nbsp;Ver Idioma</li></a>
            <a class="button" href="<?= Url::to(['/idioma/update', 'id' => $model->id]) ?>"><li class="list-group-item"><i class="fas fa-pen"></i>&nbsp;&nbsp;&nbsp;Atualizar Idioma</li></a>
            <a class="button" href="<?= Url::to(['/idioma/delete', 'id' => $model->id]) ?>"><li class="list-group-item"><i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;Eliminar Idioma</li></a>
        </ul>
    </div>
</div>