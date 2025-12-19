<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\FeedbackSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>

<style>
    .feedback-visual-container {
        border-top: 3px solid #2ecc71 !important;
        border-bottom: 3px solid #2ecc71 !important;
        background-color: #fff;
        padding: 60px 40px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        min-height: 400px;
    }

    .badge-main-title {
        background-color: #1a252f !important;
        padding: 12px 40px !important;
        font-size: 1.1rem !important;
        margin-bottom: 50px;
        letter-spacing: 1px;
    }

    .feedback-card {
        border: 1px solid #e0e0e0;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 30px;
        transition: transform 0.2s;
    }

    .feedback-card:hover {
        border-color: #2ecc71;
    }

    .feedback-left {
        flex: 0 0 280px;
    }

    .subject-pill {
        background-color: #1a252f;
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        display: inline-block;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 8px;
        width: 100%;
        text-align: center;
    }

    .feedback-date {
        color: #999;
        font-size: 0.85rem;
        padding-left: 15px;
    }

.feedback-description {
        color: #444;
        font-size: 1rem; 
        line-height: 1.6;
        padding-top: 5px;
        font-weight: 600; 
    }

    .popular-tag-widget .tags a[href*="feedback"] {
        background-color: #2ecc71 !important;
        color: white !important;
        border-color: #2ecc71 !important;
    }
</style>

<?= $this->render('../user/_profile_menu') ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">

            <div class="feedback-visual-container">
                
                <div class="text-center">
                    <span class="badge badge-main-title rounded-pill">
                        OS MEUS FEEDBACKS
                    </span>
                </div>

                <div class="feedback-list">
                    <?php 
                    $feedbacks = $dataProvider->getModels();
                    if (empty($feedbacks)): ?>
                        <p class="text-center text-muted">Ainda não enviou nenhum feedback.</p>
                    <?php else: ?>
                        <?php foreach ($feedbacks as $feedback): ?>
                            <div class="feedback-card shadow-sm">
                                <div class="feedback-left">
                                    <div class="subject-pill">
                                        <?= Html::encode($feedback->assunto_feedback) ?>
                                    </div>
                                    <div class="feedback-date">
                                        <?= date('d/m/Y H:i', strtotime($feedback->hora_criada)) ?>
                                    </div>
                                </div>

                                <div class="feedback-description">
                                    <?= Html::encode($feedback->descricao_feedback) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>
</div>