<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tipoexercicio $model */

$this->title = 'Create Tipoexercicio';
$this->params['breadcrumbs'][] = ['label' => 'Tipoexercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoexercicio-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
