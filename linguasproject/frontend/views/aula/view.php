<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var common\models\Aula $model */
/** @var int $imgexercicios */
/** @var int $audioexercicios */
/** @var int $fraseexercicios */
/** @var int $commentscount */
/** @var yii\data\ActiveDataProvider $DataCommentsProvider */
/** @var common\models\Comentario $modelcomentario */

$this->title = $model->titulo_aula;
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="services section cursos">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"><?= $model->curso->idioma->lingua_descricao ?> - <?= $model->curso->titulo_curso ?> - <?= $model->titulo_aula ?></h2>
                    <h3 class="wow zoomIn" data-wow-delay=".2s"><?= $model->numero_de_exercicios ?> exercícios disponíveis</h3>
                </div>
            </div>
        </div>
        <div class="aula-index mt-5">
            <div class="row">
                <div class="col-8">
                    <div class="aula-index mt-5">
                        <div class="aula-detail-card">
                            <div class="row d-flex align-items-center g-0">

                                <div class="col-9 aula-content-area">

                                    <div class="card-header-aula-flex">
                                        <h3 class="card-aula-title"><?= $model->titulo_aula ?></h3>
                                    </div>
                                    <p class="card-aula-description mt-2">
                                        <?= $model->descricao_aula ?>
                                    </p>
                                    <span class="badge-custom level-badge">Tempo Estimado: <?= $model->tempo_estimado ?></span>
                                    <span class="badge-custom level-badge">Exercícios Disponíveis: <?= $model->numero_de_exercicios ?> exercícios</span>
                                </div>

                                <div class="col-3 d-flex justify-content-center align-items-center aula-action-area">
                                    <section class="intro-video-area section-idiomas-cursos">
                                        <div class="inner-content-head">
                                            <div class="inner-content">
                                                <div class="intro-video-play">
                                                    <div class="play-thumb wow zoomIn" data-wow-delay=".2s">
                                                        <a id="open_dialog"><i class="lni lni-play"></i></a>
                                                        <dialog aria-labelledby="dialog_title" aria-describedby="dialog_description">
                                                            <img src="<?= Yii::getAlias('@web').'/img/logo_dialog.png'; ?>" alt="Illustration of Location Services" />
                                                            <h2 id="dialog_title" class="h2">Deseja começar a Aula?</h2>
                                                            <p id="dialog_description">
                                                                Ao clicar em "Sim" irá começar a sua aula "<?= $model->titulo_aula ?>", preste atenção
                                                                e responda corretamente.
                                                            </p>
                                                            <div class="boxflex flex-space-between">
                                                                <button id="close_dialog">Não</button>
                                                                <button id="confirm_dialog" class="cta">Sim</button>
                                                            </div>
                                                        </dialog>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="aula-index mt-5">
                        <div class="aula-detail-card">
                            <div class="row d-flex align-items-center g-0">

                                <div class="col-9 aula-content-area">

                                    <div class="card-header-aula-flex">
                                        <h3 class="card-aula-title">Tipos de Exercícios</h3>
                                    </div>
                                    <br>
                                    <?php
                                        if($imgexercicios >= 1){ ?>
                                            <span class="badge-custom level-badge"><?= $imgexercicios ?>x Exercícios de Imagens</span>
                                        <?php }

                                        if($audioexercicios >= 1){ ?>
                                            <span class="badge-custom level-badge"><?= $audioexercicios ?>x Exercícios de Áudio</span>
                                        <?php }

                                        if($fraseexercicios >= 1){ ?>
                                            <span class="badge-custom level-badge"><?= $fraseexercicios ?>x Exercícios de Frases</span>
                                        <?php }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header-aula-flex">
                <h3 class="card-aula-title">Agendamento da Aula</h3>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="aula-index mt-5">
                        <div class="aula-detail-card">
                            <div class="row d-flex align-items-center g-0">

                                <div class="col-9 aula-content-area">

                                    <div class="card-header-aula-flex">
                                        <h3 class="card-aula-title"><?= $model->titulo_aula ?></h3>
                                    </div>
                                    <p class="card-aula-description mt-2">
                                        <?= $model->descricao_aula ?>
                                    </p>
                                    <span class="badge-custom level-badge">Tempo Estimado: <?= $model->tempo_estimado ?></span>
                                    <span class="badge-custom level-badge">Exercícios Disponíveis: <?= $model->numero_de_exercicios ?> exercícios</span>
                                </div>

                                <div class="col-3 d-flex justify-content-center align-items-center aula-action-area">
                                    <section class="intro-video-area section-idiomas-cursos">
                                        <div class="inner-content-head">
                                            <div class="inner-content">
                                                <div class="intro-video-play">
                                                    <div class="play-thumb wow zoomIn" data-wow-delay=".2s">
                                                        <a href="<?= Url::to(['/inscricao/create', 'curso_id' => $model->id], ['/curso/aulas', 'id' => $model->id]) ?>"
                                                        ><i class="lni lni-play"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="badge-custom-comments-title level-badge"><?= $commentscount ?> Comentários</span>
            <div class="row">
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $DataCommentsProvider,
                    'itemView' => '_comments',
                    'layout' => "<div class='cards-grid'>{items}</div>\n<div class='mt-4'>{pager}</div>",
                    'itemOptions' => ['tag' => false],
                    'emptyText' => 'Sem avaliações, seja o primeiro a comentar!']) ?>
            </div>
            <hr>
            <span class="badge-custom-comments-title level-badge">Deixe aqui o seu comentário</span>
            <aside class="col-lg-12 col-md-12 col-12">
                <div class="sidebar">
                    <div class="filter popular-tag-widget">
                        <div class="tags">
                            <div class="row d-flex align-items-center g-0">
                                <div class="comments">
                                    <div class="row">
                                        <div class="contact-form">
                                            <?= $this->render('../comentario/create', [
                                                'model' => $modelcomentario,
                                                'aula' => $model,
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<script type="module">
    import dialogPolyfill from "https://cdn.skypack.dev/dialog-polyfill@0.5.6";

    const dialog = document.querySelector("dialog");
    const openDialogBtn = document.getElementById("open_dialog");
    const closeDialogBtn = document.getElementById("close_dialog");

    const elements = dialog.querySelectorAll(
        'a, button, input, textarea, select, details, [tabindex]:not([tabindex="-1"])'
    );
    const firstElement = elements[0];
    const lastElement = elements[elements.length - 1];

    const trapFocus = (e) => {
        if (e.key === "Tab") {
            const tabForwards = !e.shiftKey && document.activeElement === lastElement;
            const tabBackwards = e.shiftKey && document.activeElement === firstElement;
            if (tabForwards) {
                // only TAB is pressed, not SHIFT simultaneously
                // Prevent default behavior of keydown on TAB (i.e. focus next element)
                e.preventDefault();
                firstElement.focus();
            } else if (tabBackwards) {
                // TAB and SHIFT are pressed simultaneously
                e.preventDefault();
                lastElement.focus();
            }
        }
    };

    const openDialog = () => {
        dialog.showModal();
        dialog.addEventListener("keydown", trapFocus);
    };

    const closeDialog = (e) => {
        e.preventDefault();
        dialog.close();
        dialog.removeEventListener("keydown", trapFocus);
        openDialogBtn.focus();
    };

    openDialogBtn.addEventListener("click", openDialog);
    closeDialogBtn.addEventListener("click", closeDialog);

    if (typeof dialog.showModal !== "function") {
        /**
         * How to add polyfill outside CodePen conditionally
         * let polyfill = document.createElement("script");
         * polyfill.type = "text/javascript";
         * polyfill.src = "/dist/dialog-polyfill.js";
         * document.body.append(polyfill);

         * const polyfillStyles = document.createElement("link");
         * polyfillStyles.rel = "stylesheet";
         * polyfillStyles.href = "dialog-polyfill.css";
         * document.head.append(polyfillStyles);
         **/

        // Register polyfill on dialog element once the script has loaded
        dialogPolyfill.registerDialog(dialog);
    }
</script>