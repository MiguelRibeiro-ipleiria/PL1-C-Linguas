<?php

use common\models\aula;
use yii\helpers\Html;
use common\models\Dificuldade;
use common\models\Idioma;
use common\models\Utilizador;
use common\models\Tipoexercicio;
use common\models\User;
use common\models\Curso;
use common\models\comentario;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\aulaSearch $searchModel */
/** @var common\models\aula $aula */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aulas';
$this->params['breadcrumbs'][] = $this->title;
?>


    <?php
       
    $TiposExercicio = Tipoexercicio::find()->all();
    
    ?>

    <h3>Escolha o tipo de exercicio</h3>
<div class="tipo-exercicio-options">
    <?php foreach($TiposExercicio as $tipo): 
        $controller = strtolower($tipo->descricao) . 'exercicio';
        ?>
        
        <?= Html::a($tipo->descricao, Url::to([$controller.'/create', 'aula'=>$aula,'tipoexercicio'=>$tipo->id]), [
            'class' => 'btn btn-primary m-1'
        ]);
        ?>
    <?php endforeach; ?>
</div>



