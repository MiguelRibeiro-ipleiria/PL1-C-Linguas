<?php

/** @var common\models\Inscricao $model */
use yii\helpers\Url;


?>

<style>

    html, body { height: 100%; margin: 0; }
    body { display: flex; flex-direction: column; background-color: #f8f9fa; }
    .main-wrapper { flex: 1 0 auto; padding-bottom: 50px; }


    .visual-container {
        border-top: 3px solid #2ed06e !important;
        border-bottom: 3px solid #2ed06e !important;
        background-color: #fff;
        padding: 60px 40px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-top: 30px;
    }

    .badge-main-title {
        background-color: #1a252f !important;
        padding: 12px 40px !important;
        font-size: 1.1rem !important;
        margin-bottom: 50px;
        letter-spacing: 1px;
        color: white;
        font-weight: bold;
    }

    .progress-item-card {
        border: 1px solid #e0e0e0;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .course-pill {
        background-color: #1a252f;
        color: white;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: bold;
        min-width: 200px;
        text-align: center;
    }

    .progress-wrapper {
        flex-grow: 1;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .progresso-label {
        background-color: #2ed06e;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .bar-outer {
        flex-grow: 1;
        height: 10px;
        background-color: #eee;
        border-radius: 10px;
        overflow: hidden;
    }

    .bar-inner {
        height: 100%;
        transition: width 0.5s ease;
    }

    .perc-badge {
        color: white;
        padding: 8px 15px;
        border-radius: 30px;
        font-weight: bold;
        font-size: 0.9rem;
        min-width: 55px;
        text-align: center;
        display: inline-block;
    }

    .status-badge {
        background-color: #2ed06e;
        color: white;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: bold;
        min-width: 130px;
        text-align: center;
    }

    .site-footer {
        background-color: #0b1c24;
        color: white;
        padding: 30px 0;
        flex-shrink: 0;
    }
    .footer-divider { border-top: 1px solid rgba(255,255,255,0.1); margin: 15px 0; }
    .footer-bottom { display: flex; justify-content: space-between; font-size: 0.85rem; color: #bdc3c7; }
</style>


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
