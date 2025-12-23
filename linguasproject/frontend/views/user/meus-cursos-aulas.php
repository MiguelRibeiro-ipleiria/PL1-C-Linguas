<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dadosCursos array */
?>

<style>
    .profile-content-container {
        background-color: #f8f9fa;
        padding: 60px 0; 
        min-height: 90vh;
    }

    .main-card {
        background: #B2BEB5
        border-radius: 20px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.08);
        padding: 40px;
        max-width: 1050px;
        margin: 40px auto;
        
        border-top: 8px solid #4ade80;
        border-bottom: 8px solid #4ade80;
        
        position: relative;
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
        background: #ffffff;
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
        border: 1.5px solid #eef2f7;
        border-radius: 18px;
        padding: 18px 25px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: white;
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
    <div class="main-card">
        
        <div class="section-header">Os Meus Cursos e Aulas</div>

        <div class="course-wrapper">
            <div class="language-tag">Português</div>
            
            <div class="row">
                <div class="col-md-5">
                    <div class="course-main-info">B2 - Gramática</div>
                    <div class="info-badge">Data de Inscrição: 01/11/2025</div>
                    <div class="info-badge">Estado: Em curso</div>
                </div>
                
                <div class="col-md-7">
                    <div class="lesson-card">
                        <div>
                            <span class="lesson-title">Tempos Verbais</span>
                            <span class="status-pill status-active">Concluída</span>
                            <span class="time-pill">14min</span>
                            <span class="date-text">01/11/2025 - 23h03 às 01/11/2025 - 23h17</span>
                        </div>
                        <div class="score-circle">75 / 100</div>
                    </div>

                    <div class="lesson-card">
                        <div>
                            <span class="lesson-title">Advérbios</span>
                            <span class="status-pill status-active">Agendada</span>
                            <span class="date-text" style="color:#4ade80; font-weight:800;">02/11/2025 - 14h00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="course-wrapper">
            <div class="language-tag">Espanhol</div>
            <div class="row">
                <div class="col-md-5">
                    <div class="course-main-info">A1 - Vocabulário</div>
                    <div class="info-badge">Data de Inscrição: 10/11/2025</div>
                    <div class="info-badge">Estado: Em curso</div>
                </div>
                
                <div class="col-md-7">
                    <div class="lesson-card">
                        <span class="lesson-title">Ditados Populares</span>
                        <span class="status-pill status-active">Por começar</span>
                    </div>
                    <div class="lesson-card">
                        <span class="lesson-title">Contexto de Trabalho</span>
                        <span class="status-pill status-active">Por começar</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>