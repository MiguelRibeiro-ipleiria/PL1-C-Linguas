<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Escolher Exercício';

$this->registerCss("
    .exercise-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
    }
    .exercise-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1) !important;
    }
    .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    .img-icon {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }
");
?>

<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="font-weight-bold">Conteúdo da Aula</h2>
        <p class="text-muted">Selecione o tipo de exercício que deseja criar para esta aula.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm exercise-card text-center p-3">
                <div class="card-body">
                    <div class="icon-box" style="background-color: #eef6ff;">
                        <?= Html::img(Url::to('@web/img/image-solid.png'), ['class' => 'img-icon']) ?>
                    </div>
                    <h4 class="font-weight-bold">Imagens</h4>
                    <p class="small text-muted">Exercícios visuais e ilustrações.</p>
                    <?= Html::a('Criar', Url::to(['imagem/create', 'aula_id' => $aula_id]), [
                        'class' => 'btn btn-primary btn-block rounded-pill'
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm exercise-card text-center p-3">
                <div class="card-body">
                    <div class="icon-box" style="background-color: #f0fdf4;">
                        <?= Html::img(Url::to('@web/img/font-solid.png'), ['class' => 'img-icon']) ?>
                    </div>
                    <h4 class="font-weight-bold">Frases</h4>
                    <p class="small text-muted">Tradução e gramática textual.</p>
                    <?= Html::a('Criar', Url::to(['frase/create', 'aula_id' => $aula_id]), [
                        'class' => 'btn btn-success btn-block rounded-pill'
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm exercise-card text-center p-3">
                <div class="card-body">
                    <div class="icon-box" style="background-color: #ecfeff;">
                        <?= Html::img(Url::to('@web/img/headphones-solid.png'), ['class' => 'img-icon']) ?>
                    </div>
                    <h4 class="font-weight-bold">Áudios</h4>
                    <p class="small text-muted">Compreensão oral e escuta.</p>
                    <?= Html::a('Criar', Url::to(['audio/create', 'aula_id' => $aula_id]), [
                        'class' => 'btn btn-info text-white btn-block rounded-pill'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>