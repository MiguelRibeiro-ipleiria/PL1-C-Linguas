<?php
use yii\helpers\Html;

use common\models\Dificuldade;
use common\models\Idioma;
use common\models\Utilizador;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var common\models\Curso $model */
?>

<?php
$auth = Yii::$app->authManager;

$idioma = Idioma::findOne(['id' => $model->idioma_id]);
$dificuldade = Dificuldade::findOne(['id' => $model->dificuldade_id]);

?>

<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $model->titulo_curso ?><b>  (<?= $idioma->lingua_descricao ?>)</b></h3>

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
                                        $utilizadores = Utilizador::find()->where(['idioma_id' => $idioma->id])->all();
                                        $count = 0;
                                        foreach ($utilizadores as $utilizador) {

                                            $user = User::findOne(['id' => $utilizador->user_id]);
                                            $UserRoles = $auth->getRolesByUser($user->id);
                                            $userrole = key($UserRoles);
                                            if($userrole == "formador" && $utilizador->idioma_id == $idioma->id){
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
                                    <span class="info-box-number text-center text-muted mb-0">2000</span>
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
                    <div class="row">
                        <div class="col-12">
                            <h4>Recent Activity</h4>
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                    <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                        </span>
                                    <span class="description">Shared publicly - 7:45 PM today</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore.
                                </p>

                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                </p>
                            </div>

                            <div class="post clearfix">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                    <span class="username">
                          <a href="#">Sarah Ross</a>
                        </span>
                                    <span class="description">Sent you a message - 3 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore.
                                </p>
                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 2</a>
                                </p>
                            </div>

                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                    <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                        </span>
                                    <span class="description">Shared publicly - 5 days ago</span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    Lorem ipsum represents a long-held tradition for designers,
                                    typographers and the like. Some people hate it and argue for
                                    its demise, but others ignore.
                                </p>

                                <p>
                                    <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo File 1 v1</a>
                                </p>
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
                        <p class="text-sm">Idioma do Curso
                            <b class="d-block"><?= $idioma->lingua_descricao ?></b>
                        </p>
                        <p class="text-sm">Dificuldade do Curso
                            <b class="d-block"><?= $dificuldade->grau_dificuldade ?></b>
                        </p>
                    </div>
                    <div>
                        <a href="<?= Url::to(['/curso/update', 'id' => $model->id]) ?>" class="btn btn-success">Alterar dados do Curso</a>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->