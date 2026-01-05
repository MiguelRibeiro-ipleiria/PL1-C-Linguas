<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hosanna\audiojs\AudioJs;

/** @var yii\web\View $this */
/** @var common\models\AudioResource $model */

$this->title = $model->nome_audio;
$this->params['breadcrumbs'][] = ['label' => 'Audio Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// Estilização customizada para o AudioJS ficar "giro"
$this->registerCss("
    .audiojs { 
        width: 100% !important; 
        background: #343a40 !important; /* Cor dark do AdminLTE */
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border-radius: 50px; /* Deixa arredondado */
    }
    .audiojs .scrubber { background: #555 !important; height: 10px !important; margin-top: 14px !important; }
    .audiojs .progress { background: #28a745 !important; } /* Barra de progresso verde */
    .audiojs .play-pause { background: #28a745 !important; border-radius: 50% 0 0 50% !important; }
    .audio-card { border-top: 3px solid #28a745; }
");
?>

<div class="audio-resource-view container-fluid">

    <div class="row">
        <div class="col-md-8">
            <div class="card audio-card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-music mr-1"></i> Detalhes do Recurso
                    </h3>
                    <div class="card-tools">
                        <?= Html::a('<i class="fas fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
                        <?= Html::a('<i class="fas fa-trash"></i> Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-sm btn-danger',
                            'data' => [
                                'confirm' => 'Tem a certeza que deseja eliminar este áudio?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                </div>
                
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => ['class' => 'table table-hover table-striped'],
                        'attributes' => [
                            [
                                'attribute' => 'id',
                                'label' => 'ID do Registo',
                            ],
                            'nome_audio',
                            [
                                'attribute' => 'nome_ficheiro',
                                'value' => function($model) {
                                    return Html::tag('code', $model->nome_ficheiro);
                                },
                                'format' => 'raw',
                            ],
                        ],
                    ]) ?>
                </div>
                
                <div class="card-footer bg-light px-4 py-4">
                    <label class="text-muted mb-2"><i class="fas fa-play-circle"></i> Player de Pré-visualização:</label>
                    <div class="player-wrapper">
                        <?= AudioJs::widget([
                            'files' => 'UploadAudio/' . $model->nome_ficheiro, 
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>

        

    </div>
</div>