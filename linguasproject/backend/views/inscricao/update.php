<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Inscricao $model */

$this->title = 'Update Inscricao: ' . $model->utilizador_id;
$this->params['breadcrumbs'][] = ['label' => 'Inscricaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->utilizador_id, 'url' => ['view', 'utilizador_id' => $model->utilizador_id, 'curso_idcurso' => $model->curso_idcurso]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inscricao-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
