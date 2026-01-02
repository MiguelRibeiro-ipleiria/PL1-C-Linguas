<?php
use common\models\Feedback;
use common\models\User;
use common\models\Curso;
use common\models\Idioma;
use common\models\Dificuldade;
use common\models\ImagemResource;
use yii\helpers\Url;
use hail812\adminlte\widgets\InfoBox;
use hail812\adminlte\widgets\SmallBox;

$this->title = 'Painel de Gestão LinguasProject';
$this->params['breadcrumbs'] = [['label' => $this->title]];

// Busca de dados dinâmicos
$totalUsers = User::find()->count();
$totalCursos = Curso::find()->count();
$totalIdiomas = Idioma::find()->count();
$totalFeedbacks = Feedback::find()->count();
$totalImagens = ImagemResource::find()->count();
$totalExercicios = 345;
?>

<div class="container-fluid">

    <h5 class="mb-2">Acesso Rápido</h5>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-body p-2">
                    <div class="d-flex flex-wrap justify-content-around">
                        <a class="btn btn-app bg-secondary" href="<?= Url::to(['/user/index']) ?>">
                            <i class="fas fa-users"></i> Utilizadores
                        </a>
                        <a class="btn btn-app bg-warning" href="<?= Url::to(['/dificuldade/index']) ?>">
                            <i class="fas fa-exclamation-triangle"></i> Dificuldade
                        </a>
                        <a class="btn btn-app bg-success" href="<?= Url::to(['/idioma/index']) ?>">
                            <i class="fas fa-language"></i> Idiomas
                        </a>
                        <a class="btn btn-app bg-danger" href="<?= Url::to(['/curso/index']) ?>">
                            <i class="fas fa-book"></i> Cursos
                        </a>
                        <a class="btn btn-app bg-info" href="<?= Url::to(['/imagem/index']) ?>">
                            <i class="fas fa-file-image"></i> Imagens
                        </a>
                        <a class="btn btn-app bg-primary" href="<?= Url::to(['/feedback/index']) ?>">
                            <i class="fas fa-thumbs-up"></i> Feedbacks
                        </a>
                        <a class="btn btn-app bg-dark"   href="<?= Url::to(['/audio/index']) ?>">
                            <i class="fas fa-file-audio"></i> Áudios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <?= SmallBox::widget([
                'title' => $totalUsers,
                'text' => 'Utilizadores',
                'icon' => 'fas fa-user-friends',
                'theme' => 'info',
            ]) ?>
        </div>
        <div class="col-lg-3 col-6">
            <?= SmallBox::widget([
                'title' => $totalIdiomas,
                'text' => 'Idiomas',
                'icon' => 'fas fa-globe',
                'theme' => 'success',
            ]) ?>
        </div>
        <div class="col-lg-3 col-6">
            <?= SmallBox::widget([
                'title' => $totalCursos,
                'text' => 'Cursos',
                'icon' => 'fas fa-graduation-cap',
                'theme' => 'warning',
            ]) ?>
        </div>
        <div class="col-lg-3 col-6">
            <?= SmallBox::widget([
                'title' => $totalFeedbacks,
                'text' => 'Feedbacks',
                'icon' => 'fas fa-comments',
                'theme' => 'danger',
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= InfoBox::widget([
                'text' => 'Recursos de Imagem',
                'number' => $totalImagens,
                'icon' => 'far fa-image',
                'theme' => 'info',
                'progress' => [
                    'width' => '45%',
                    'description' => '45% do limite de storage'
                ]
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= InfoBox::widget([
                'text' => 'Áudios Submetidos',
                'number' => '531',
                'icon' => 'fas fa-microphone',
                'theme' => 'success',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% revisados'
                ]
            ]) ?>
        </div>
        <div class="col-md-4">
    <?= InfoBox::widget([
        'text' => 'Exercícios Existentes',
        'number' => $totalExercicios , // Usa a variável ou exibe 0 se não estiver definida
        'icon' => 'fas fa-tasks',            // Ícone de lista de tarefas/exercícios
        'theme' => 'warning',                // Mantém a cor amarela original
        'progress' => [
            'width' => '100%',               // Barra completa para indicar o total atual
            'description' => 'Total de exercícios no sistema'
        ]
    ]) ?>
</div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card card-outline card-dark">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list mr-1"></i> Lista de Feedbacks Recentes</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="todo-list" data-widget="todo-list">
                        <?php
                        $feedbacks = Feedback::find()->orderBy(['hora_criada' => SORT_DESC])->limit(6)->all();
                        foreach ($feedbacks as $feedback): 
                            $dataCriada = new DateTime($feedback->hora_criada);
                            $intervalo = (new DateTime())->diff($dataCriada);
                            $tempo = $intervalo->d > 0 ? $intervalo->d . "d" : ($intervalo->h > 0 ? $intervalo->h . "h" : $intervalo->i . "m");
                        ?>
                        <li>
                            <span class="handle"><i class="fas fa-ellipsis-v"></i></span>
                            <span class="text"><?= htmlspecialchars($feedback->assunto_feedback) ?></span>
                            <small class="badge badge-secondary"><i class="far fa-clock"></i> <?= $tempo ?></small>
                            <div class="tools">
                                <a href="<?= Url::to(['/feedback/view', 'id' => $feedback->id]) ?>"><i class="fas fa-eye"></i></a>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="card-footer clearfix">
                    <a href="<?= Url::to(['/feedback/index']) ?>" class="btn btn-sm btn-secondary float-right">Ver Todos</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Atividade de Cursos</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Estado</th>
                                    <th>Popularidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>CURSO-9842</td>
                                    <td><span class="badge badge-success">Ativo</span></td>
                                    <td><div class="sparkbar" data-color="#00a65a">Alto</div></td>
                                </tr>
                                <tr>
                                    <td>CURSO-1848</td>
                                    <td><span class="badge badge-warning">Pendente</span></td>
                                    <td><div class="sparkbar" data-color="#f39c12">Médio</div></td>
                                </tr>
                                <tr>
                                    <td>CURSO-7429</td>
                                    <td><span class="badge badge-danger">Arquivado</span></td>
                                    <td><div class="sparkbar" data-color="#f56954">Baixo</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>