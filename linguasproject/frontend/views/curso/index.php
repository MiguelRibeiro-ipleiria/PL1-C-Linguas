<?php

use common\models\Curso;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CursoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

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

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'idioma_id',
                    'dificuldade_id',
                    'titulo_curso',
                    'status_ativo',
                    //'data_criacao',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Curso $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>


        </div>

    </div>
</div>


