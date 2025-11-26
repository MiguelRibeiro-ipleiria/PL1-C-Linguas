<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/main.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/glightbox.min.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/LineIcons.3.0.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/tiny-slider.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/animate.css'; ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header style="background: #2ed06e;" class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">
                    <!-- Start Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <!-- Logo: usa Url::to para caminho correcto -->
                        <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
                            <img src="<?= Yii::getAlias('@web').'/img/logo.jpg'; ?>" alt="<?= Html::encode(Yii::$app->name) ?>">
                        </a>

                        <!-- Botão mobile -->
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <!-- Menu (dinâmico com PHP; mantém as funcionalidades) -->
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <?php
                                // items estáticos (podes adicionar dinamicamente se quiseres)
                                $menuItems = [
                                    ['label' => 'Home', 'url' => ['/site/index']],
                                    ['label' => 'Línguas', 'url' => ['/idioma/index']],
                                    ['label' => 'Cursos', 'url' => ['curso/index']],
                                    ['label' => 'Feedback', 'url' => ['/feedback/create']],
                                ];
                                if (Yii::$app->user->isGuest) {
                                    $menuItems[] = ['label' => 'Perfil', 'url' => ['/site/login']];
                                } else {
                                    $menuItems[] = ['label' => 'Perfil', 'url' => ['/user/update', 'id' => Yii::$app->user->identity->id]];
                                }

                                // Renderiza os itens estáticos
                                foreach ($menuItems as $item) {
                                    $label = Html::encode($item['label']);
                                    $url = Url::to($item['url']);
                                    // marca "active" só se quiseres podes detectar rota actual
                                    echo '<li class="nav-item">' . Html::a($label, $url, ['class' => 'nav-link']) . '</li>';
                                }
                                ?>


                            </ul>
                        </div> <!-- navbar collapse -->

                        <!-- Botão da direita (mantém o estilo do template) -->
                        <div class="button home-btn">
                            <?php
                            if (Yii::$app->user->isGuest) {
                                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                            }

                            if (Yii::$app->user->isGuest) {
                                echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
                            } else {
                                echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                                    . Html::submitButton(
                                        'Logout',
                                        ['class' => 'btn btn-link logout text-decoration-none']
                                    )
                                    . Html::endForm();
                            }
                            ?>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>


<main role="main" class="flex-shrink-0">
    <div class="mt-5">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <!-- Start Footer Top -->
    <div class="container">
        <div class="inner-content">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Widget -->
                    <br>
                    <div class="single-footer f-about">
                        <div class="logo">
                            <img src="<?= Yii::getAlias('@web').'/img/logo.jpg'; ?>" alt="#">
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
            <hr>
        </div>
    </div>
<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end">Desenvolvido por: André Ventura, Guilherme Ferreira e Miguel Ribeiro</p>
    </div>
</footer>

</body>
</html>
