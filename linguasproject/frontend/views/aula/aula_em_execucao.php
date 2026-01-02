<?php

//
/** @var common\models\Aula $model */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\Frase $frase */
/** @var common\models\Imagem $imagem */
/** @var common\models\Audio $audio */
/** @var common\models\Opcoesai $opcoes */
/** @var common\models\Opcoesai $opcaorespondida */
/** @var int $count_exercicios */

///** @var int $index */
///** @var int $certas */
///** @var int $erradas */
///** @var boolean $resposta_correta */
///** @var int $opcao_id */
//
use common\models\Opcoesai;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//
//?>
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
            <div class="col-10">
                <div class="progress">
                    <?php
                        $percentagem = (int)(($count_exercicios / $model->numero_de_exercicios) * 100);
                    ?>
                    <div class="progress-bar" style="width: <?= $percentagem ?>%"></div>
                </div>
            </div>
                <div class="col-1">
                    <span class="execise-custom-green level-badge"><?php echo $percentagem ?>%</span>
            </div>
               <div class="col-1 d-flex justify-content-end">
                    <div class="button">
                        <a href="<?= Url::to(['/aula/aulacancelar', 'id' => $model->id]) ?>" class="cancel_exercise_layout"><i class="bi bi-box-arrow-right"></i></a>
                    </div>
               </div>
        </div>
        <br>

        <div class="container">
            <aside class="col-lg-12 col-md-12 col-12">
                <div class="sidebar">
                    <?php if($imagem != null){ ?>
                        <div class="filter popular-tag-widget">
                            <div class="">
                                <p class="title-exercicio-imagem">- <?= $imagem->pergunta ?></p>
                            </div>
                            <div class="img-exercicio">
                                <img src="<?= '../../../common/UploadImage/' . $imagem->imagemResource->nome_ficheiro ?>" alt="#">
                            </div>
                            <div>
                                <div class="col-12 box-divider">
                                </div>
                                <div class="tags">
                                    <div class="d-flex justify-content-center">
                            <?php
                            if($opcaorespondida == null){
                                $form = ActiveForm::begin(['action' => ['/resultado/update', 'aula_id' => $model->id, 'imagem_resource_id' => $imagem->imagemResource->id]]);
                                foreach ($imagem->opcoesais as $opcao){

                                ?>

                                <?= Html::submitButton(
                                    $opcao->descricao,
                                    [
                                        'class' => 'opcao_layout',
                                        'name' => 'opcao_imagem_id',
                                        'value' => $opcao->id,
                                    ]
                                ) ?>
                                <?php } ?>
                                <?php ActiveForm::end(); ?>
                            <?php }
                                else{

                                    foreach ($imagem->opcoesais as $opcao){
                                        if($opcaorespondida->id == $opcao->id){
                                            if($opcao->iscorreta == 1){?>
                                                <a class="opcao_layout_green"><?= $opcao->descricao ?></a><?php }
                                            else{ ?>
                                                <a  class="opcao_layout_red"><?= $opcao->descricao ?></a>
                                            <?php }
                                        }
                                        else{
                                            if ($opcao->iscorreta == 1) { ?>
                                                <a  class="opcao_layout_green"><?= $opcao->descricao ?></a>
                                            <?php }
                                            // restantes
                                            else { ?>
                                            <a  class="opcao_layout"><?= $opcao->descricao ?></a>
                                            <?php }
                                        }
                                    }
                                    $opcao_null = null;
                                    $model->setOpcaoRespondidaSession($opcao_null);
                                }
                                ?>
                                </div>
                        </div>
                    <?php } elseif($frase != null){ ?>
                        <div class="filter popular-tag-widget">
                            <div class="">
                                <p class="title-exercicio-audio">- Completa a Frase</p>
                            </div>
                            <div class="img-exercicio_audio">
                                <img src="<?= Yii::getAlias('@web').'/img/tartaruga_piloto.png'; ?>" alt="#">
                                <?php
                                if($frase->partefrases_2 == null){ ?>
                                    <p class="question-exercicio-audio">- <?= $frase->partefrases_1 ?> ___________ .</p>
                                <?php }
                                else{ ?>
                                    <p class="question-exercicio-audio">- <?= $frase->partefrases_1 ?> ___________ <?= $frase->partefrases_2 ?></p>
                                <?php }
                                ?>
                            </div>
                            <div class="col-12 box-divider">
                            </div>
                            <div class="tags">
                                <div class="d-flex justify-content-center">
                                    <?php
                                    if($opcaorespondida == null){
                                        $form = ActiveForm::begin(['action' => ['/resultado/update', 'aula_id' => $model->id, 'frase_id' => $frase->id]]);
                                        foreach ($frase->opcoesais as $opcao){

                                            ?>

                                            <?= Html::submitButton(
                                                $opcao->descricao,
                                                [
                                                    'class' => 'opcao_layout',
                                                    'name' => 'opcao_frase_id',
                                                    'value' => $opcao->id,
                                                ]
                                            ) ?>
                                        <?php } ?>
                                        <?php ActiveForm::end(); ?>
                                    <?php }
                                    else{

                                        foreach ($frase->opcoesais as $opcao){
                                            if($opcaorespondida->id == $opcao->id){
                                                if($opcao->iscorreta == 1){?>
                                                    <a class="opcao_layout_green"><?= $opcao->descricao ?></a>
                                                <?php }
                                                else{ ?>
                                                    <a  class="opcao_layout_red"><?= $opcao->descricao ?></a>
                                                <?php }
                                            }
                                            else{
                                                if ($opcao->iscorreta == 1) { ?>
                                                    <a  class="opcao_layout_green"><?= $opcao->descricao ?></a>
                                                <?php }
                                                // restantes
                                                else { ?>
                                                    <a  class="opcao_layout"><?= $opcao->descricao ?></a>
                                                <?php }
                                            }
                                        }
                                        $opcao_null = null;
                                        $model->setOpcaoRespondidaSession($opcao_null);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } elseif($audio != null){ ?>
                    <div class="filter popular-tag-widget">
                        <div class="">
                            <p class="title-exercicio-audio">- <?= $audio->pergunta ?></p>
                        </div>
                        <div class="img-exercicio_audio">
                            <img src="<?= Yii::getAlias('@web').'/img/tartaruga_piloto.png'; ?>" alt="#">

                            <audio controls>
                                <source src="<?= '../../../backend/web/uploads/UploadAudio/' . $audio->audioResource->nome_ficheiro ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <div class="col-12 box-divider">
                        </div>
                        <div class="tags">
                            <div class="d-flex justify-content-center">
                                <?php
                                if($opcaorespondida == null){
                                    $form = ActiveForm::begin(['action' => ['/resultado/update', 'aula_id' => $model->id, 'audio_resource_id' => $audio->audioResource->id]]);
                                    foreach ($audio->opcoesais as $opcao){

                                        ?>

                                        <?= Html::submitButton(
                                            $opcao->descricao,
                                            [
                                                'class' => 'opcao_layout',
                                                'name' => 'opcao_audio_id',
                                                'value' => $opcao->id,
                                            ]
                                        ) ?>
                                    <?php } ?>
                                    <?php ActiveForm::end(); ?>
                                <?php }
                                else{

                                    foreach ($audio->opcoesais as $opcao){
                                        if($opcaorespondida->id == $opcao->id){
                                            if($opcao->iscorreta == 1){?>
                                                <a class="opcao_layout_green"><?= $opcao->descricao ?></a>
                                            <?php }
                                            else{ ?>
                                                <a  class="opcao_layout_red"><?= $opcao->descricao ?></a>
                                            <?php }
                                        }
                                        else{
                                            if ($opcao->iscorreta == 1) { ?>
                                                <a  class="opcao_layout_green"><?= $opcao->descricao ?></a>
                                            <?php }
                                            // restantes
                                            else { ?>
                                                <a  class="opcao_layout"><?= $opcao->descricao ?></a>
                                            <?php }
                                        }
                                    }
                                    $opcao_null = null;
                                    $model->setOpcaoRespondidaSession($opcao_null);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </aside>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <div class="button"><a href="<?= Url::to(['/aula/aulaemexecucao', 'id' => $model->id]) ?>" class="finish_exercise_layout">Seguinte</a></div>
                </div>
            </div>

        </div>

<!--        <div class="container">-->
<!--            <aside class="col-lg-12 col-md-12 col-12">-->
<!--                <div class="sidebar">-->
<!--                    <div class="filter popular-tag-widget">-->
<!--                        <div class="">-->
<!--                            <p class="title-exercicio-audio">- Completa a Frase</p>-->
<!--                        </div>-->
<!--                        <div class="img-exercicio_audio">-->
<!--                            <img src="--><?php //= Yii::getAlias('@web').'/img/tartaruga_piloto.png'; ?><!--" alt="#">-->
<!--                            --><?php
//                                if($frase->partefrases_2 == null){ ?>
<!--                                    <p class="question-exercicio-audio">- --><?php //= $frase->partefrases_1 ?><!-- ___________ .</p>-->
<!--                                --><?php //}
//                                else{ ?>
<!--                                    <p class="question-exercicio-audio">- --><?php //= $frase->partefrases_1 ?><!-- ___________ --><?php //= $frase->partefrases_2 ?><!--</p>-->
<!--                                --><?php //}
//                            ?>
<!--                        </div>-->
<!--                        <div class="col-12 box-divider">-->
<!--                        </div>-->
<!--                        <div class="tags">-->
<!--                            <div class="d-flex justify-content-center">-->
<!--                                --><?php
//                                    if($opcaorespondida == null){
//                                        $form = ActiveForm::begin(['action' => ['/resultado/update', 'aula_id' => $model->id, 'frase_id' => $frase->id]]);
//                                        foreach ($frase->opcoesais as $opcao){
//
//                                            ?>
<!---->
<!--                                            --><?php //= Html::submitButton(
//                                                $opcao->descricao,
//                                                [
//                                                    'class' => 'opcao_layout',
//                                                    'name' => 'opcao_frase_id',
//                                                    'value' => $opcao->id,
//                                                ]
//                                            ) ?>
<!--                                        --><?php //} ?>
<!--                                        --><?php //ActiveForm::end(); ?>
<!--                                    --><?php //}
//                                    else{
//
//                                        foreach ($frase->opcoesais as $opcao){
//                                            if($opcaorespondida->id == $opcao->id){
//                                                if($opcao->iscorreta == 1){?>
<!--                                                    <a class="opcao_layout_green">--><?php //= $opcao->descricao ?><!--</a>-->
<!--                                                --><?php //}
//                                                else{ ?>
<!--                                                    <a  class="opcao_layout_red">--><?php //= $opcao->descricao ?><!--</a>-->
<!--                                                --><?php //}
//                                            }
//                                            else{
//                                                if ($opcao->iscorreta == 1) { ?>
<!--                                                    <a  class="opcao_layout_green">--><?php //= $opcao->descricao ?><!--</a>-->
<!--                                                --><?php //}
//                                                // restantes
//                                                else { ?>
<!--                                                    <a  class="opcao_layout">--><?php //= $opcao->descricao ?><!--</a>-->
<!--                                                --><?php //}
//                                            }
//                                        }
//                                        $opcao_null = null;
//                                        $model->setOpcaoRespondidaSession($opcao_null);
//                                    }
//                                    ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </aside>-->
<!--            <div class="row">-->
<!--                <div class="col-12 d-flex justify-content-end">-->
<!--                    <div class="button"><a href="--><?php //= Url::to(['/aula/aulaemexecucao', 'id' => $model->id]) ?><!--" class="finish_exercise_layout">Seguinte</a></div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->

    </div>

</body>
