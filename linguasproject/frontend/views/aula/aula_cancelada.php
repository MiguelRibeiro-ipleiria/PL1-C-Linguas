<?php

/** @var \common\models\Aula $model */

use yii\helpers\Url;
use yii\helpers\Html;

?>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="icon" href="<?= Yii::getAlias('@web') . '/img/logo_dialog.png'; ?>" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/main.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/glightbox.min.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/LineIcons.3.0.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/tiny-slider.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/animate.css'; ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />


    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div class="section_exercise">

    <div class="row">
        <div class="col-11">
            <div class="progress">
                <div class="progress-bar-error" style="width: 100%"></div>
            </div>
        </div>
        <div class="col-1">
            <span class="execise-custom-error level-badge">0%</span>
        </div>
    </div>
    <br>
    <div class="box-comecar-page">
        <span class="titulo-aula-error">UPS!</span>
        <div class="img-exercicio-comecar">
            <img src="<?= Yii::getAlias('@web').'/img/turtle_sad.png'; ?>" alt="#">
        </div>
        <span class="descricao-aula-error">A sua aula sobre " <?= $model->titulo_aula ?>" foi cancelada! Esperamos que consigas refazê-la mais tarde.</span>
    </div>

    <div class="container">
        <hr class="hr-divider-error">
        <div class="row">
            <div class="col-12 d-flex justify-content-end container-bottom-button">
                <div class="button"><a href="<?= Url::to(['/aula/view', 'id' => $model->id]) ?>" class="opcao_layout_red">Concluir</a></div>
            </div>
        </div>
    </div>
</div>

</body>
