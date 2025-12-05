<?php

/** @var common\models\Comentario $model */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<aside class="col-lg-12 col-md-12 col-12">
    <div class="sidebar">
        <div class="filter popular-tag-widget">
            <div class="tags comment-card-relative">

                <div class="row g-0">
                    <div class="col-12">
                        <div class="card-header-aula">
                            <h3 class="card-comment-title"><?= $model->utilizador->user->username ?></h3>
                            <h3 class="card-comment-subtitle"><?= $model->hora_criada ?></h3>
                        </div>
                        <p class="card-comment-description mt-2">
                            <?= $model->descricao_comentario ?></p>
                    </div>
                </div>

                <?php
                    if($model->utilizador->user->id == Yii::$app->user->identity->id){ ?>
                        <div class="delete-icon-absolute">
                            <?php $form = ActiveForm::begin(['action' => ['/comentario/delete', 'id' => $model->id]]); ?>

                            <div class="form-group">
                                <?= Html::submitButton(
                                    '<i class="bi bi-trash-fill icon-comment-delete"></i>',
                                    [
                                        'class' => 'btn p-0 m-0 border-0 bg-transparent shadow-none',
                                        'style' => 'color: inherit;'
                                    ]
                                ) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </div>
</aside>
