<?php

/** @var \common\models\Resultado $resultado*/
/** @var \common\models\Aula $model*/


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
    <br><br><br>

    <div class="row align-items-center"> <div class="col-6 text-center">
            <img src="<?= Yii::getAlias('@web').'/img/tartaruga_exercicios_comecar.png'; ?>" alt="#" style="max-width: 80%;">
        </div>

        <div class="col-6">
            <div class="text-center mb-3">
                <?php
                if($resultado->nota < 20 && $resultado->nota >= 0){ ?>
                    <span class="titulo-aula-terminar">Muito Mau!</span>
                <?php }
                elseif($resultado->nota < 50 && $resultado->nota >= 20){ ?>
                    <span class="titulo-aula-terminar">Razoável!</span>
                <?php } elseif($resultado->nota >= 50 && $resultado->nota < 75){ ?>
                    <span class="titulo-aula-terminar">Bom Trabalho!</span>
                <?php } else { ?>
                    <span class="titulo-aula-terminar">Excelente Trabalho!</span>
                <?php }
                ?>
            </div>

            <div class="terminar-container mx-auto"> <div class="sidebar">
                    <div class="filter popular-tag-widget text-center">
                        <span class="titulo-info-aula-terminar"><?= $resultado->nota ?>%</span>

                        <div class="progress mb-3">
                            <div class="progress-bar"></div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="img-exercicio-terminar">
                                    <img src="<?= Yii::getAlias('@web').'/img/correct_symbol.jpg'; ?>" alt="#">
                                </div>
                                <span class="info-aula-terminar d-block mt-2"><?= $resultado->respostas_certas ?> certas</span>
                            </div>
                            <div class="col-6">
                                <div class="img-exercicio-terminar">
                                    <img src="<?= Yii::getAlias('@web').'/img/wrong_symbol.jpg'; ?>" alt="#">
                                </div>
                                <span class="info-aula-terminar d-block mt-2"><?= $resultado->respostas_erradas ?> erradas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <hr class="hr-divider">
        <div class="row">
            <div class="col-12 d-flex justify-content-end container-bottom-button">
                <div class="button"><a href="<?= Url::to(['/aula/view', 'id' => $model->id]) ?>" class="finish_exercise_layout">Concluir</a></div>
            </div>
        </div>
    </div>

</div>

</body>
