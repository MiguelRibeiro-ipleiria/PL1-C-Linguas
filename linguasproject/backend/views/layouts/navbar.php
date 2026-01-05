<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Feedback;
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?=\yii\helpers\Url::home()?>" class="nav-link">Home</a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"><?= Feedback::find()->count()?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="overflow-y: auto;">
                <?php
                    if (\Yii::$app->user->can('ReadFeedback')) {?>
                    <span class="dropdown-header"><?= Feedback::find()->count()?> Feedbacks</span>
                    <?php
                        foreach (Feedback::find()->all() as $feedback) {?>
                            <div class="dropdown-divider"></div>
                            <a href="<?= Url::to(['/feedback/view', 'id' => $feedback->id]) ?>" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i><?= $feedback->assunto_feedback?>
                            </a>
                        <?php }
                    ?>
                <?php }
                    else{?>
                        <span class="dropdown-header">Acesso Negado</span>
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-header">Você não tem acesso a este serviço!</span>
                    <?php }
                ?>
                <a href="<?= Url::to(['/feedback/index']) ?>" class="dropdown-item dropdown-footer">Ver todos os Feedbacks</a>
            </div>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->