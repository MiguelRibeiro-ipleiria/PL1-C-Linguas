<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Audio $model */

$this->title = $model->audio_resource_id;
$this->params['breadcrumbs'][] = ['label' => 'Audios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="audio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'audio_resource_id',
            'aula_id',
            'pergunta',
            'tipoexercicio_id',
        ],
    ]) ?>

</div>
