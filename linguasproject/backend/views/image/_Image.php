<?php
/** @var $model app\models\ImagemResource */
/** @var $fullView boolean */
use yii\helpers\Html;
?>
<div class="col mb-3">
    <div class="card" style="width: 200px; margin: auto;">
        <?= Html::a(
            Html::img('@web/' . $model->nome_ficheiro, [
                'class' => 'card-img-top',
                'alt' => $model->nome_imagem,
                'style' => 'height:180px; object-fit:cover;'
            ]),
            ['image/view', 'id' => $model->id]
        ) ?>

        <div class="card-body text-center">
            <!-- Nome da imagem -->
            <h5 class="card-title mb-2"><?= Html::encode($model->nome_imagem) ?></h5>
<br><br>
            <!-- Botões logo abaixo do nome -->
            <div class="d-flex justify-content-center gap-2">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary w-75']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-danger w-75',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>

        <div class="card-footer text-center">
            <small class="text-body-secondary">Last updated 3 mins ago</small>
        </div>
    </div>
</div>


