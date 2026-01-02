<?php

/** @var common\models\Comentario $model */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php

    $resultados = \common\models\Resultado::find()->where(['utilizador_id' => $model->utilizador_id])->all();
    foreach ($resultados as $resultado) {
        if($resultado->aula_idaula == $model->aula_id){ ?>
            <a href="<?= Url::to(['/aula/view', 'id' => $model->aula->id]) ?>" class="lesson-link">
                <span class="status-pill status-active"><?= $model->aula->titulo_aula?> ( <?= $model->aula->curso->idioma->lingua_descricao ?> )</span>
                <br>
                <br>
                <div class="col-12  mb-3"> <div class="comment-card-compact">
                        <div class="tags comment-card-relative p-3"> <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-header-aula d-flex align-items-center gap-2">
                                        <h3 class="card-comment-title" style="font-size: 1.1rem;"><?= Html::encode($model->utilizador->user->username) ?></h3>
                                        <span class="card-comment-subtitle " style="font-size: 0.85rem;"><?= $model->hora_criada ?></span>
                                    </div>
                                    <p class="card-comment-description mt-2 mb-0">
                                        <?= Html::encode($model->descricao_comentario) ?>
                                    </p>
                                </div>
                                <?php if($model->utilizador->user->id == Yii::$app->user->identity->id): ?>
                                    <div class="delete-icon-absolute">
                                        <?php $form = ActiveForm::begin([
                                            'action' => ['/comentario/delete', 'id' => $model->id],
                                            'options' => ['style' => 'margin:0; padding:0;']
                                        ]); ?>
                                        <?= Html::submitButton(
                                            '<i class="bi bi-trash-fill icon-comment-delete"></i>',
                                            [
                                                'class' => 'btn p-0 m-0 border-0 bg-transparent shadow-none',
                                                'style' => 'color: #dc3545; font-size: 1.1rem;' // Cor vermelha para o lixo
                                            ]
                                        ) ?>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>
            </a>

        <?php }
    }

?>
