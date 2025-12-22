<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Idioma;
use common\models\Dificuldade;
use common\models\Inscricao;
use \common\models\Utilizador;


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
                                        <div class="card-header-flex justify-content-center">
                                            <h3 class="card-cursos-title align-items-center "><?= $model->titulo_curso ?></h3>
                                        </div>
                                    </div>
                                    <div class="col-4 course-content-area">
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
                                    <div class="col-2 d-flex justify-content-end align-items-end course-action-area">
                                        <section class="intro-video-area section-idiomas-cursos">
                                            <div class="inner-content-head">
                                                <div class="inner-content">
                                                    <div class="button home-btn">
                                                        <?php
                                                        if(\Yii::$app->user->isGuest){ ?>
                                                            <div class="button">
                                                                <a href="<?= Url::to(['/site/login']) ?>" class="styliesh">Inscrever-me</a>
                                                            </div>
                                                        <?php }
                                                        elseif(\Yii::$app->user->can('SearchCourse') && !(Inscricao::verificainscricao($model->id, Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one()))){ ?>
                                                            <div class="button">

                                                                <?php
                                                                    $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one();
                                                                    $form = ActiveForm::begin(['action' => ['/inscricao/delete', 'utilizador_id' => $utilizador->id,'curso_idcurso' => $model->id]]); ?>
                                                                    <?= Html::submitButton(
                                                                        'Desinscrever',
                                                                        [
                                                                            'class' => 'styliesh-red',
                                                                        ]
                                                                    ) ?>

                                                                <?php ActiveForm::end(); ?>
                                                            </div>
                                                        <?php }
                                                        else{ ?>
                                                            <div class="button">
                                                                <a href="<?= Url::to(['/inscricao/create', 'curso_id' => $model->id]) ?>" class="styliesh">Inscrever-me</a>
                                                            </div>
                                                        <?php }

                                                        ?>
                                                    </div>
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