<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Feedback $model */

$this->title = 'Feedback';
$this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Start Contact Area -->
<div class="contact-us section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="contact-widget-wrapper">
                    <div class="main-title">
                        <h2>Contacta-nos</h2>
                        <p>Esta webpage é muito importante para nós, é aqui que vocês se
                            podem expressar à cerca de algum problema que vos incomoda. </p>
                    </div>
                    <div class="contact-widget-block">
                        <h3 class="title">Motivos para enviar um feedback?</h3>
                        <ul>
                            <li>Bug numa webpage;</li>
                            <li>Bug num recurso da aula ou curso;</li>
                            <li>Bug num recurso da webpage "Perfil", "...";</li>
                        </ul>
                    </div>
                    <div class="contact-widget-block">
                        <h3 class="title">Onde e como posso enviar um feedback?</h3>
                        <p>Para enviar-nos um feedback, pode simplesmente clicar aqui, ou descrever o assunto nas caixas de texto ao lado.
                            Para descrever corretamente o seu feedback, apenas precisa mencionar o principal
                            problema a reportar e posteriormente detalha-lo na caixa de mensagem. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="contact-form">
                    <h3 class="form-title">Envio-nos um feedback</h3>
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Contact Area -->
