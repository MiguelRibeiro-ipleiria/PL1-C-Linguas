<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */

/** @var common\models\User $user */
/* @var $ListadeRoles array */
/* @var $userrole string */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList(
        'role',
        $userrole,
        $ListadeRoles,
        ['class' => 'form-control']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Atribuir Role', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
