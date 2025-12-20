<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Opcoesai $model */

$this->title = 'Create Opcoesai';
$this->params['breadcrumbs'][] = ['label' => 'Opcoesais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opcoesai-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
