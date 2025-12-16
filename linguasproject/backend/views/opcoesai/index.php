<?php

use common\models\Opcoesai;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Opcoesais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opcoesai-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Opcoesai', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'iscorreta',
            'descricao',
            'audio_audio_resource_id',
            'audio_aula_id',
            'imagem_imagem_resource_id',
            'imagem_aula_id',
            'frase_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Opcoesai $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
