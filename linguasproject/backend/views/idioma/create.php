<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Idioma $model */

$this->title = 'Create Idioma';
$this->params['breadcrumbs'][] = ['label' => 'Idiomas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="idioma-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
