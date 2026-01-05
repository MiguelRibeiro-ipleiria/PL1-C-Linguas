<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Curso $model */
/** @var string $userrole */
/** @var common\models\User $user */

$this->title = 'Update Curso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="curso-update">

    <?= $this->render('_form_update', [
        'model' => $model,
        'userrole' => $userrole,
        'user' => $user,
    ]) ?>

</div>
