<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AudioResource $model */

$this->title = 'Create Audio Resource';
$this->params['breadcrumbs'][] = ['label' => 'Audio Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audio-resource-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
