<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Resultado $model */

$this->title = $model->utilizador->user->username . ' (' . $model->aulaIdaula->titulo_aula . ')';
$this->params['breadcrumbs'][] = ['label' => 'Resultados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="resultado-view">

    <p>
        <?= Html::a('Update', ['update', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula], [
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
            'utilizador_id',
            'aula_idaula',
            'data_inicio',
            'data_fim',
            'estado',
            'nota',
            'tempo_estimado',
            'data_agendamento',
            'respostas_certas',
            'respostas_erradas',
        ],
    ]) ?>

</div>
