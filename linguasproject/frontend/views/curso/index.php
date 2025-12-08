<?php

use common\models\Curso;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CursoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cursos';

?>
<div class="services section cursos">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Os nossos Cursos</h2>
                    <h3 class="wow zoomIn" data-wow-delay=".2s"><?= Curso::find()->count() ?> cursos disponíveis</h3>
                </div>
            </div>
        </div>
        <div class="curso-index mt-5">

            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_cursos',
                'layout' => "<div class='row'>{items}</div>\n<div class='mt-4'>{pager}</div>",
                'itemOptions' => ['tag' => false],
            ]) ?>




        </div>

    </div>
</div>


