<?php
use yii\helpers\Url;
/** @var common\models\Curso $model */

?>

<div class="container my-4">
    <div class="course-detail-card">
        <div class="row d-flex align-items-center g-0">

            <div class="col-9 course-content-area">

                <div class="card-header-flex">
                    <h3 class="card-course-title"><?= $model->titulo_curso ?></h3>
                    <span class="badge-custom level-badge"><?= $model->dificuldade->grau_dificuldade ?></span>
                    <span class="badge-custom classes-badge">2 aulas</span>
                    <?php

                    if($model->status_ativo == 0){ ?>
                        <span class="badge-red classes-bagde">Desativado</span>
                    <?php
                    }
                    else{
                        
                    }
                    ?>
                </div>
                <p class="card-course-description mt-2">
                    <?= $model->curso_detalhe ?>
                </p>
            </div>

            <div class="col-3 d-flex justify-content-center align-items-center course-action-area">
                <section class="intro-video-area section-idiomas-cursos">
                    <div class="inner-content-head">
                        <div class="inner-content">

                            <?php

                                if($model->status_ativo == 1){ ?>
                                    <div class="intro-video-play">
                                        <div class="play-thumb wow zoomIn" data-wow-delay=".2s">
                                            <a href="<?= Url::to(['/curso/aulas', 'id' => $model->id]) ?>"
                                            ><i class="lni lni-play"></i></a>
                                        </div>
                                    </div>
                                <?php
                                }
                                else{ ?>
                                    <div class="intro-video-play">
                                        <div class="play-thumb wow zoomIn" data-wow-delay=".2s">
                                            <i class="lni lni-play"></i>
                                        </div>
                                    </div>
                                <?php
                                }
                            ?>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>