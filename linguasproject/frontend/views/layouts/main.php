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
                            <img src="<?= Url::to('@web/assets/images/logo/white-logo.svg') ?>" alt="<?= Html::encode(Yii::$app->name) ?>">
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
                                    ['label' => 'About', 'url' => ['/site/about']],
                                    ['label' => 'Contact', 'url' => ['/site/contact']],
                                ];

                                // Renderiza os itens estáticos
                                foreach ($menuItems as $item) {
                                    $label = Html::encode($item['label']);
                                    $url = Url::to($item['url']);
                                    // marca "active" só se quiseres podes detectar rota actual
                                    echo '<li class="nav-item">' . Html::a($label, $url, ['class' => 'nav-link']) . '</li>';
                                }
                                ?>

                                <!-- Exemplos de dropdowns do template (estáticos) -->
                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                       data-bs-target="#submenu-1-1" aria-controls="navbarSupportedContent"
                                       aria-expanded="false">Pages</a>
                                    <ul class="sub-menu collapse" id="submenu-1-1">
                                        <li class="nav-item"><?= Html::a('About Us', ['/site/about'], ['class' => 'nav-link']) ?></li>
                                        <li class="nav-item"><?= Html::a('Our Pricing', ['/site/pricing'], ['class' => 'nav-link']) ?></li>
                                        <li class="nav-item"><?= Html::a('Sign In', ['/site/login'], ['class' => 'nav-link']) ?></li>
                                        <li class="nav-item"><?= Html::a('Sign Up', ['/site/signup'], ['class' => 'nav-link']) ?></li>
                                        <li class="nav-item"><?= Html::a('Reset Password', ['/site/request-password-reset'], ['class' => 'nav-link']) ?></li>
                                        <li class="nav-item"><?= Html::a('Mail Success', ['/site/mail-success'], ['class' => 'nav-link']) ?></li>
                                        <li class="nav-item"><?= Html::a('404 Error', ['/site/error'], ['class' => 'nav-link']) ?></li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                       data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                       aria-expanded="false">Blog</a>
                                    <ul class="sub-menu collapse" id="submenu-1-2">
                                        <li class="nav-item"><?= Html::a('Blog Grid', ['/blog/index'], ['class' => 'nav-link']) ?></li>
                                        <li class="nav-item"><?= Html::a('Blog Single', ['/blog/view', 'id' => 1], ['class' => 'nav-link']) ?></li>
                                    </ul>
                                </li>

                                <?php if (Yii::$app->user->isGuest): ?>
                                    <li class="nav-item"><?= Html::a('Signup', ['/site/signup'], ['class' => 'nav-link']) ?></li>
                                    <li class="nav-item"><?= Html::a('Login', ['/site/login'], ['class' => 'nav-link']) ?></li>
                                <?php else: ?>
                                    <li class="nav-item">
                                        <!-- mostra nome do utilizador sem dropdown complexo -->
                                        <a class="nav-link" href="javascript:void(0)"><?= Html::encode(Yii::$app->user->identity->username) ?></a>
                                    </li>

                                    <li class="nav-item">
                                        <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline']) .
                                        Html::submitButton('Logout', ['class' => 'btn btn-link nav-link p-0 text-start']) .
                                        Html::endForm() ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div> <!-- navbar collapse -->

                        <!-- Botão da direita (mantém o estilo do template) -->
                        <div class="button home-btn">
                            <a href="<?= Yii::$app->user->isGuest ? Url::to(['/site/signup']) : Url::to(['/dashboard/index']) ?>" class="btn">
                                <?= Yii::$app->user->isGuest ? 'Try for free' : 'Dashboard' ?>
                            </a>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>


<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
