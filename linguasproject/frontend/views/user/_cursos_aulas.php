<?php

use yii\helpers\Url;
use common\models\Resultado;
/** @var common\models\Inscricao $model */

?>


<div class="course-wrapper">
    <div class="language-tag"><?= $model->cursoIdcurso->idioma->lingua_descricao ?></div>

    <div class="row">
        <div class="col-md-5">
            <div class="course-main-info"><?= $model->cursoIdcurso->titulo_curso ?></div>
            <div class="info-badge">Inscrito desde <?= $model->data_inscricao ?></div>
            <div class="info-badge">Estado atual: <?= $model->estado ?></div>
        </div>

        <div class="col-md-7">

            <?php

                foreach ( $model->cursoIdcurso->aulas as $aula) {
                    $resultado = Resultado::find()->where(['aula_idaula' => $aula->id, 'utilizador_id' => $model->utilizador_id])->one();

                    if($resultado != null){

                        if($resultado->estado == "Terminada"){ ?>

                        <a href="<?= Url::to(['/aula/view', 'id' => $aula->id]) ?>" class="lesson-link">
                            <div class="lesson-card">
                                <div>
                                    <span class="lesson-title"><?= $resultado->aulaIdaula->titulo_aula ?></span>
                                    <span class="status-pill status-active"><?= $resultado->estado ?></span>
                                    <span class="time-pill"><?= $resultado->tempo_estimado ?> s</span>
                                    <span class="date-text"><?= $resultado->data_inicio ?> - <?= $resultado->data_fim ?></span>
                                </div>
                                <div class="score-circle"><?= $resultado->nota ?> / 100</div>
                            </div>
                        </a>

                        <?php }elseif($resultado->estado == "Por começar"){ ?>

                        <a href="<?= Url::to(['/aula/view', 'id' => $aula->id]) ?>" class="lesson-link">
                            <div class="lesson-card">
                                <span class="lesson-title"><?= $resultado->aulaIdaula->titulo_aula ?></span>
                                <span class="status-pill status-active"><?= $resultado->estado ?></span>
                            </div>
                        </a>

                        <?php }elseif($resultado->estado == "Agendada"){ ?>

                        <a href="<?= Url::to(['/aula/view', 'id' => $aula->id]) ?>" class="lesson-link">
                            <div class="lesson-card">
                                <div>
                                    <span class="lesson-title"><?= $resultado->aulaIdaula->titulo_aula ?></span>
                                    <span class="status-pill status-active"><?= $resultado->estado ?></span>
                                    <span class="date-text" style="color:#555; font-weight:800;"><?= $resultado->data_agendamento ?></span>
                                </div>
                                <?php
                                    $hoje = date('Y-m-d H:i:s');

                                    if($resultado->data_agendamento > $hoje) {

                                        $data_agendamento = strtotime($resultado->data_agendamento);
                                        $data_hoje = strtotime($hoje);
                                        $intervalo = $data_agendamento - $data_hoje;


                                        if(($intervalo / 60) < 1){ ?>
                                            <div class="score-circle"><?= (int)($intervalo)  ?>s</div>
                                        <?php }elseif (($intervalo / 60) >= 60){ ?>
                                            <div class="score-circle"><?= (int)(($intervalo / 60) / 60) ?>h</div>
                                        <?php }elseif(($intervalo / 60) < 60){ ?>
                                            <div class="score-circle"><?= (int)($intervalo / 60) ?>m</div>
                                        <?php }
                                    }
                                    else{ ?>
                                        <div class="score-circle"> Falhou </div>
                                    <?php }

                                ?>

                            </div>
                        </a>
                        <?php
                        }
                    }


                }?>


<!--            <div class="lesson-card">-->
<!--                <div>-->
<!--                    <span class="lesson-title">Advérbios</span>-->
<!--                    <span class="status-pill status-active">Agendada</span>-->
<!--                    <span class="date-text" style="color:#4ade80; font-weight:800;">02/11/2025 - 14h00</span>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</div>
