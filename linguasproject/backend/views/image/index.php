<?php

use backend\models\ImagemResource;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Imagem Resources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagem-resource-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Imagem Resource', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

   <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_image',
        'options' => ['tag' => false]      
    ]) ?>
</div>




</div>
