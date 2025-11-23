<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Idioma;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Sign Up - Spark App Landing Page Template.</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/LineIcons.3.0.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
</head>

<body>



    <!-- Start Account Signup Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">

                    <?php $form = ActiveForm::begin([
                        'id' => 'form-signup',
                        'options' => ['class' => 'card login-form inner-content']
                    ]); ?>

                        <div class="card-body">
                            <div class="title">
                                <h3>Registe-se</h3>
                                <p>Use o formulário abaixo para criar a sua conta.</p>
                            </div>

                            <div class="input-head">

                                <div class="row">

                                    <!-- USERNAME -->
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label></label>
                                            <?= $form->field($model, 'username')->textInput([
                                                'class' => 'form-controlle',
                                                'placeholder' => 'O seu Username'
                                            ])->label(false) ?>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label></label>
                                            <?= $form->field($model, 'email')->textInput([
                                                'class' => 'form-controlle',
                                                'placeholder' => 'O seu email'
                                            ])->label(false) ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label></label>
                                    <?= $form->field($model, 'password')->passwordInput([
                                        'class' => 'form-controlle',
                                        'placeholder' => 'Password'
                                    ])->label(false) ?>
                                </div>

                                <!-- Data nascimento -->
                                <div class="form-group">
                                    <label></label>
                                    <?= $form->field($model, 'data_nascimento')->input('date', [
                                        'class' => 'form-controlle datepicker'
                                    ])->label(false) ?>
                                </div>

                                <!-- Telefone -->
                                <div class="form-group">
                                    <label></label>
                                    <?= $form->field($model, 'telefone')->input('tel', [
                                        'class' => 'form-controlle',
                                        'placeholder' => 'Telefone'
                                    ])->label(false) ?>
                                </div>

                                <!-- Nacionalidade -->
                                <div class="form-group">
                                    <label></label>
                                    <?= $form->field($model, 'nacionalidade')->textInput([
                                        'class' => 'form-controlle',
                                        'placeholder' => 'Nacionalidade'
                                    ])->label(false) ?>
                                </div>

                                <!-- Idioma -->
                               <div class="form-group ">
                                    <label><i class="lni lni-world"></i></label>
                                    <?= $form->field($model, 'idioma_id')->dropDownList(
                                        ArrayHelper::map(Idioma::find()->asArray()->all(), 'id', 'lingua_descricao'),
                                        ['prompt' => 'Selecione um idioma', 'class' => 'form-controlle']
                                    )->label(false) ?>
                                </div>

                            </div>

                            <div class="button">
                                <?= Html::submitButton('Criar Conta', ['class' => 'btn']) ?>
                            </div>
                           <h4 class="create-account">
                              
                              <a> Já tem conta? <?= Html::tag('div',Html::a('Login',['/site/login']));?></a>
                            </h4>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
    <!-- End Account Signup Area -->

    <!-- ========================= JS ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
            orientation: 'bottom',
            language: 'pt-BR'
        });
    </script>

</body>

</html>
