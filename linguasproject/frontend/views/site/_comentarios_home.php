<?php
/** @var common\models\Comentario $model */
use yii\helpers\Url;
use yii\helpers\Html;

$auth = Yii::$app->authManager;
$UserRoles = $auth->getRolesByUser($model->utilizador->user->id);
$user_role = key($UserRoles);
?>

<div class="col-lg-6 col-12 mb-4">
    <a href="<?= Url::to(['/aula/view', 'id' => $model->aula->id]) ?>" class="testimonial-link">
        <div class="single-testimonial">
            <div class="inner-content">
                <div class="quote-icon">
                    <i class="lni lni-quotation"></i>
                </div>
                <div class="text">
                    <p>“<?= $model->descricao_comentario ?>”</p>
                </div>
                <div class="author">
                    <h4 class="name">
                        <?= $model->utilizador->user->username ?>
                        <span class="deg"><?= $user_role ?></span>
                    </h4>
                </div>
            </div>
            <div class="status-corner"></div>
        </div>
    </a>
</div>