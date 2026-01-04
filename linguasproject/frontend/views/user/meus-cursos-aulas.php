<?php
use yii\helpers\Html;

/** @var yii\data\ActiveDataProvider $dataProviderInscricoes */
/** @var yii\data\ActiveDataProvider $dataProviderResultados */

?>


<?= $this->render('../user/_profile_menu') ?>

<div class="container">

    <div class="section-header">Os Meus Cursos e Aulas</div>


    <div class="main-card">

        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProviderInscricoes,
            'itemView' => '_cursos_aulas',
            'layout' => "<div class='cards-grid'>{items}</div>\n<div class='mt-4'>{pager}</div>",
            'itemOptions' => ['tag' => false],
            'emptyText' => 'Não foram encontrados cursos ou aulas inscritas.',
        ]) ?>

    </div>
</div>