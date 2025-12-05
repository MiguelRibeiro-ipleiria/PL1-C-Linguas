<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Comentario $model */

?>
<div class="comentario-create">
    <?= $this->render('_form', [
        'model' => $model,
        'aula' => $aula,
    ]) ?>

</div>
