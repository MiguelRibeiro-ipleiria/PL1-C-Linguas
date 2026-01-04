<?php

use common\models\Curso;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $DataAulasProvider */
/** @var common\models\Curso $curso */

?>

<div class="services section cursos">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"><?= $curso->idioma->lingua_descricao ?> - <?= $curso->titulo_curso ?></h2>
                    <h3 class="wow zoomIn" data-wow-delay=".2s">
                        <?php
                        if($curso->getAulas()->count() > 1){ ?>
                            <?= $curso->getAulas()->count() ?> aulas disponíveis
                        <?php }elseif($curso->getAulas()->count() == 1){ ?>
                            <?= $curso->getAulas()->count() ?> aula disponível
                        <?php } else{ ?>
                            Sem aulas disponíveis
                        <?php }?>
                    </h3>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="curso-index mt-5">
                    <?= \yii\widgets\ListView::widget([
                        'dataProvider' => $DataAulasProvider,
                        'itemView' => '_cursos_aulas',
                        'layout' => "<div class='cards-grid'>{items}</div>\n<div class='mt-4'>{pager}</div>",
                        'itemOptions' => ['tag' => false],
                        'emptyText' => 'Pedimos desculpa, mas não temos registos de aulas neste curso. Procure outro que lhe agrade!'])
                    ?>
                </div>
            </div>
    </div>
</div>



