<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Utilizador;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
/** @var common\models\Utilizador $utilizador */
/** @var common\models\User $user */

?>
<?= $this->render('_profile_menu') ?>



<div class="user-form">

    <?php $form = ActiveForm::begin();

    $valorData = date('Y-m-d', strtotime($utilizador->data_nascimento));
    $valorNumeroTelefone = $utilizador->numero_telefone;
    $valorNacionalidade = $utilizador->nacionalidade;
    $valorDataCriacao = date('Y-m-d', strtotime($utilizador->data_inscricao));


    ?>


    <div class="container">
        <aside class="col-lg-24 col-md-12 col-12">
            <div class="sidebar">
                <div class="widget-content popular-tag-widget">
                    <div class="tags">
                        <div class="title-perfil">
                            <p>Os Meus Dados</p>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <?= Html::label('Username', 'username') ?>
                                    <?= Html::input(
                                        'text',
                                        'username',
                                        $user->username,
                                        ['class' => 'form-perfil form-control'] // Adicionei form-control para ficar igual aos outros inputs
                                    ) ?>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <?= Html::label('Email', 'email') ?>
                                    <?= Html::input(
                                        'text',
                                        'email',
                                        $user->email,
                                        ['class' => 'form-perfil form-control'] // Adicionei form-control para ficar igual aos outros inputs
                                    ) ?>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <?= Html::label('Data de Nascimento', 'data_nascimento') ?>
                                    <?= Html::input(
                                        'date',
                                        'data_nascimento',
                                        $valorData,
                                        ['class' => 'form-perfil form-control'] // Adicionei form-control para ficar igual aos outros inputs
                                    ) ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <?= Html::label('Nº de Telefone', 'telefone') ?>
                                    <?= Html::input(
                                        'text',
                                        'telefone',
                                        $valorNumeroTelefone,
                                        ['class' => 'form-perfil form-control'] // Adicionei form-control para ficar igual aos outros inputs
                                    ) ?>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <?= Html::label('Nacionalidade', 'nacionalidade') ?>
                                    <?= Html::input(
                                        'text',
                                        'nacionalidade',
                                        $valorNacionalidade,
                                        ['class' => 'form-perfil form-control'] // Adicionei form-control para ficar igual aos outros inputs
                                    ) ?>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <?= Html::label('Data de Criação', 'data_criacao') ?>
                                    <?= Html::input(
                                        'text',
                                        'data_criacao',
                                        $valorDataCriacao,
                                        ['class' => 'form-perfil form-control' , 'disabled' => true] // Adicionei form-control para ficar igual aos outros inputs
                                    ) ?>
                                </div>
                            </div>
                            <br>

                            <div class="col-12">
                                <br>
                                <div class="button">
                                    <?= Html::submitButton('Guardar Dados Alterados', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <?php ActiveForm::end(); ?>

</div>

