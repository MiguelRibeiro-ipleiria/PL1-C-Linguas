<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Inscricao $model */

$this->title = $model->utilizador->user->username . ' (' . $model->cursoIdcurso->titulo_curso . ')';
$this->params['breadcrumbs'][] = ['label' => 'Inscricaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="inscricao-view">

    <p>
        <?= Html::a('Update', ['update', 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso], [
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
            'curso_idcurso',
            'data_inscricao',
            'progresso',
            'estado',
        ],
    ]) ?>

</div>
