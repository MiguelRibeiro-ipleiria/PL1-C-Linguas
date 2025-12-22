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
                    <div class="progress-bar" style="width: 0%"></div>
                </div>
            </div>
            <div class="col-1">
                <span class="execise-custom-green level-badge"><?php echo 0 ?>%</span>
            </div>
        </div>
        <br>
        <div class="box-comecar-page">
            <span class="titulo-aula-comecar">LEARNALOT</span>
            <div class="img-exercicio-comecar">
                <img src="<?= Yii::getAlias('@web').'/img/tartaruga_exercicios_comecar.png'; ?>" alt="#">
            </div>
            <span class="descricao-aula-comecar">Está preparado para começar a aula?</span>
        </div>
        <br>
        <hr class="hr-divider">
        <div class="row">
            <div class="col-10 button-voltar">
                <div class="button">
                    <a href="<?= Url::to(['/aula/view', 'id' => $model->id]) ?>" class="voltar_exercise_layout">Voltar</a>
                </div>
            </div>
            <div class="col-2 button-comecar">
                <div class="button">
                    <a href="<?= Url::to(['/aula/aulaemexecucao', 'id' => $model->id]) ?>" class="comecar_exercise_layout">Seguinte</a>
                </div>
            </div>
        </div>
    </div>

</body>
