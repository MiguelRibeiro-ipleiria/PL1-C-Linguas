<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Fraseexercicio $model */

$this->title = 'Create Frase Exercicio';
$this->params['breadcrumbs'][] = ['label' => 'Frase Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frase-exercicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
