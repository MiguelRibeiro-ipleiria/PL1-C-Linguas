<?php

use yii\helpers\Html;

$this->title = 'Access Denied';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="error-page">
    <div class="error-content" style="margin-left: auto;">
        <h3><i class="fas fa-ban text-warning"></i> <?= Html::encode($this->title) ?></h3>

        <p>
            You don't have permission to access this page.<br>
            It seems you tried to reach an area that requires additional privileges.
        </p>

        <p>
            Please contact an administrator if you believe this is an error.
        </p>

        <p>
            Meanwhile, you may <?= Html::a('return to dashboard', Yii::$app->homeUrl, ['class' => 'text-primary']); ?>
            or try using the search form below.
        </p>

        <form class="search-form" style="margin-right: 190px;">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn btn-warning">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
