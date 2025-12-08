<?php
use yii\helpers\Url;
use common\models\Inscricao;
use \common\models\Utilizador;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var common\models\Curso $model */

?>

<div class="container my-4">
        <div class="course-detail-card">
            <div class="row d-flex align-items-center g-0">

                <div class="col-8 course-content-area">

                    <div class="card-header-flex">
                        <h3 class="card-course-title"><?= $model->titulo_curso ?></h3>
                        <span class="badge-custom level-badge"><?= $model->dificuldade->grau_dificuldade ?></span>
                        <span class="badge-custom classes-badge">2 aulas</span>

                    </div>
                    <p class="card-course-description mt-2">
                        <?= $model->curso_detalhe ?>
                    </p>
                </div>

                <?php
                    if(\Yii::$app->user->can('SearchCourse') && (Inscricao::verificainscricao($model->id, Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one()))){ ?>
                        <div class="col-4 d-flex justify-content-center align-items-center course-action-area">
                            <section class="intro-video-area section-idiomas-cursos">
                                <div class="inner-content-head">
                                    <div class="inner-content">
                                        <div class="button home-btn">
                                            <?php
                                            if($model->status_ativo == 0){ ?>
                                                <div class="button">
                                                    <a class="styliesh-off">Desativado</a>
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

                <?php
                    }else{
                        if($model->status_ativo == 0){ ?>
                            <div class="col-4 d-flex justify-content-center align-items-center course-action-area">
                                <section class="intro-video-area section-idiomas-cursos">
                                    <div class="inner-content-head">
                                        <div class="inner-content">
                                            <div class="button home-btn">
                                                <div class="button">
                                                    <a class="styliesh-off">Desativado</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        <?php
                        }else{
                        ?>
                        <div class="col-3 d-flex justify-content-center align-items-center course-action-area">
                            <section class="intro-video-area section-idiomas-cursos">
                                <div class="inner-content-head">
                                    <div class="inner-content">
                                        <div class="button home-btn">
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
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                            <?php
                        }
                            ?>
                        <div class="col-1 d-flex justify-content-center align-items-center course-action-area">
                            <section class="intro-video-area section-idiomas-cursos">
                                <div class="inner-content-head">
                                    <div class="inner-content">
                                        <div class="button home-btn">
                                            <div class="button">

                                                <?php
                                                  if($model->status_ativo == 1){ ?>
                                                      <a href="<?= Url::to(['/curso/aulas', 'id' => $model->id]) ?>" class="styliesh"><i class="bi bi-arrow-right"></i></a>
                                                <?php
                                                  }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    <?php
                    }
                ?>
            </div>
        </div>
</div>
