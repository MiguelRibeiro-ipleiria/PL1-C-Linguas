<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Resultado $model */

$this->title = 'Create Resultado';
$this->params['breadcrumbs'][] = ['label' => 'Resultados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resultado-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
