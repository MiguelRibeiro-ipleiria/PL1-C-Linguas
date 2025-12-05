<?php

use common\models\Idioma;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\IdiomaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Idiomas';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('Create Idioma', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<div class="card card-success">
    <div class="card-body">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="row">
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_idioma',
                'layout' => "<div class='row'>{items}</div>\n<div class='mt-4'>{pager}</div>",
                'itemOptions' => ['tag' => false],
            ]) ?>

        </div>
    </div>
</div>