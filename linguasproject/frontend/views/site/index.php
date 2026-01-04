<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $DataComentariosProvider */

use common\models\comentarioSearch;
use common\models\Inscricao;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use common\models\Comentario;
use common\models\Utilizador;
use yii\helpers\ArrayHelper;
use yii\db\Expression;


$this->title = 'LEARNALOT';
?>

<!-- Start Hero Area -->
<section class="hero-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-12 col-12">
                <div class="hero-content">
                    <h4>LEARNALOT descobre as línguas connosco</h4>
                    <h1>A melhor app para aprender<br>
                        a sua Língua Preferida</h1>
                    <p>Avalia, Escolhe e DIVERTE-TE a estudar e a aprender as diversas línguas disponíveis.
                    </p>
                    <div class="button">
                        <a href="<?= \Yii::$app->user->isGuest ? Url::to(['/site/signup']) : Url::to(['/site/index']) ?>" class="btn">
                            <?= \Yii::$app->user->isGuest ? 'Inscreve-te' : 'O meu perfil' ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                    <img class="main-image" src="<?= \Yii::getAlias('@web').'/img/nav-image-turtle.jpg'; ?>" alt="Turtle Image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hero Area -->


<!-- Start Services Area -->
<div class="services section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">O que Nós Oferecemos</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Os Nossos Serviços</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">Nesta secção, pode encontrar todos os serviços disponíveis neste website,
                        desde Línguas dísponiveis a exercícios divertidos e intuitivos e aulas.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".2s">
                <a href="<?= Url::to(['/curso/index']) ?>" class="single-service-link">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <h4 class="text-title">Cursos</h4>
                        <p>Descubra todos cursos que temos a oferecer e comece a frequentar um deles
                            para se divertir enquanto a aprende</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                <a href="<?= Url::to(['/idioma/index']) ?>" class="single-service-link">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="bi bi-translate"></i>
                        </div>
                        <h4 class="text-title">Línguas</h4>
                        <p>Descubra todas a línguas disponíveis e comece a frequentar um curso
                            para se divertir enquanto a aprende</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".6s">
                <a href="<?= Url::to(['/feedback/create']) ?>" class="single-service-link">
                    <div class="single-service">
                        <div class="main-icon">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                        </div>
                        <h4 class="text-title">Feedback</h4>
                        <p>Dê-nos a sua opinião sobre nós e use este aba para reportar qualquer eventual
                            problema que encontre para que o possamos ajudar</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Services Area -->
<!-- Start Team Area -->
<section class="team section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">A Nossa Equipa</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Conheça a Nossa Equipa</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">Este são o membros por de trás de todo este sistema de ensino de Línguas.
                        Qualquer dúvida contacte a página do "feedback", que um nós terá o gosto de auxiliá-lo.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".3s">
                <!-- Start Single Team -->
                <div class="single-team">
                    <div class="team-image">
                        <img src="<?= \Yii::getAlias('@web').'/img/profile_icon.webp'; ?>" alt="André Ventura Profile Image">
                    </div>
                    <div class="content">
                        <h4>André Santos
                            <span>Administrador</span>
                        </h4>
                    </div>
                </div>
                <!-- End Single Team -->
            </div>
            <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".5s">
                <!-- Start Single Team -->
                <div class="single-team">
                    <div class="team-image">
                        <img src="<?= \Yii::getAlias('@web').'/img/profile_icon.webp'; ?>" alt="Guilherme Ferreira Profile Image">
                    </div>
                    <div class="content">
                        <h4>Guilherme Ferreira
                            <span>Administrador</span>
                        </h4>
                    </div>
                </div>
                <!-- End Single Team -->
            </div>
            <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay=".7s">
                <!-- Start Single Team -->
                <div class="single-team">
                    <div class="team-image">
                        <img src="<?= \Yii::getAlias('@web').'/img/profile_icon.webp'; ?>" alt="Miguel Ribeiro Profile Image">
                    </div>
                    <div class="content">
                        <h4>Miguel Ribeiro
                            <span>Administrador</span>
                        </h4>
                    </div>
                </div>
                <!-- End Single Team -->
            </div>
                <!-- End Single Team -->
            </div>
        </div>
    </div>
