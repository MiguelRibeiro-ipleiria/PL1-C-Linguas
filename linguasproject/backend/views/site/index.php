<?php
use common\models\Feedback;
use common\models\User;
use common\models\Curso;
use common\models\Idioma;
use common\models\Dificuldade;
use common\models\ImagemResource;
use yii\helpers\Url;

$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="col-md-12">
    <!-- Application buttons -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Butões de Acesso Rápido a Funcionalidades</h3>
        </div>
        <div class="card-body">
            <!--<p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a></code> tag to achieve the following:</p>
            <a class="btn btn-app">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a class="btn btn-app">
                <i class="fas fa-play"></i> Play
            </a>
            <a class="btn btn-app">
                <i class="fas fa-pause"></i> Pause
            </a>
            <a class="btn btn-app">
                <i class="fas fa-save"></i> Save
            </a>
            <a class="btn btn-app">
                <span class="badge bg-warning">3</span>
                <i class="fas fa-bullhorn"></i> Notifications
            </a>
            <a class="btn btn-app">
                <span class="badge bg-success">300</span>
                <i class="fas fa-barcode"></i> Products
            </a>
            <a class="btn btn-app">
                <span class="badge bg-purple">891</span>
                <i class="fas fa-users"></i> Users
            </a>
            <a class="btn btn-app">
                <span class="badge bg-teal">67</span>
                <i class="fas fa-inbox"></i> Orders
            </a>
            <a class="btn btn-app">
                <span class="badge bg-info">12</span>
                <i class="fas fa-envelope"></i> Inbox
            </a>
            <a class="btn btn-app">
                <span class="badge bg-danger">531</span>
                <i class="fas fa-heart"></i> Likes
            </a>
            -->
            <a class="btn btn-app bg-secondary" href="<?= Url::to(['/user/index']) ?>">
                <span class="badge bg-secondary"><?php echo User::find()->count() ?></span>
                <i class="fas fa-users"></i> Utilizadores
            </a>
            <a class="btn btn-app bg-warning" href="<?= Url::to(['/dificuldade/index']) ?>">
                <span class="badge bg-warning"><?php echo Dificuldade::find()->count() ?></span>
                <i class="fas fa-exclamation-triangle"></i> Dificuldade
            </a>
            <a class="btn btn-app bg-success" href="<?= Url::to(['/idioma/index']) ?>">
                <span class="badge bg-success"><?php echo Idioma::find()->count() ?></span>
                <i class="fas fa-language"></i> Idiomas
            </a>
            <a class="btn btn-app bg-danger">
                <span class="badge bg-danger"><?php echo Curso::find()->count() ?></span>
                <i class="fas fa-book"></i> Cursos
            </a>
            <a class="btn btn-app bg-warning">
                <span class="badge bg-warning">12</span>
                <i class="fas fa-chalkboard-teacher"></i> Aulas
            </a>
            <a class="btn btn-app bg-success">
                <span class="badge bg-success">12</span>
                <i class="fas fa-pencil-alt"></i> Tipos Exercícios
            </a>
            <a class="btn btn-app bg-danger" href="<?= Url::to(['/image/index']) ?>">
                <span class="badge bg-danger"><?php echo ImagemResource::find()->count() ?></span>
                <i class="fas fa-file-image"></i> Imagens
            </a>
            <a class="btn btn-app bg-secondary">
                <span class="badge bg-secondary">531</span>
                <i class="fas fa-file-audio"></i> Áudios
            </a>
            <a class="btn btn-app bg-warning">
                <span class="badge bg-warning">531</span>
                <i class="fas fa-comments"></i> Comentários
            </a>
            <a class="btn btn-app bg-success" href="<?= Url::to(['/feedback/index']) ?>">
                <span class="badge bg-success"><?php echo Feedback::find()->count() ?></span>
                <i class="fas fa-thumbs-up"></i> Feedbacks
            </a>
            <a class="btn btn-app bg-danger">
                <span class="badge bg-danger">531</span>
                <i class="fas fa-file-alt"></i> Inscrições
            </a>
            <a class="btn btn-app bg-secondary">
                <span class="badge bg-secondary">531</span>
                <i class="fas fa-chart-line"></i> Progressos
            </a>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->



