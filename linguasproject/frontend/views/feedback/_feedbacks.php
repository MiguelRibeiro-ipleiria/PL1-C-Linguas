<?php

/** @var common\models\Feedback $model */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="feedback-card shadow-sm">
    <div class="feedback-col feedback-info">
        <div class="subject-pill">
            <?= $model->assunto_feedback ?>
        </div>
    </div>

    <div class="feedback-col feedback-content">
        <p><?= $model->descricao_feedback ?></p>
    </div>

    <div class="feedback-col feedback-status">
        <div class="status-pill ">
            <?php
            if($model->estado_feedback == 'Submetido' || $model->estado_feedback == 'Em progresso'){ ?>
                <p class="status-submited"><?= $model->estado_feedback ?></p>
            <?php }
            elseif($model->estado_feedback == 'Arquivado' || $model->estado_feedback == 'Concluído'){ ?>
                <p class="status-success"><?= $model->estado_feedback ?></p>
            <?php }
            else{ ?>
                <p class="status-missing"><?= $model->estado_feedback ?></p>
            <?php }
            ?>
        </div>
        <span class="feedback-date"><?= date('d/m/Y H:i', strtotime($model->hora_criada)) ?></span>

    </div>
</div>


