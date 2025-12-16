<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Frase $model */

$this->title = 'Update Frase: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Frases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="frase-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'opcoes'=> $opcoes

    ]) ?>

</div>