<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Utilizadores',
                'number' => User::find()->count(),
                'icon' => 'far fa-user',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Idiomas',
                'number' => Idioma::find()->count(),
                'icon' => 'fas fa-language',
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Feedbacks',
                'number' => Feedback::find()->count(),
                'icon' => 'far fa-thumbs-up',
            ]) ?>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Bookmarks',
                'number' => '41,410',
                'icon' => 'far fa-bookmark',
                'progress' => [
                    'width' => '70%',
                        'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?php $infoBox = \hail812\adminlte\widgets\InfoBox::begin([
                'text' => 'Likes',
                'number' => '41,410',
                'theme' => 'success',
                'icon' => 'far fa-thumbs-up',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ]
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $infoBox->id.'-ribbon',
                'text' => 'Ribbon',
            ]) ?>
            <?php \hail812\adminlte\widgets\InfoBox::end() ?>
        </div>
        <div class="col-md-4 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\InfoBox::widget([
                'text' => 'Events',
                'number' => '41,410',
                'theme' => 'gradient-warning',
                'icon' => 'far fa-calendar-alt',
                'progress' => [
                    'width' => '70%',
                    'description' => '70% Increase in 30 Days'
                ],
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Cursos',
                'icon' => 'fas fa-book',
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?php $smallBox = \hail812\adminlte\widgets\SmallBox::begin([
                'title' => '150',
                'text' => 'Aulas',
                'icon' => 'fas fa-chalkboard-teacher',
                'theme' => 'success'
            ]) ?>
            <?= \hail812\adminlte\widgets\Ribbon::widget([
                'id' => $smallBox->id.'-ribbon',
                'text' => 'Ribbon',
                'theme' => 'warning',
                'size' => 'lg',
                'textSize' => 'lg'
            ]) ?>
            <?php \hail812\adminlte\widgets\SmallBox::end() ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '44',
                'text' => 'User Registrations',
                'icon' => 'fas fa-user-plus',
                'theme' => 'gradient-success',
                'loadingStyle' => true
            ]) ?>
        </div>
    </div>

    <div class="row">

        <!-- CARD DE ORDERS -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Latest Orders</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Popularity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Call of Duty IV</td>
                                <td><span class="badge badge-success">Shipped</span></td>
                                <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>iPhone 6 Plus</td>
                                <td><span class="badge badge-danger">Delivered</span></td>
                                <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-info">Processing</span></td>
                                <td><div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div></td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td><div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div></td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>iPhone 6 Plus</td>
                                <td><span class="badge badge-danger">Delivered</span></td>
                                <td><div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div></td>
                            </tr>
                            <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Call of Duty IV</td>
                                <td><span class="badge badge-success">Shipped</span></td>
                                <td><div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                </div>
            </div>
        </div>

        <!-- TO DO List -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        Feedback List
                    </h3>

                </div>

                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">

                        <?php
                        $feedbacks = Feedback::find()->orderBy(['hora_criada' => SORT_DESC])->all();
                        foreach ($feedbacks as $feedback) {

                            $dataCriada = new DateTime($feedback->hora_criada);
                            $agora = new DateTime();
                            $intervalo = $agora->diff($dataCriada);

                            // Exemplo: "2 dias", "3 horas", etc
                            if ($intervalo->d > 0) {
                                $resultado = $intervalo->d . " dias";
                            } elseif ($intervalo->h > 0) {
                                $resultado = $intervalo->h . " horas";
                            } else {
                                $resultado = $intervalo->i . " min";
                            }
                            ?>

                            <li>
                                <!-- checkbox -->
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" id="todoCheck<?= $feedback->id ?>">
                                    <label for="todoCheck<?= $feedback->id ?>"></label>
                                </div>

                                <!-- texto -->
                                <span class="text"><?= htmlspecialchars($feedback->assunto_feedback) ?></span>

                                <!-- badge com horário -->
                                <small class="badge badge-danger">
                                    <i class="far fa-clock"></i> <?= $resultado ?>
                                </small>

                                <div class="tools">
                                    <a href="<?= Url::to(['/feedback/view', 'id' => $feedback->id]) ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </li>

                        <?php } ?>

                    </ul>
                </div>

                <div class="card-footer clearfix">
                    <button type="button" class="btn btn-primary float-right">
                        <i class="fas fa-list"></i> Ver Detalhes dos Feedbacks
                    </button>
                </div>
            </div>
        </div>

    </div>
