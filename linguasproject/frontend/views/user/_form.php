<?php

use common\models\Utilizador;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="user-form">

    <?php $form = ActiveForm::begin();
    $utilizador = Utilizador::findOne(['user_id' => $model->id]);
    $valorData = date('Y-m-d', strtotime($utilizador->data_nascimento));
    $valorNumeroTelefone = $utilizador->numero_telefone;
    $valorNacionalidade = $utilizador->nacionalidade;
    $valorDataCriacao = date('Y-m-d', strtotime($utilizador->data_inscricao));


    ?>

    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <?= Html::label('Username', 'username', ['class' => 'label-green']) ?>
            <?= Html::input(
                'text',
                'username',
                $model->username,
                ['class' => 'form-control input-custom', 'disabled' => true] // Adicionei form-control para ficar igual aos outros inputs
            ) ?>
        </div>
        <div class="col-md-4">
            <?= Html::label('Email', 'email', ['class' => 'label-green']) ?>
            <?= Html::input(
                'text',
                'email',
                $model->email,
                ['class' => 'form-control input-custom', 'disabled' => true] // Adicionei form-control para ficar igual aos outros inputs
            ) ?>
        </div>
        <div class="col-md-4">
            <?= Html::label('Data de Nascimento', 'data_nascimento', ['class' => 'label-green']) ?>
            <?= Html::input(
                'date',
                'data_nascimento',
                $valorData,
                ['class' => 'form-control input-custom'] // Adicionei form-control para ficar igual aos outros inputs
            ) ?>
        </div>
        <div class="col-md-4">
            <?= Html::label('Nº de Telefone', 'telefone', ['class' => 'label-green']) ?>
            <?= Html::input(
                'text',
                'telefone',
                $valorNumeroTelefone,
                ['class' => 'form-control input-custom'] // Adicionei form-control para ficar igual aos outros inputs
            ) ?>
        </div>
        <div class="col-md-4">
            <?= Html::label('Nacionalidade', 'nacionalidade', ['class' => 'label-green']) ?>
            <?= Html::input(
                'text',
                'nacionalidade',
                $valorNacionalidade,
                ['class' => 'form-control input-custom'] // Adicionei form-control para ficar igual aos outros inputs
            ) ?>
        </div>
        <div class="col-md-4">
            <?= Html::label('Membro Desde', 'data_criacao', ['class' => 'label-green']) ?>
            <?= Html::input(
                'text',
                'data_criacao',
                $valorDataCriacao,
                ['class' => 'form-control input-custom', 'disabled' => true] // Adicionei form-control para ficar igual aos outros inputs
            ) ?>
        </div>
        <br>
        <div class="col-12 text-center mt-5">
            <div class="button">
                <?= Html::submitButton(
                    'Guardar os dados alterados',
                    ['class' => 'btn btn-success ']
                ) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>