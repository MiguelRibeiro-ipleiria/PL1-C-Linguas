<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Imagem $model */


$this->title = 'Update Imagem: ' . $model->imagem_resource_id;
$this->params['breadcrumbs'][] = ['label' => 'Imagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->imagem_resource_id, 'url' => ['view', 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
        'opcoes'=>$opcoes,
        'arrayTipoexercicio'=>$arrayTipoexercicio,
    ]) ?>

</div>
