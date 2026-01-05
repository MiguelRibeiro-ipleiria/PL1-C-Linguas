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

    <?= $this->render('_form_update', [
        'model' => $model,
        'opcoes'=> $opcoes,
        'arrayTipoexercicio' => $arrayTipoexercicio

    ]) ?>

</div>
