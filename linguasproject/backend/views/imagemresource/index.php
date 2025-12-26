<?php

use common\models\ImagemResource;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ImagemResourceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Imagem Resources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagem-resource-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Imagem Resource', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="card card-success">
    <div class="card-body">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= \yii\widgets\ListView::widget([
          'dataProvider' => $dataProvider,
          'itemView' => '_imagemresource',
          'layout' => "<div class='row'>{items}</div>\n<div class='mt-4'>{pager}</div>",
            'itemOptions' => ['tag' => false],
            ]) ?>


        </div>
    </div>
</div>


</div>
