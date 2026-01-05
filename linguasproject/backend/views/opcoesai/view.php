<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Opcoesai $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Opcoesais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="opcoesai-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'iscorreta',
            'descricao',
            'audio_audio_resource_id',
            'audio_aula_id',
            'imagem_imagem_resource_id',
            'imagem_aula_id',
            'frase_id',
        ],
    ]) ?>

</div>
