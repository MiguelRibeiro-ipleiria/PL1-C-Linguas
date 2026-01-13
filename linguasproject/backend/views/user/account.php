<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var $user common\models\User */
use common\models\User;
use common\models\Utilizador;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

                  <?php
                    $this->title = 'Informações da Conta';

                    $auth = Yii::$app->authManager;
                    $user_id = Yii::$app->user->id;
                    $utilizador = Utilizador::findOne(['user_id' => $user_id]);
                    $userRoles = $auth->getRolesByUser($user_id);
                    $role = key($userRoles);
                  ?>

    <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form>
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"
                        >Nome</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value="<?= $user->username?>"
                        />

                      </div>
                       <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label"
                        >Email</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value="<?= $user->email?>"
                        />
                    </div>
                     <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label"
                        >Data de nascimento</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value="<?= $user->utilizador->data_nascimento?>"
                        />
                    </div>
                     <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label"
                        >Numero de telefone</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value="<?= $user->utilizador->numero_telefone?>"
                        />
                      </div>  
                       <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label"
                        >Nacionalidade</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value="<?= $user->utilizador->nacionalidade?>"
                        />
                      </div>
                      <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label"
                        >Data de inscrição</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value="<?= $user->utilizador->data_inscricao?>"
                        />
                      </div>
                      <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label"
                        >Role</label>
                        <input
                          type="email"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                          value="<?= $role?>"
                        />
                      </div>
                      </div>

                    </div>

                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
</body>
</html>