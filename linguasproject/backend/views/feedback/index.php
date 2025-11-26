<?php

use common\models\Feedback;
use common\models\User;
use common\models\Utilizador;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\FeedbackSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <?= Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table m-0',
                ],
                'layout' => "{items}\n<div class='card-footer clearfix'>{pager}</div>",
                'columns' => [
                    'id',
                    'assunto_feedback',
                    'descricao_feedback',
                    'hora_criada',
                    [
                        'label' => 'Utilizador',
                        'format' => 'raw',
                        'value' => function($model) {
                            $utilizador = Utilizador::findOne(['id' => $model->utilizador_id]);
                            $user = User::findOne(['id' => $utilizador->user_id]);
                            return $user->username;
                        }
                    ],
                    //'utilizador_id',
                    [
                        'class' => ActionColumn::className(),
                        'header' => 'Ações',
                        'urlCreator' => function ($action, Feedback $model) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>
