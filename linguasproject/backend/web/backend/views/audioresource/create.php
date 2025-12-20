<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Audioresource $model */

$this->title = 'Create Audioresource';
$this->params['breadcrumbs'][] = ['label' => 'Audioresources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audioresource-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
