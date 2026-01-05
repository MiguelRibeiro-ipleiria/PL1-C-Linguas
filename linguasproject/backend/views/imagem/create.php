<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Imagem $model */

$this->title = 'Create Imagem';
$this->params['breadcrumbs'][] = ['label' => 'Imagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagem-create">


    <?= $this->render('_form', [
        'model' => $model,
        'opcoes'=>$opcoes,
        'arrayaulas' => $arrayaulas,
        'aula_id' =>$aula_id,
        'arrayTipoexercicio'=>$arrayTipoexercicio,

        
    ]) ?>

</div>
