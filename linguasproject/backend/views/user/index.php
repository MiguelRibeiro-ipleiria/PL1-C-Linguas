<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">


    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'username',
            'email:email',
            'utilizador.data_inscricao',
            'utilizador.numero_telefone',
            'utilizador.nacionalidade',
            'utilizador.data_nascimento',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            [
                'label' => 'Role',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('Alterar Role', ['user/role', 'id' => $model->id], [
                        'class' => 'btn btn-success',
                        'title' => 'Alterar Role',
                    ]);
                }
            ],
        ],
    ]); ?>


</div>
