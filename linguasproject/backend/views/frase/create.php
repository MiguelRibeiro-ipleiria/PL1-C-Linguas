<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Frase $model */

$this->title = 'Create Frase';
$this->params['breadcrumbs'][] = ['label' => 'Frases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'opcoes' =>$opcoes,

    ]) ?>

</div>
