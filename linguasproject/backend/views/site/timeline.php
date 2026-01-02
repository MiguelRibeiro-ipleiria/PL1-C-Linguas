<?php

use common\models\Feedback;
use common\models\Utilizador;
use common\models\Curso;
use common\models\Idioma;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="timeline">

                    <div class="time-label">
                <span class="bg-red">
                    <?php
                    $agora = new DateTime();
                    echo $agora->format('d/m/Y - H:i:s');
                    ?>
                </span>
                    </div>
                    <?php
                    $feedbackstimes = Feedback::find()->orderBy(['hora_criada' => SORT_ASC])->all();
                    $utilizadorestimes = Utilizador::find()->orderBy(['data_inscricao' => SORT_ASC])->all();
                    $idiomatimes = Idioma::find()->orderBy(['data_criacao' => SORT_ASC])->all();
                    $cursotimes = Curso::find()->orderBy(['data_criacao' => SORT_ASC])->all();

                    $ArrayTime = array();

                    foreach ($feedbackstimes as $feedback) {
                        $ArrayType["type"] = "feedback";
                        $ArrayType["hora"] = $feedback->hora_criada;
                        $ArrayType["id"] = $feedback->id;
                        array_push($ArrayTime, ArrayHelper::toArray($ArrayType));
                    }

                    foreach ($utilizadorestimes as $utilizador) {
                        $ArrayType["type"] = "utilizador";
                        $ArrayType["hora"] = $utilizador->data_inscricao;
                        $ArrayType["id"] = $utilizador->id;
                        array_push($ArrayTime, ArrayHelper::toArray($ArrayType));
                    }

                    foreach ($idiomatimes as $idioma) {
                        $ArrayType["type"] = "idioma";
                        $ArrayType["hora"] = $idioma->data_criacao;
                        $ArrayType["id"] = $idioma->id;
                        array_push($ArrayTime, ArrayHelper::toArray($ArrayType));
                    }

                    foreach ($cursotimes as $curso) {
                        $ArrayType["type"] = "curso";
                        $ArrayType["hora"] = $curso->data_criacao;
                        $ArrayType["id"] = $curso->id;
                        array_push($ArrayTime, ArrayHelper::toArray($ArrayType));
                    }

                    usort($ArrayTime, function($a, $b) {
                        return strtotime($b['hora']) <=> strtotime($a['hora']);
                    });

                    foreach ($ArrayTime as $time) {
                        if ($time['type'] == 'feedback') {
                            $feedback = Feedback::findOne($time['id']);
                        ?>
                            <div>
                                <i class="fas fa-thumbs-up bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= $feedback->hora_criada ?></span>

                                    <h3 class="timeline-header">
                                        <a href="<?= Url::to(['/feedback/view', 'id' => $feedback->id]) ?>">Novo Feedback - </a><?= $feedback->assunto_feedback ?>
                                    </h3>

                                    <div class="timeline-body">
                                        <?= $feedback->descricao_feedback ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        elseif ($time['type'] == 'utilizador') {
                            $utilizador = Utilizador::findOne($time['id']);
                            ?>
                            <div>
                                <i class="fas fa-user bg-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= $utilizador->data_inscricao ?> </span>
                                    <h3 class="timeline-header no-border"><a href="<?= Url::to(['/user/view', 'id' => $utilizador->user->id]) ?>"><?= $utilizador->user->username ?> - </a> Criou uma nova conta</h3>
                                    <?php
                                        if($utilizador->idioma_id != null){ ?>
                                            <div class="timeline-body bg-warning">
                                                <a href="<?= Url::to(['/user/formador']) ?>">Quer ser Formador (<?= $utilizador->idioma->lingua_descricao ?>)</a>
                                            </div>
                                        <?php }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        elseif ($time['type'] == 'idioma') {
                            $idioma = Idioma::findOne($time['id']);
                            ?>
                            <div>
                                <i class="fas fa-language bg-yellow"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?= $idioma->data_criacao ?> </span>
                                    <h3 class="timeline-header no-border"><a href="<?= Url::to(['/idioma/view', 'id' => $idioma->id]) ?>"><?= $idioma->lingua_descricao ?> - </a><?= $idioma->lingua_sigla?></h3>
                                </div>
                            </div>
                            <?php
                        }

                        elseif ($time['type'] == 'curso') {
                            $curso = Curso::findOne($time['id']);
                            ?>
                                <div>
                                    <i class="fas fa-book bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> <?= $curso->data_criacao ?> </span>
                                        <h3 class="timeline-header no-border"><a href="<?= Url::to(['/curso/view', 'id' => $curso->id]) ?>"><?= $curso->titulo_curso ?> - </a><?= $curso->idioma->lingua_descricao?></h3>
                                    </div>
                                </div>
                        <?php
                        }

                    }
                    ?>
                <div>
                    <i class="fas fa-clock bg-gray"></i>
                </div>

            </div>

        </div>
    </div>
    </div>
</section>