<?php
use yii\helpers\Html;

/** @var yii\data\ActiveDataProvider $dataProviderInscricoes */
/** @var yii\data\ActiveDataProvider $dataProviderResultados */

?>

<style>
    .profile-content-container {
        background-color: #f8f9fa;
        padding: 60px 0; 
        min-height: 90vh;
    }

    .main-card {
        background: #ffffff; /* Adicione o ponto e vírgula aqui */
        border-radius: 1.5%;
        box-shadow: 0 4px 25px rgba(0,0,0,0.08);
        padding: 40px;
        max-width: 1200px;
        margin: 40px auto;

        border-top: 4px solid #4ade80;
        border-bottom: 4px solid #4ade80;

        position: relative;
        overflow: hidden; /* Opcional: garante que o conteúdo não saia das bordas arredondadas */
    }

    .section-header {
        background: #1a2333;
        color: white;
        width: fit-content;
        padding: 12px 45px;
        border-radius: 50px;
        margin: 0 auto 50px auto;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 18px;
    }

    .course-wrapper {
        border: 2px solid #f0f2f5;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 35px;
        position: relative;
        background: #f8f8f8;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    .language-tag {
        position: absolute;
        top: -15px;
        left: 25px;
        background: #4ade80;
        color: white;
        padding: 6px 25px;
        border-radius: 50px;
        font-weight: bold;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(74, 222, 128, 0.3);
    }

    .course-main-info {
        background: #1a2333;
        color: white;
        padding: 14px 28px;
        border-radius: 12px;
        display: inline-block;
        min-width: 280px;
        font-weight: bold;
        margin-bottom: 20px;
        font-size: 17px;
    }

    .info-badge {
        background: #4ade80;
        color: white;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
        width: fit-content;
    }

    .lesson-card {

        border-top: 2px solid #2ed06e;
        border-bottom: 2px solid #2ed06e;

        border-right: 1.5px solid #eef2f7;
        border-left: 1.5px solid #eef2f7;

        border-radius: 18px;
        padding: 18px 25px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
        box-shadow: 0 4px 5px rgba(74, 222, 128, 0.3);

    }


    /* Remove sublinhados, cores de link e garante que o card ocupe o espaço */
    .lesson-link {
        text-decoration: none !important;
        display: block; /* Essencial para o card não encolher */
        color: inherit; /* Faz o link usar a cor do texto definida no card */
        transition: transform 0.2s ease;
    }

    /* Efeito opcional: leve destaque ao passar o rato */
    .lesson-link:hover {
        text-decoration: none;
        transform: translateY(-3px); /* O card sobe ligeiramente */
    }

    /* Garante que o título dentro do link mantenha a cor verde */
    .lesson-link:hover .lesson-title {
        color: #2ed06e;
    }


    .lesson-title { color: #4ade80; font-weight: 800; font-size: 16px; margin-right: 12px; }
    
    .status-pill {
        padding: 5px 18px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: bold;
        color: white;
        text-transform: capitalize;
    }
    
    .status-active { background: #4ade80; }

    .time-pill {
        background: #333;
        color: white;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 12px;
        margin-left: 10px;
    }

    .score-circle {
        background: #4ade80;
        color: white;
        height: 48px;
        width: 90px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 15px;
    }

    .date-text {
        font-size: 12px;
        color: #64748b;
        display: block;
        margin-top: 8px;
        font-weight: 500;
    }
</style>

<div class="profile-content-container">

    <?= $this->render('../user/_profile_menu') ?>


    <div class="main-card">
        
        <div class="section-header">Os Meus Cursos e Aulas</div>


        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProviderInscricoes,
            'itemView' => '_cursos_aulas',
            'layout' => "<div class='cards-grid'>{items}</div>\n<div class='mt-4'>{pager}</div>",
            'itemOptions' => ['tag' => false],
        ]) ?>

    </div>
</div>