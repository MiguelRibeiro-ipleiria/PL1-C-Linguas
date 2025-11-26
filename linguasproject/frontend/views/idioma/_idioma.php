<?php

use common\models\Curso;
use yii\helpers\Url;

/** @var common\models\Idioma $model */

?>
<?php

    $curso = Curso::find()->where(['idioma_id'=>$model->id])->count();
    $cursodesativadas = Curso::find()->where(['idioma_id'=>$model->id, 'status_ativo' => 0])->count();

?>
<style>
    cursos-desativados {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
    }

    .cursos-desativados p {
        display: inline-flex;
        justify-content: center;
        font-weight: bold;
        padding: 2px 10px;
        text-transform: capitalize;
        font-size: 15px;
        margin: 0;
        color: #fff;
        border: 1px solid #eee;
        background-color: red;
        border-radius: 30px;
        text-decoration-line: none;
        white-space: nowrap;
    }
</style>
<div class="col-lg-4 col-md-6 col-4 wow fadeInUp" data-wow-delay=".6s">
    <div class="single-idioma">
        <a href="<?= Url::to(['/curso/idiomacursos', 'id' => $model->id]) ?>" class="single-service-link">
            <div class="caixa-cursos-idioma">
                <p>
                    <?php
                        if($curso == 1){
                            echo $curso . " curso";
                        }
                        else{
                            echo $curso . " cursos";
                        }
                    ?>
                </p>
            </div>
            <img src="<?= $model->lingua_bandeira ?>">
            <h4 class="text-title"><?= $model->lingua_descricao ?></h4>
            <p><?= $model->lingua_objetivo ?></p>
            <div class="cursos-desativados">
                    <?php
                    if($cursodesativadas == 1){ ?>
                    <p><?php
                        echo $cursodesativadas . " curso desativado temporariamente";
                    ?></p>
                    <?php
                    }
                    elseif ($cursodesativadas > 1) { ?>
                    <p><?php
                        echo $cursodesativadas . " cursos desativados temporariamente";
                    ?></p><?php }
                        elseif ($cursodesativadas == 1) {
                        }
                    ?>
            </div>
        </a>
    </div>
</div>