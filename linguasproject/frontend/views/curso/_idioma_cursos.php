<?php
use yii\helpers\Url;
use common\models\Inscricao;
use \common\models\Utilizador;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var common\models\Curso $model */

?>

<div class="container my-4">
        <div class="course-detail-card">
            <div class="row d-flex align-items-center g-0">

                <div class="col-8 course-content-area">

                    <div class="card-header-flex">
                        <h3 class="card-course-title"><?= $model->titulo_curso ?></h3>
                        <span class="badge-custom level-badge"><?= $model->dificuldade->grau_dificuldade ?></span>
                        <span class="badge-custom classes-badge">
                            <?php
                                if($model->getAulas()->count() > 1){ ?>
                                    <?= $model->getAulas()->count() ?> aulas
                                <?php }elseif($model->getAulas()->count() == 1){ ?>
                                    <?= $model->getAulas()->count() ?> aula
                            <?php } else{ ?>
                                    Sem aulas
                                <?php }?>
                        </span>

                    </div>
                    <p class="card-course-description mt-2">
                        <?= $model->curso_detalhe ?>
                    </p>
                </div>

                <?php
                    if(\Yii::$app->user->can('SearchCourse') && !(Inscricao::verificainscricao($model->id, Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one()))){ ?>
                        <div class="col-4 d-flex justify-content-center align-items-center course-action-area">
                            <section class="intro-video-area section-idiomas-cursos">
                                <div class="inner-content-head">
                                    <div class="inner-content">
                                        <div class="button home-btn">
                                            <?php
                                            if($model->status_ativo == 0){ ?>
                                                <div class="button">
                                                    <a class="styliesh-off">Desativado</a>
                                                </div>
                                            <?php }
                                            else{ ?>
                                                <div class="button">
                                                    <a href="<?= Url::to(['/inscricao/create', 'curso_id' => $model->id]) ?>" class="styliesh">Inscrever-me</a>
                                                </div>
                                            <?php }

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                <?php
                    }else{
                        if($model->status_ativo == 0){ ?>
                            <div class="col-4 d-flex justify-content-center align-items-center course-action-area">
                                <section class="intro-video-area section-idiomas-cursos">
                                    <div class="inner-content-head">
                                        <div class="inner-content">
                                            <div class="button home-btn">
                                                <div class="button">
                                                    <a class="styliesh-off">Desativado</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        <?php
                        }else{
                        ?>
                        <div class="col-3 d-flex justify-content-center align-items-center course-action-area">
                            <section class="intro-video-area section-idiomas-cursos">
                                <div class="inner-content-head">
                                    <div class="inner-content">
                                        <div class="button home-btn">
                                            <div class="button">
                                                <button class="styliesh-red" id="open_dialog">
                                                    Desinscrever
                                                </button>
                                                <dialog aria-labelledby="dialog_title" aria-describedby="dialog_description">
                                                    <img src="<?= Yii::getAlias('@web').'/img/logo_dialog.png'; ?>" alt="Illustration of Location Services" />
                                                    <h2 id="dialog_title" class="h2">Deseja cancelar a inscrição?</h2>
                                                    <p id="dialog_description">
                                                        Ao clicar em "Sim" irá cancelar a sua inscrição no curso "<?= $model->titulo_curso ?>"
                                                        e eliminar os seus resultados nas aulas deste curso!
                                                    </p>
                                                    <div class="boxflex flex-space-between dialog-buttons-container">
                                                        <button type="button" id="close_dialog" class="btn-dialog-footer">Não</button>

                                                        <?php
                                                        $utilizador = Utilizador::find()->where(['user_id' => \Yii::$app->user->id])->one();
                                                        $form = ActiveForm::begin([
                                                            'action' => ['/inscricao/delete', 'utilizador_id' => $utilizador->id, 'curso_idcurso' => $model->id],
                                                            'options' => ['class' => 'form-dialog-footer']
                                                        ]);
                                                        ?>
                                                        <?= Html::submitButton('Sim', [
                                                            'class' => 'btn-dialog-footer confirm-btn',
                                                            'id' => 'confirm_dialog',
                                                        ]) ?>
                                                        <?php ActiveForm::end(); ?>
                                                    </div>
                                                </dialog>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                            <?php
                        }
                            ?>
                        <div class="col-1 d-flex justify-content-center align-items-center course-action-area">
                            <section class="intro-video-area section-idiomas-cursos">
                                <div class="inner-content-head">
                                    <div class="inner-content">
                                        <div class="button home-btn">
                                            <div class="button">

                                                <?php
                                                  if($model->status_ativo == 1){ ?>
                                                      <a href="<?= Url::to(['/curso/aulas', 'id' => $model->id]) ?>" class="styliesh"><i class="bi bi-arrow-right"></i></a>
                                                <?php
                                                  }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    <?php
                    }
                ?>
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
