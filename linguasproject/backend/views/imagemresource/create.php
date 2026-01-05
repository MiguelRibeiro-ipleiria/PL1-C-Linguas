<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ImagemResource $model */

$this->title = 'Create Imagem Resource';
$this->params['breadcrumbs'][] = ['label' => 'Imagem Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagem-resource-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
