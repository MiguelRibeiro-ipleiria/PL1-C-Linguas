<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\aula $model */

/** @var common\models\Exercicio_frase $model_frase */
/** @var common\models\Exercicio_imagem $model_imagem */



$this->title = 'Create Aula';
$this->params['breadcrumbs'][] = ['label' => 'Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <!-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">Exercícios</h3>
            <div class="card-tools">
                <h3 class="card-title">[1 exercicios]</h3>
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

        </div>
        <div class="card-footer">
            Escolha o Tipo de Exercício a Adicionar
        </div>
    </div>

     <div class="content">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Title</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                Start creating your amazing application!
                            </div>
                            <div class="card-footer">
                                Footer
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>  -->
</div>
