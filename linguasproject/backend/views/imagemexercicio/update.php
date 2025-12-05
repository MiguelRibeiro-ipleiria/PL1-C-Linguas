<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\imagemexercicio $model */
/** @var common\models\Imagemexercicio $model */

$this->title = 'Update Imagemexercicio: ' . $model->imagem_resource_id;
$this->params['breadcrumbs'][] = ['label' => 'Imagemexercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->imagem_resource_id, 'url' => ['view', 'imagem_resource_id' => $model->imagem_resource_id, 'aula_id' => $model->aula_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagemexercicio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
