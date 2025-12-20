<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/** @var common\models\Resultado $model */

$this->title = $model->utilizador_id;
$this->params['breadcrumbs'][] = ['label' => 'Resultados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="resultado-view mt-5">


    <div class="container">
        <aside class="col-lg-12 col-md-12 col-12">
            <div class="row">
                <div class="col-6">
                    <div class="img-exercicio">
                        <img src="<?= Yii::getAlias('@web').'/img/logo_dialog.png'; ?>" alt="#">
                    </div>
                </div>
                <div class="col-6">
                    <div class="img-exercicio">
                        <img src="<?= Yii::getAlias('@web').'/img/logo_dialog.png'; ?>" alt="#">
                    </div>
                </div>
            </div>

            <div>
                <div class="col-12 box-divider">
                </div>
            </div>
        </aside>
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <div class="button"><a href="..." class="finish_exercise_layout">Seguinte</a></div>
            </div>
        </div>
    </div>


</div>
