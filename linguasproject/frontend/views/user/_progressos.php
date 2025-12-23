<?php

/** @var common\models\Inscricao $model */


?>

<style>

    html, body { height: 100%; margin: 0; }
    body { display: flex; flex-direction: column; background-color: #f8f9fa; }
    .main-wrapper { flex: 1 0 auto; padding-bottom: 50px; }


    .visual-container {
        border-top: 3px solid #2ecc71 !important;
        border-bottom: 3px solid #2ecc71 !important;
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
        background-color: #2ecc71;
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
        background-color: #2ecc71;
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


<div class="progress-list">
    <div class="progress-item-card">
        <div class="course-pill">
            <?= $model->curso->titulo_curso ?>
        </div>

        <div class="progress-wrapper">
            <span class="progresso-label">Progresso</span>
            <div class="bar-outer">
                <div class="bar-inner" style="width: 100 %; background-color: #00ff7f;"></div>
            </div>

            <span class="perc-badge" style="background-color: #fff;">
            </span>
        </div>

        <div class="status-badge">
            <?= $model->estado ?>
        </div>
    </div>
</div>
