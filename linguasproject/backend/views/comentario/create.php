<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\comentario $model */

$this->title = 'Create Comentario';
$this->params['breadcrumbs'][] = ['label' => 'Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentario-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
