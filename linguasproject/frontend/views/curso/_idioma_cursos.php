<?php
use yii\helpers\Url;
/** @var common\models\Curso $model */

$link_video = "https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM";
$link_inscricao = Url::to(['curso/inscrever', 'id' => $model->id]); // Exemplo de link de inscrição
?>



<div class="container my-4">
    <div class="course-detail-card">
        <div class="row d-flex align-items-center g-0">

            <div class="col-9 course-content-area">

                <div class="card-header-flex">
                    <h3 class="card-course-title"><?= $model->titulo_curso ?></h3>
                    <span class="badge-custom level-badge"><?= $model->dificuldade->grau_dificuldade ?></span>
                    <span class="badge-custom classes-badge">2 aulas</span>
                </div>
                <p class="card-course-description mt-2">
                    <?= $model->curso_detalhe ?>
                </p>
            </div>

            <div class="col-3 d-flex justify-content-center align-items-center course-action-area">
                <section class="intro-video-area section-idiomas-cursos">
                    <div class="inner-content-head">
                        <div class="inner-content">
                            <div class="intro-video-play">
                                <div class="play-thumb wow zoomIn" data-wow-delay=".2s">
                                    <a href="<?= Url::to(['/curso/index']) ?>"
                                       ><i class="lni lni-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>