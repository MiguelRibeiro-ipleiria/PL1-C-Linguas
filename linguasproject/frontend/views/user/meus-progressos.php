<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\data\ActiveDataProvider $dataProviderProgress */

?>
<body>
    <div class="main-wrapper">
        <?= $this->render('../user/_profile_menu') ?>

        <div class="container">
            <div class="section-header">Os Meus Progressos</div>

            <div class="main-card">

                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProviderProgress,
                    'itemView' => '_progressos',
                    'layout' => "<div class='cards-grid'>{items}</div>\n<div class='mt-4'>{pager}</div>",
                    'itemOptions' => ['tag' => false],
                    'emptyText' => 'Sem progressos, começa um curso e diverte-te!',
                ]) ?>

            </div>
        </div>
    </div>
</body>

