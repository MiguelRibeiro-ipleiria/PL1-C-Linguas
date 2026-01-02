<?php

use common\models\Frase;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\FraseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Frases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frase-index">


    <p>
        <?= Html::a('Create Frase', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'partefrases_1',
            'partefrases_2',
            'aula_id',
            'tipoexercicio_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Frase $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
