<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\bootstrap5\ActiveForm $form */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>
<?= $this->render('_profile_menu') ?>

<div class="user-view">
    <br>
    <br>
    <!--
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'created_at',
            'updated_at',
            'verification_token',
        ],
    ]) ?> -->

    <?php $form = ActiveForm::begin(); ?>

    <div class="container">
        <aside class="col-lg-24 col-md-12 col-12">
            <div class="sidebar">
                <div class="widget-content popular-tag-widget">
                    <div class="tags">
                        <p>Os Meus Dados</p>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label></label>
                                    <?= $form->field($model, 'username')->textInput([
                                        'class' => 'form-perfil',
                                        'placeholder' => 'O seu Username'
                                    ])->label(false) ?>
                                </div>
                            </div>
                            <div class="col-4">
                                <p>ffsfa</p>

                            </div>
                            <div class="col-4">
                                <p>ffsfa</p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </aside>
    </div>

</div>
