<?php

/** @var common\models\Inscricao $model */
use yii\helpers\Url;


?>


<a href="<?= Url::to(['/curso/idiomacursos', 'id' => $model->curso->idioma->id]) ?>" class="lesson-link">
    <div class="progress-list">
        <div class="progress-item-card">
            <div class="course-pill">
                <?= $model->curso->titulo_curso ?>
            </div>

            <div class="progress-wrapper">
                <span class="progresso-label">Progresso</span>
                <?php

                    $numero_de_aulas_terminadas_no_curso = $model->CountResultadoDaInscricaoDoCurso($model->curso->id, $model->utilizador_id);
                    $numero_total_aulas = 1;
                    if(count($model->curso->aulas) != 0){
                        $numero_total_aulas = count($model->curso->aulas);
                    }
                    $percentagem_final = (int)(($numero_de_aulas_terminadas_no_curso / $numero_total_aulas) * 100);

                    if($percentagem_final == 0 && $percentagem_final < 25){ ?>

                        <div class="bar-outer">
                            <div class="bar-inner" style="width: <?= $percentagem_final ?>%; background-color: #c82222;"></div>
                        </div>
                        <span class="perc-badge" style="background-color: #c82222;"><?= $percentagem_final ?>%</span>

                    <?php }
                    elseif($percentagem_final >= 25 && $percentagem_final < 50){ ?>

                        <div class="bar-outer">
                            <div class="bar-inner" style="width: <?= $percentagem_final ?>%; background-color: #c9cf12;"></div>
                        </div>
                        <span class="perc-badge" style="background-color: #c9cf12;"><?= $percentagem_final ?>%</span>

                    <?php }
                    elseif($percentagem_final >= 50 && $percentagem_final < 75){ ?>

                        <div class="bar-outer">
                            <div class="bar-inner" style="width: <?= $percentagem_final ?>%; background-color: #f1681d;"></div>
                        </div>
                        <span class="perc-badge" style="background-color: #f1681d;"><?= $percentagem_final ?>%</span>

                    <?php }
                    elseif($percentagem_final >= 75 && $percentagem_final <= 100){ ?>

                        <div class="bar-outer">
                            <div class="bar-inner" style="width: <?= $percentagem_final ?>%; background-color: #2ed06e;"></div>
                        </div>
                        <span class="perc-badge" style="background-color: #2ed06e;"><?= $percentagem_final ?>%</span>

                    <?php }

                ?>
            </div>

            <div class="status-badge">
                <?= $model->estado ?>
            </div>
        </div>
    </div>
</a>
