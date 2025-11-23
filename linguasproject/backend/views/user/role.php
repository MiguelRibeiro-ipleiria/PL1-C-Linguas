<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */

/** @var common\models\User $user */
/* @var $ListadeRoles array */
/* @var $userrole string */
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Role Table</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Utilizador</th>
                <th>Role Atual</th>
                <th>Nova Role</th>
                <th>Guardar Role</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php $form = ActiveForm::begin(); ?>
                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><i><?= $userrole == null ? "Sem role atribuída" : $userrole ?></i></td>
                <td>
                    <?= Html::dropDownList(
                        'role',
                        $userrole,
                        $ListadeRoles,
                        ['class' => 'form-control select2 select2-warming']
                    ) ?>
                </td>
                <td>
                    <div>
                        <?= Html::submitButton('Atribuir Role', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </td>

            </tr>
            </tbody>
        </table>
    </div>
</div>