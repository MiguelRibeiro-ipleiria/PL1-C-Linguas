<?php
use yii\bootstrap5\Html;
use yii\helpers\Url;

?>
<header>
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/css/site.css'; ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web').'/js/dropzone.min.js'; ?>">

</header>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <?= html::a('
        <img src="'.$assetDir.'/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity:.8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>',['/'], ['class' => 'brand-link', 'encode' => false]
    )
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= Url::to(['/user/account', 'id'=> Yii::$app->user->id]) ?>" class="d-block">
                    <?php
                        if(Yii::$app->user->isGuest){
                            echo Yii::$app->user->isGuest;
                        }
                        else{
                            echo Yii::$app->user->identity->username;
                        }
                    ?>
                </a>
            </div>

        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'REGISTOS DE AUDITORIA', 'header' => true],
                    ['label' => 'Timeline', 'url' => ['site/timeline'], 'icon' => 'sign-in-alt'],
                    ['label' => 'CONTA', 'header' => true],
                    ['label' => 'Informações da conta',  'icon' => 'user', 'url' => ['/user/account', 'id'=> Yii::$app->user->id]],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'ADMISTRAÇÃO', 'header' => true],
                    ['label' => 'Utilizadores',  'icon' => 'user','url' => ['/user/index']],
                    ['label' => 'Pedidos de Formador', 'url' => ['user/formador'], 'icon' => 'clipboard-list'],
                    ['label' => 'FEEDBACKS GERAIS', 'header' => true],
                    ['label' => 'Feedbacks',  'icon' => 'thumbs-up','url' => ['/feedback/index']],
                    ['label' => 'Comentários',  'icon' => 'comments','url' => ['/comentario/index']],
                    ['label' => 'PAINEL CONTROLO', 'header' => true],
                    ['label' => 'Tipos de exercicio',  'icon' => 'tasks','url' => ['/tipoexercicio/index']],
                    ['label' => 'Dificuldade',  'icon' => 'exclamation-triangle', 'url' => ['/dificuldade/index']],
                    ['label' => 'Idiomas',  'icon' => 'language', 'url' => ['/idioma/index']],
                    ['label' => 'Cursos',  'icon' => 'book', 'url' => ['/curso/index']],
                    ['label' => 'Aulas',  'icon' => 'book', 'url' => ['/aula/index']],
                    ['label' => 'EXERCÍCIOS', 'header' => true],
                    ['label' => 'Imagens',  'icon' => 'image', 'url' => ['/imagem/index']],
                    ['label' => 'Áudios',  'icon' => 'music', 'url' => ['/audio/index']],
                    ['label' => 'Frases',  'icon' => 'book', 'url' => ['/frase/index']],
                    ['label' => 'RESOURCES', 'header' => true],
                    ['label' => 'imagens (resource)' ,  'icon' => 'image','url' => ['/imagemresource/index']],
                    ['label' => 'audio (resource)',  'icon' => 'music','url' => ['/audioresource/index']],
                    ['label' => 'PROGRESSOS DOS UTILIZADORES', 'header' => true],
                    ['label' => 'Inscrições nos Cursos',  'icon' => 'user','url' => ['/inscricao/index']],
                    ['label' => 'Resultados das Aulas',  'icon' => 'tasks','url' => ['/resultado/index']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>