<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\imagemexercicio $model */
/** @var common\models\Imagemexercicio $model */

$this->title = 'Create Imagemexercicio';
$this->params['breadcrumbs'][] = ['label' => 'Imagemexercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagemexercicio-create">

    <h1><?= Html::encode($this->title) ?></h1>
  
    <?=$this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
