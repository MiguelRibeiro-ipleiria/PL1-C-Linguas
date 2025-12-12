<?php

use common\models\Comentario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ComentarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>

<?= $this->render('../user/_profile_menu') ?>

<div class="container">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="row">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '../aula/_comments',
            'layout' => "<div class='row'>{items}</div>\n<div class='mt-4'>{pager}</div>",
            'itemOptions' => ['tag' => false],
        ]) ?>
    </div>

</div>
