<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Inscricao $model */

$this->title = 'Create Inscricao';
$this->params['breadcrumbs'][] = ['label' => 'Inscricaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inscricao-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
