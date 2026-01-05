<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Audio $model */

$this->title = 'Create Audio';
$this->params['breadcrumbs'][] = ['label' => 'Audios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audio-create">


    <?= $this->render('_form', [
        'model' => $model,
        'opcoes'=>$opcoes,
        'arrayaulas' => $arrayaulas,
        'aula_id' =>$aula_id,
        'arrayTipoexercicio'=>$arrayTipoexercicio,
    ]) ?>

</div>