</section>
<!--/ End Team Area -->

<!-- Start Testimonials Area -->
<section class="testimonials style2 section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3 class="wow zoomIn" data-wow-delay=".2s">Algumas opiniões do nosso público</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Os meus comentários</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">Aqui, consegue ver algumas opiniões de pessoas que já participaram nas nossas aulas e decidiram deixar
                        uma pequena avaliação para contextualizar novos alunos.</p>
                </div>
            </div>
        </div>
        <div class="row testimonial-slider">

            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $DataComentariosProvider,
                'itemView' => '_comentarios_home',
                'layout' => "{items}",
                'itemOptions' => ['tag' => false],
                'options' => ['class' => 'row'],
                'emptyText' => 'Ainda não temos comentários. Seja o primeiro!',
            ]); ?>

        </div>
    </div>
</section>
<!-- End Testimonial Area -->


<!-- Start Footer Area -->
<!-- <footer class="footer section">
    <div class="footer-top">
        <div class="container">
            <div class="inner-content">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-footer f-about">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="assets/images/logo/white-logo.svg" alt="#">
                                </a>
                            </div>
                            <p>Making the world a better place through constructing elegant hierarchies.</p>
                            <h4 class="social-title">Follow Us On:</h4>
                            <ul class="social">
                                <li><a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-pinterest"></i></a></li>
                                <li><a href="javascript:void(0)"><i class="lni lni-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h3>Solutions</h3>
                            <ul>
                                <li><a href="javascript:void(0)">Marketing</a></li>
                                <li><a href="javascript:void(0)">Analytics</a></li>
                                <li><a href="javascript:void(0)">Commerce</a></li>
                                <li><a href="javascript:void(0)">Insights</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <div class="single-footer f-link">
                            <h3>Support</h3>
                            <ul>
                                <li><a href="javascript:void(0)">Pricing</a></li>
                                <li><a href="javascript:void(0)">Documentation</a></li>
                                <li><a href="javascript:void(0)">Guides</a></li>
                                <li><a href="javascript:void(0)">API Status</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="single-footer newsletter">
                            <h3>Subscribe</h3>
                            <p>Subscribe to our newsletter for the latest updates</p>
                            <form action="#" method="get" target="_blank" class="newsletter-form">
                                <input name="EMAIL" placeholder="Email address" required="required" type="email">
                                <div class="button">
                                    <button class="sub-btn"><i class="lni lni-envelope"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!--/ End Footer Top -->
    <!-- Start Copyright Area -->
    <!-- <div class="copyright-area">
        <div class="container">
            <div class="inner-content">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <p class="copyright-text">© 2023 Spark - All Rights Reserved</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <p class="copyright-owner">Designed and Developed by <a href="https://uideck.com/"
                                                                                rel="nofollow" target="_blank">UIdeck</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
/ End Footer Area -->

<!-- ========================= scroll-top ========================= -->
<a href="#" class="scroll-top">
    <i class="bi bi-caret-up-fill"></i>
</a>

<!-- ========================= JS here ========================= -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/tiny-slider.js"></script>
<script src="assets/js/glightbox.min.js"></script>
<script src="assets/js/count-up.min.js"></script>
<script src="assets/js/main.js"></script>
<script>

    //========= testimonial
    tns({
        container: '.testimonial-slider',
        items: 3,
        slideBy: 'page',
        autoplay: false,
        mouseDrag: true,
        gutter: 0,
        nav: true,
        controls: false,
        responsive: {
            0: {
                items: 1,
            },
            540: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1170: {
                items: 3,
            }
        }
    });

    //====== counter up
    var cu = new counterUp({
        start: 0,
        duration: 2000,
        intvalues: true,
        interval: 100,
        append: " ",
    });
    cu.start();

    //========= glightbox
    GLightbox({
        'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
        'type': 'video',
        'source': 'youtube', //vimeo, youtube or local
        'width': 900,
        'autoplayVideos': true,
    });

</script>
</body>

</html>