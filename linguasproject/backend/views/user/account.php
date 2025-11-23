<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var $user common\models\User */


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header">
                    <div class="card-title">Informações da conta</div>
                  </div>
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
                      </div>

                    </div>

                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
</body>
</html>