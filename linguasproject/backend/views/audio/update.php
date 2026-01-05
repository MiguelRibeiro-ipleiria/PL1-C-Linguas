<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Audio $model */

$this->title = 'Update Audio: ' . $model->audio_resource_id;
$this->params['breadcrumbs'][] = ['label' => 'Audios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->audio_resource_id, 'url' => ['view', 'audio_resource_id' => $model->audio_resource_id, 'aula_id' => $model->aula_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="audio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
        'opcoes'=>$opcoes,
        'arrayTipoexercicio' => $arrayTipoexercicio
    ]) ?>

</div>
