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
use common\models\User;
use common\models\Utilizador;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
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
    <?php $this->head(); ?>
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

                                foreach ($menuItems as $item) {
                                    $label = Html::encode($item['label']);
                                    $url = Url::to($item['url']);
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
        echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
    } else {
        $auth = Yii::$app->authManager;
        $userRoles = $auth->getRolesByUser(Yii::$app->user->id);
        $role = key($userRoles);

        echo Html::beginTag('div', ['class' => 'd-flex align-items-center']);

            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'me-2'])
                . Html::submitButton('Logout', ['class' => 'btn btn-link logout text-decoration-none'])
                . Html::endForm();

            if ($role == 'admin' || $role == 'formador') {
                echo Html::beginForm(['../../backend/web'], 'post')
                    . Html::submitButton('Backend', ['class' => 'btn btn-link logout text-decoration-none'])
                    . Html::endForm();
            }

        echo Html::endTag('div');
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
    <div class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end">Desenvolvido por: André Ventura, Guilherme Ferreira e Miguel Ribeiro</p>
        </div>
    </div>
</footer>

    <script src="<?= Yii::getAlias('@web').'js/bootstrap.min.js'; ?>"</script>
    <script src="<?= Yii::getAlias('@web').'js/wow.min.js'; ?>"</script>
    <script src="<?= Yii::getAlias('@web').'js/tiny-slider.js'; ?>"</script>
    <script src="<?= Yii::getAlias('@web').'js/glightbox.min.js'; ?>"</script>
    <script src="<?= Yii::getAlias('@web').'js/count-up.min.js'; ?>"</script>
    <script src="<?= Yii::getAlias('@web').'js/main.js'; ?>"</script>

</body>
</html>

