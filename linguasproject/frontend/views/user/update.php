<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Utilizador;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\Utilizador $utilizador */
/** @var common\models\User $user */

?>

<style>
   
    .form-visual-container {
        border-top: 3px solid #2ecc71 !important;  
        border-bottom: 3px solid #2ecc71 !important; 
        background-color: #fff;
        padding: 60px 40px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .badge-data-title {
        background-color: #1a252f !important;
        padding: 10px 30px !important;
        font-size: 1rem !important;
        margin-bottom: 40px;
        text-transform: uppercase;
    }


    .label-green {
        color: #2ecc71 !important;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    .input-custom {
        background-color: #e0e0e0 !important;
        border: 2px solid #2ecc71 !important;
        border-radius: 10px !important;
        height: 48px;
        color: #333;
    }

    .btn-save-pill {
        background-color: #2ecc71 !important;
        border: none;
        border-radius: 50px;
        padding: 12px 60px;
        font-weight: bold;
        color: white;
        font-size: 1.1rem;
        margin-top: 20px;
    }
</style>

<?= $this->render('_profile_menu') ?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>

    <?php
    $valorData = date('Y-m-d', strtotime($utilizador->data_nascimento));
    $valorNumeroTelefone = $utilizador->numero_telefone;
    $valorNacionalidade = $utilizador->nacionalidade;
    $valorDataCriacao = date('Y-m-d', strtotime($utilizador->data_inscricao));
    ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">

                <div class="form-visual-container">

                    <div class="text-center">
                        <span class="badge badge-data-title rounded-pill">
                            OS MEUS DADOS
                        </span>
                    </div>

                    <div class="row g-4 mt-2">
                        <div class="col-md-4">
                            <?= Html::label('Username', 'username', ['class' => 'label-green']) ?>
                            <?= Html::input('text', 'username', $user->username, [
                                'class' => 'form-control input-custom'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= Html::label('Email', 'email', ['class' => 'label-green']) ?>
                            <?= Html::input('email', 'email', $user->email, [
                                'class' => 'form-control input-custom'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= Html::label('Data de Nascimento', 'data_nascimento', ['class' => 'label-green']) ?>
                            <?= Html::input('date', 'data_nascimento', $valorData, [
                                'class' => 'form-control input-custom'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= Html::label('Nº de Telefone', 'telefone', ['class' => 'label-green']) ?>
                            <?= Html::input('text', 'telefone', $valorNumeroTelefone, [
                                'class' => 'form-control input-custom'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= Html::label('Nacionalidade', 'nacionalidade', ['class' => 'label-green']) ?>
                            <?= Html::input('text', 'nacionalidade', $valorNacionalidade, [
                                'class' => 'form-control input-custom'
                            ]) ?>
                        </div>

                        <div class="col-md-4">
                            <?= Html::label('Data de Criação', 'data_criacao', ['class' => 'label-green']) ?>
                            <?= Html::input('text', 'data_criacao', $valorDataCriacao, [
                                'class' => 'form-control input-custom',
                                'disabled' => true
                            ]) ?>
                        </div>

                        <div class="col-12 text-center mt-5">
                            <?= Html::submitButton(
                                'Guardar os dados alterados',
                                ['class' => 'btn btn-save-pill']
                            ) ?>
                        </div>
                    </div>

                </div> </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>