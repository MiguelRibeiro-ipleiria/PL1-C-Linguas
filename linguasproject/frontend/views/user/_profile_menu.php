<?php

use yii\helpers\Url;

?>
<style>
    body{
        padding-top: 110px;
    }
</style>
<div class="container">
    <aside class="col-lg-24 col-md-12 col-12">
        <div class="sidebar">
            <div class="widget popular-tag-widget">
                    <div class="tags">
                    <a href="<?= Url::to(['/user/update', 'id' => Yii::$app->user->identity->id]) ?>" >Os Meus Dados</a>
                    <a href="javascript:void(0)">Os Meus Cursos e Aulas</a>
                    <a href="<?= Url::to(['/comentario/index']) ?>">Os Meus Comentários</a>
                    <a href="<?= Url::to(['/user/meus-progressos', 'id' => Yii::$app->user->identity->id]) ?>" >Os Meus Progressos</a>
                    <a href="<?= Url::to(['/feedback/index']) ?>">Os Meus Feedbacks</a>
                </div>
            </div>
        </div>
    </aside>
</div>
