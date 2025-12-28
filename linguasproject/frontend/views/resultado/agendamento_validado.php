<?php

use common\models\Inscricao;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
    /** @var common\models\Resultado $resultado */

$this->title = 'Aula Agendada';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="inscricao-index mt-5">
    <div class="services section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Aula Agendada</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Parabéns, a sua aula foi agendada </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">O seu agendamento para a aula "<?= $resultado->aulaIdaula->descricao_aula ?>"
                            foi registado para o dia <?= $resultado->data_agendamento ?>. Aproveite-a!</p>
                    </div>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <div class="button">
                            <a href="<?= Url::to(['/user/meus-cursos-aulas', 'id' => Yii::$app->user->identity->id]) ?>" class="styliesh">
                                Ver Agendamento
                            </a>
                        </div>
                        <div class="button">
                            <a href="<?= Url::to(['/aula/view', 'id' => $resultado->aulaIdaula->id]) ?>" class="styliesh">
                                Continuar para a aula
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>