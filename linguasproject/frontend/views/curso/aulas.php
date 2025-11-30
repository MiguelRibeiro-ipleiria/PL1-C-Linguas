<?php

use common\models\Curso;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $DataAulasProvider */
/** @var common\models\Curso $curso */
/** @var common\models\Idioma $idioma */

?>

<div class="services section cursos">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"><?= $idioma->lingua_descricao ?> - <?= $curso->titulo_curso ?></h2>
                    <h3 class="wow zoomIn" data-wow-delay=".2s"><?= $DataAulasProvider->getCount() ?> aulas disponíveis</h3>

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
                        'itemOptions' => ['tag' => false]])
                    ?>
                </div>
            </div>
    </div>
</div>



