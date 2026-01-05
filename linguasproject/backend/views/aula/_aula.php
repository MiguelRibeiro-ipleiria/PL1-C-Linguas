<?php
use yii\helpers\Html;
use common\models\Dificuldade;
use common\models\Idioma;
use common\models\Utilizador;
use common\models\Aula;
use common\models\User;
use common\models\Curso;
use common\models\Comentario;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var common\models\aula $model */
?>

<?php
$auth = Yii::$app->authManager;
?>

<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $model->titulo_aula ?></h3>

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
                                    <span class="info-box-text text-center text-muted">Dono da Aula</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= $model->utilizador->user->username ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Curso</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?=$model->curso->titulo_curso?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Número de Exercícios</span>
                                    <span class="info-box-number text-center text-muted mb-0"><?= $model->numero_de_exercicios ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h4>Comentários</h4>
                            <div class="post">
                      <div class="user-block">
                        <span class="username">
                          <?php if ($model->getComentarios()->count() <= 0) {

                                echo 'Não há comentários da Aula.';
                            }
                            else{
                                foreach($model->getComentarios()->all() as $comentario){?>
                            <div class="post">
                                <div class="user-block">

                                    <span class="username">
                                <?= $comentario->utilizador->user->username ?>
                                </span>
                                    <span class="description"><?=$comentario->hora_criada?></span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                    <?=$comentario->descricao_comentario?>
                                </p>
                            </div>

                            <?php }} ?>
                        </span>
                      </div>

                    </div>
                            
                        </div>
                    </div>
                </div>

                
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <h3 class="text-primary"><i class="fas fa-book"></i>   <?= $model->titulo_aula ?></h3>
                    <span class="time text-muted"><i class="fas fa-clock"></i> <?= $model->tempo_estimado ?> de tempo estimado</span>
                    <br>
                    <br>
                    <div class="text-muted">
                        <p class="text-sm">Descrição do Curso
                            <b class="d-block"><?= $model->descricao_aula ?></b>
                        </p>
                        <p class="text-sm">Data de criação
                            <b class="d-block"><?= $model->data_criacao ?></b>
                        </p>
                        <p class="text-sm">Nome do curso
                            <b class="d-block"><?= $model->curso->titulo_curso ?></b>
                        </p>
                    </div>
                    <div>
                        <a href="<?= Url::to(['/aula/update', 'id' => $model->id]) ?>" class="btn btn-success">Alterar dados da Aula</a>
                        <a href="<?= Url::to(['/aula/escolherexercicio', 'aula_id' => $model->id]) ?>" class="btn btn-success">Adicionar Exercicio</a>
                    </div>

                                    
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

<!-- /.content -->