<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Resultado $model */

$this->title = 'Update Resultado: ' . $model->utilizador_id;
$this->params['breadcrumbs'][] = ['label' => 'Resultados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->utilizador_id, 'url' => ['view', 'utilizador_id' => $model->utilizador_id, 'aula_idaula' => $model->aula_idaula]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="resultado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
