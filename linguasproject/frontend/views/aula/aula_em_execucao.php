<?php

/** @var common\models\Aula $model */
use common\models\Opcoesai;
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
<!--
<div class="services section">
    <?php

        $contfrases = 0;
        $contimagem = 0;
        $contaudio = 0;
        $exercicioatual = 0;


        foreach ($model->frases as $frase) {
            if($frase != null){
                $contfrases++;
            }
        }


        do{

            foreach ($model->frases as $frase) {
                $opcoes = Opcoesai::find()->where(['frase_id' => $frase->id])->all();
            }
            ?>



            <div class="container mt-5">
                <div class="row"> <?php

                    foreach ($opcoes as $opcao) { ?>
                        <div class="col-4">
                            <?= $opcao->descricao ?>
                        </div>
                    <?php }


                    ?>
                </div>
            </div>


            <?php
        }while(0);

    ?>

</div>
-->


    <div class="section">




        <div class="container">

            <div class="row">
                <div class="col-11">
                    <div class="progress">
                        <div class="progress-bar" style="width: 30%;"></div>
                    </div>
                </div>
                <div class="col-1">
                    <span class="cursos-custom-green level-badge">70%</span>
                </div>
            </div>


            <aside class="col-lg-12 col-md-12 col-12">
                <div class="sidebar">
                    <div class="filter popular-tag-widget">
                        <div class="">
                            <p class="question-exercicio">- Que objeto está na imagem?</p>
                        </div>
                        <div class="img-exercicio">
                            <img src="<?= Yii::getAlias('@web').'/img/logo_dialog.png'; ?>" alt="#">
                        </div>
                        <div>
                            <div class="col-12 box-divider">
                            </div>
                        </div>
                        <div class="tags">
                            <div class="d-flex justify-content-center">
                                <div class="button"><a href="..." class="opcao_layout">Ronaldo</a></div>
                                <div class="button"><a href="..." class="opcao_layout">SIUUU</a></div>
                                <div class="button"><a href="..." class="opcao_layout">RONALDO DE BICICLTEA</a></div>
                                <div class="button"><a href="..." class="opcao_layout">MINHA NOSSA</a></div>
                            </div>
                        </div>
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

