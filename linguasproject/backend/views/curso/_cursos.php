<?php
use yii\helpers\Html;

use common\models\Dificuldade;
use common\models\Idioma;
use common\models\Utilizador;
use common\models\User;
use common\models\Aula;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var common\models\Curso $model */
?>

<?php
$auth = Yii::$app->authManager;

?>

<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $model->titulo_curso ?><b>  (<?= $model->idioma->lingua_descricao ?>)</b></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Formadores Disponíveis</span>
                                    <span class="info-box-number text-center text-muted mb-0">
                                        <?php
                                        $utilizadores = Utilizador::find()->where(['idioma_id' => $model->idioma->id])->all();
                                        $count = 0;
                                        foreach ($utilizadores as $utilizador) {

                                            $user = $utilizador->getUser()->one();
                                            $UserRoles = $auth->getRolesByUser($user->id);
                                            $userrole = key($UserRoles);
                                            if($userrole == "formador" && $utilizador->idioma_id == $model->idioma->id){
                                                $count ++;
                                            }
                                        }
                                        echo $count;
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Aulas do Curso</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= $model->getAulas()->count() ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Estado do Curso</span>
                                    <span class="info-box-number text-center text-muted mb-0">
                                        <?php

                                        if($model->status_ativo == 1){
                                            echo "Ativado";
                                        }
                                        else{
                                            echo "Desativado";
                                        }


                                        ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <h3 class="text-primary"><i class="fas fa-book"></i>   <?= $model->titulo_curso ?></h3>
                    <span class="time text-muted"><i class="fas fa-clock"></i> <?= $model->data_criacao ?></span>
                    <br>
                    <br>
                    <div class="text-muted">
                        <p class="text-sm">Descrição do Curso
                            <b class="d-block"><?= $model->curso_detalhe ?></b>
                        </p>
                        <p class="text-sm">Idioma do Curso
                            <b class="d-block"><?= $model->idioma->lingua_descricao ?></b>
                        </p>
                        <p class="text-sm">Dificuldade do Curso
                            <b class="d-block"><?= $model->dificuldade->grau_dificuldade ?></b>
                        </p>
                    </div>
                    <div>
                        <a href="<?= Url::to(['/curso/update', 'id' => $model->id]) ?>" class="btn btn-success">Alterar dados do Curso</a>
                        <a href="<?= Url::to(['/aula/index','curso_id' => $model->id]) ?>" class="btn btn-success">Ver aulas do Curso</a>
                    </div>
                    <br>
                    <div>
                        <a href="<?= Url::to(['/curso/view', 'id' => $model->id]) ?>" class="btn btn-success">Ver todos os dados do Curso</a>
                        <?php $form = ActiveForm::begin(['action' => ['/aula/delete', 'id' => $model->id], 'options' => ['style' => 'display:inline-block;']]); ?>
                        <?= Html::submitButton(
                            'Eliminar Aula',
                            [
                                'class' => 'btn btn-success',
                            ]
                        ) ?>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->