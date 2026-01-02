<?php

/** @var common\models\Feedback $model */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<a class="lesson-link">
    <div class="feedback-list">
        <div class="feedback-card shadow-sm">
            <div class="feedback-left">
                <div class="subject-pill">
                    <?= Html::encode($model->assunto_feedback) ?>
                </div>
                <div class="feedback-date">
                    <?= date('d/m/Y H:i', strtotime($model->hora_criada)) ?>
                </div>
            </div>

            <div class="feedback-description">
                <?= Html::encode($model->descricao_feedback) ?>
            </div>
        </div>
    </div>
</a>


