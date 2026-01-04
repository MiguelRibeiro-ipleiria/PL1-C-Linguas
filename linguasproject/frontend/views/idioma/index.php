<?php

use common\models\Idioma;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\IdiomaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Línguas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="services section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">O que Nós Oferecemos</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">As Nossas Línguas</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">Abaixo estão identificadas todas as línguas disponíveis
                        no nosso Website! Escolha uma e divirta-se a aprender!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_idioma',
                'layout' => "<div class='row'>{items}</div>\n<div class='mt-4'>{pager}</div>",
                'itemOptions' => ['tag' => false],
                'emptyText' => 'Ainda não temos idiomas disponíveis. Aguarde até que adicionar-mos!'
            ]) ?>
        </div>
    </div>
</div>