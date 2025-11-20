<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Start Breadcrumbs -->
         <!-- End Breadcrumbs -->

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">

                    <div class="card login-form inner-content">
                        <div class="card-body">
                            <div class="title">
                                <h3>Realiza o teu Login</h3>
                                <p>Faz o login preenchendo os campos abaixo.</p>
                            </div>

                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                            <div class="form-group">
                            
                                <?= $form->field($model, 'username')
                                    ->textInput([
                                        'class' => 'form-controlle',
                                        'placeholder' => 'Enter your email'
                                    ])
                                    ->label(false) ?>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'password')
                                    ->passwordInput([
                                        'class' => 'form-controlle',
                                        'placeholder' => 'Enter your password'
                                    ])
                                    ->label(false) ?>
                            </div>


                            <!-- REMEMBER / FORGOT -->
                            <!--<div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check remember-wrap">
                                    <?= $form->field($model, 'rememberMe')
                                        ->checkbox(['class' => 'form-check-input']) ?>
                                </div>
                                <a class="lost-pass" href="reset-password.html">Forgot password?</a>
                            </div> -->

                            <!-- BUTTON -->
                            <div class="button">
                                <?= Html::submitButton('Login', ['class' => 'btn', 'name' => 'login-button']) ?>
                            </div>

                            <h4 class="create-account">
                              
                              <a>Não tem conta? <?= Html::tag('div',Html::a('Registe-se',['/site/signup']));?></a>
                            </h4>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script src="assets/js/count-up.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>