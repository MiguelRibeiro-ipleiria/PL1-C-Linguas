<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Frase $model */

$this->title = 'Create Frase';
$this->params['breadcrumbs'][] = ['label' => 'Frases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frase-create">


    <?= $this->render('_form', [
        'model' => $model,
        'opcoes' =>$opcoes,
        'arrayaulas' => $arrayaulas,
        'aula_id' =>$aula_id,
        'arrayTipoexercicio'=>$arrayTipoexercicio,

    ]) ?>

</div>
