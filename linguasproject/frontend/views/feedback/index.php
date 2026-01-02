<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProviderFeedbacks */

?>

<style>


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
        border-right: 2px solid #2ecc71;
        border-left: 2px solid #2ecc71;

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


</style>

<?= $this->render('../user/_profile_menu') ?>


<div class="container">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="section-header">Os Meus Feedbacks</div>

    <div class="main-card">
        <div class="row">
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProviderFeedbacks,
                'itemView' => '_feedbacks',
                'layout' => "<div class='row'>{items}</div>\n<div class='mt-4'>{pager}</div>",
                'itemOptions' => ['tag' => false],
            ]) ?>
        </div>
        <h9 class="text-advice" data-wow-delay=".4s">Qualquer tipo de problema, clique <a href="<?= Url::to(['/feedback/create']) ?>">aqui</a>!</h9>

    </div>

</div>
