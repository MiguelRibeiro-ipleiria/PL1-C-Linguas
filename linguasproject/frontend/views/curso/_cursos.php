<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Idioma;
use common\models\Dificuldade;

/** @var yii\web\View $this */
/** @var common\models\CursoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="curso-search">


    <div class="container">
        <aside class="col-lg-12 col-md-12 col-12">
            <div class="sidebar">
                <div class="filter popular-tag-widget">
                    <div class="tags">
                        <div class="row d-flex align-items-center g-0">
                            <div class="col-3 course-content-area">
                                <div class="card-header-flex">
                                    <h3 class="card-cursos-title"><?= $model->titulo_curso ?></h3>
                                </div>
                            </div>
                            <div class="col-5 course-content-area">
                                <div class="card-header-flex">
                                    <span class="cursos-detalhe level-badge"><?= $model->curso_detalhe ?></span>
                                </div>
                            </div>
                            <div class="col-2 cursos-grau-content-area">

                                <div class="card-header-flex">
                                    <?php
                                        if($model->dificuldade->grau_dificuldade == "Baixo"){ ?>
                                            <span class="cursos-custom-green level-badge"><?= $model->dificuldade->grau_dificuldade ?></span>

                                        <?php }
                                        elseif($model->dificuldade->grau_dificuldade == "Médio"){ ?>

                                            <span class="cursos-custom-yellow level-badge"><?= $model->dificuldade->grau_dificuldade ?></span>
                                        <?php
                                        }
                                        else{ ?>
                                            <span class="cursos-custom-red level-badge"><?= $model->dificuldade->grau_dificuldade ?></span>
                                        <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="col-1 cursos-content-area">
                                <div class="card-header-flex">
                                    <span class="cursos-custom level-badge"><?= $model->idioma->lingua_descricao ?></span>
                                </div>
                            </div>
                            <div class="col-1 d-flex justify-content-center align-items-center course-action-area">
                                <section class="intro-video-area section-idiomas-cursos">
                                    <div class="inner-content-head">
                                        <div class="inner-content">
                                            <?php

                                            if($model->status_ativo == 1 && \Yii::$app->user->can('SearchCourse')){ ?>
                                                <div class="intro-video-play">
                                                    <div class="play-thumb wow zoomIn" data-wow-delay=".2s">
                                                        <a href="<?= Url::to(['/inscricao/create', 'curso_id' => $model->id]) ?>"
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
            </div>
        </aside>
    </div>

</div>