<?php

use common\models\Inscricao;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\InscricaoSearch $searchModel */
/** @var common\models\Curso $curso */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Inscricao com Sucesso';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inscricao-index mt-5">
    <div class="services section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Inscrição Realizada</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Parabéns, você está inscrito</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">A sua inscrição no curso "<?= $curso->titulo_curso ?>"
                            de <?= $curso->idioma->lingua_descricao ?> está agora registada. Aproveite-a!</p>
                    </div>
                    <div class="button button-center">
                        <a href="<?= Url::to(['/curso/aulas', 'id' => $curso->id]) ?>" class="btn">
                            Continuar para o curso
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>