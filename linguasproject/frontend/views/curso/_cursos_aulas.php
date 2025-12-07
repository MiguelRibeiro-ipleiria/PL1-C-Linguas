<?php
use yii\helpers\Url;
/** @var common\models\Aula $model */

?>
<div class="container my-4">
    <div class="course-detail-card">
        <div class="row d-flex align-items-center g-0">

            <div class="col-9 course-content-area">

                <div class="card-header-flex">
                    <h3 class="card-course-title"><?= $model->titulo_aula ?></h3>
                    <span class="badge-custom level-badge"><?= $model->tempo_estimado ?></span>
                    <span class="badge-custom classes-badge"><?= $model->numero_de_exercicios ?> exercícios</span>
                </div>
                <p class="card-course-description mt-2">
                    <?= $model->descricao_aula ?>
                </p>
            </div>

            <div class="col-3 d-flex justify-content-center align-items-center course-action-area">
                <section class="intro-video-area section-idiomas-cursos">
                    <div class="inner-content-head">
                        <div class="inner-content">
                            <div class="button home-btn">
                                <div class="button">
                                    <a href="<?= Url::to(['/aula/view', 'id' => $model->id]) ?>" class="styliesh">Ver aula</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>