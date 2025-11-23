<?php

use common\models\Feedback;
use common\models\Utilizador;
use common\models\Idioma;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var common\models\User $user */
/* @var $arrayusererole array */
/** @var yii\widgets\ActiveForm $form */


?>
<div class="row">

    <!-- CARD DE ORDERS -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Pedidos de Formação</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Língua a Lecionar</th>
                            <th>Status</th>
                            <th>Aceitar</th>
                            <th>Desativar</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($arrayusererole as $utilizadorrole) {
                                $utilizador = $utilizadorrole["user"];
                                $role = $utilizadorrole["role"];

                                $user = User::findOne($utilizador->user_id);
                                $lingua = Idioma::findOne($utilizador->idioma_id);
                               ?>
                                <tr>
                                    <td><?= $utilizador->id ?></td>
                                    <td><?= $user->username ?></td>
                                    <td><?= $lingua->lingua_descricao ?></td>
                                    <td>
                                        <?php
                                            if($role == "formador") {?>
                                                <span class="badge badge-success">Atribuído</span>
                                            <?php }
                                            else{ ?>
                                                <span class="badge badge-warning">Pendente</span>
                                            <?php }
                                        ?>
                                    </td>
                                    <td>
                                        <?php $form = ActiveForm::begin(); ?>
                                            <?= Html::hiddenInput('userid', $utilizador->user_id) ?>
                                            <?= Html::hiddenInput('role', 'formador') ?>
                                        <div>
                                                <?= Html::submitButton('Aceitar', ['class' => 'btn btn-success']) ?>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </td>
                                    <td>
                                        <?php $form = ActiveForm::begin(); ?>
                                        <?= Html::hiddenInput('userid', $utilizador->user_id) ?>
                                        <?= Html::hiddenInput('role', 'user_autenticado') ?>
                                        <div>
                                            <?= Html::submitButton('Desativar', ['class' => 'btn btn-danger']) ?>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </td>
                                </tr>
                            <?php }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>