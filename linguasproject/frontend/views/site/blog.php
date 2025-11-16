<?php

use common\models\Feedback;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\FeedbackSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .tab-item {
        color: #21c784;
        font-weight: 600;
        text-decoration: none;
        padding: 10px 12px;
        border-radius: 8px;
        transition: .2s ease;
    }
    .tab-item:hover{
        background-color: #0a0e14;
        border-radius: 10px;
        background-color: #2ca02c;
    }

</style>
<div class="section blog-single">
    <div class="col-12">
        <div class="sidebar">
            <div class="widget search-widget">
                <div class="tabs-container">
                    <a href="#" class="tab-item active">Os meus dados</a>
                    <a href="#" class="tab-item">Os meus cursos e aulas</a>
                    <a href="#" class="tab-item">Os meus comentários</a>
                    <a href="#" class="tab-item">Os meus progressos</a>
                    <a href="#" class="tab-item btn-tab">Os meus feedbacks</a>
                </div>
            </div>
        </div>
    </div>
</div>



