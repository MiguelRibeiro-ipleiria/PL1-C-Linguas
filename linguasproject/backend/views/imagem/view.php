<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Imagem $model */

$this->title = $model->imagem_resource_id . ' (' . $model->imagemResource->nome_ficheiro . ')';
$this->params['breadcrumbs'][] = ['label' => 'Imagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="imagem-view">

    <p>
        <?= Html::a('Update', ['update', 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id], [
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
            'imagem_resource_id',
            'aula_id',
            'pergunta',
            'tipoexercicio_id',
        ],
    ]) ?>

</div>
