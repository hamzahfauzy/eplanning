<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E-Planning Pemerintah Kota Medan</title>
        <meta name="keywords" content="E-Planning Pemerintah Kota Medan" />
        <meta name="description" content="E-Planning Pemerintah Kota Medan">
        <meta name="author" content="Bappeda Pemerintah Kota Medan">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body id="page-top" class="index">
        <?php $this->beginBody() ?>
        <!-- Navigation -->
        <nav class="navbar navbar-default">
            <!-- Topbar Nav (hidden) -->
            <div class="topbar-nav clearfix">
                <div class="container">
                    <ul class="topbar-left list-unstyled list-inline">
                        <li> <span class="fa fa-phone"></span>  </li>
                        <li> <span class="fa fa-envelope"></span> bappeda@pemkomedan.go.id </li>
                    </ul>
                    <ul class="topbar-right list-unstyled list-inline topbar-social">
                        <li> <a href="#"> <span class="fa fa-facebook"></span> </a></li>
                        <li> <a href="#"> <span class="fa fa-twitter"></span> </a></li>
                        <li> <a href="#"> <span class="fa fa-google-plus"></span> </a></li>
                        <li> <a href="#"> <span class="fa fa-dribbble"></span> </a></li>
                        <li> <a href="#"> <span class="fa fa-instagram"></span> </a></li>
                    </ul>
                </div>
            </div> 
            <div class="container" style="max-width: 1050px;">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">
                        <?= yii\helpers\Html::img('@web/img/logo.png', ['alt' => 'Kota Medan']); ?></a>
                </div>
                <?php
                $menuItems = [
                    ['label' => 'Home', 'url' => '#page-top'],
                    ['label' => 'About', 'url' => '#services'],
                    ['label' => 'Galley', 'url' => '#portfolio'],
                ];
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                } else {
                    $menuItems[] = '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>';
                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                ?>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <!-- Hero Content -->
        <header id="hero">
            <div class="container">
                <div class="intro-text">
                    <div class="intro-lead-in hidden">Visi Kota Medan</div>
                    <div class="intro-heading">Medan Kota Masa Depan yang Multikultural, Berdaya Saing, Humanis, Sejahtera dan Religius</div>

                </div>
            </div>
        </header>
        <!-- Contact Section -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Masukkan user dan Password E-Planning</h2>
                    </div>
                </div>
                <form name="sentMessage" id="contactForm" class="mw800 center-block clearfix" novalidate>	    
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" id="name" required data-validation-required-message="Please enter your name.">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Password" id="email" required data-validation-required-message="Please enter your email address.">
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-xl btn-block btn-wire">Login</button>
                    </div>
                </form>	
                <p>  </p>

            </div>
        </section>
        <!-- Services Section -->
        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2 class="section-heading">RKPD
                            RENCANA KERJA PEMERINTAH DAERAH</h2>
                        <h3 class="section-subheading ">Dokumen Rencana Kerja Pemerintah Daerah yang telah mencerminkan hasil karya multipihak : eksekutif, DPRD, Masyarakat dan Pemerintah Kota Lubuklinggau serta mencerminkan keterkaitan dengan Program Pemerintah Pusat

                            Prioritas
                            Urusan
                            Sasaran
                            SKPD
                        </h3>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-xs-6 col-sm-4 mb50">
                        <span class="fa-stack fa-4x hidden">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <div class="service-icon"> <img src="img/icons/1-lg.png" title="service icon"> </div>
                        <h4 class="service-heading">Berbasis Elektronik</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 mb50">
                        <div class="service-icon"> <img src="img/icons/2-lg.png" title="service icon"> </div>
                        <span class="fa-stack fa-4x hidden">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Mudah, Cepat dan Tepat</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 mb50">
                        <div class="service-icon"> <img src="img/icons/3-lg.png" title="service icon"> </div>
                        <span class="fa-stack fa-4x hidden">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Analisis yang Informatif</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>

                    <div class="col-xs-6 col-sm-4 mb50">
                        <span class="fa-stack fa-4x hidden">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                        </span>
                        <div class="service-icon"> <img src="img/icons/4-lg.png" title="service icon"> </div>
                        <h4 class="service-heading">User Interface Yang Mudah dan Sederhana</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 mb50">
                        <div class="service-icon"> <img src="img/icons/5-lg.png" title="service icon"> </div>
                        <span class="fa-stack fa-4x hidden">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Sistem Yang Terintegrasi</h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 mb50">
                        <div class="service-icon"> <img src="img/icons/6-lg.png" title="service icon"> </div>
                        <span class="fa-stack fa-4x hidden">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading">Mendukung Eksekutif Summary </h4>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Flat Features Section -->
        <section id="features-flat" class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 text-center">
                        <h2 class="section-heading mt70">Benefit E-planning</h2>
                        <h3 class="section-subheading text-muted mb30"></h3>
                        <p class="text-muted mb50">Eplanning dapat menghitung perkiraan kemampuan keungan, perkiraan beban belanja tidak langsung, dan perkiraan belanja langsung untuk membiayai seluruh program dan kegiatan
                            Selanjutnya melalui eplanning kita dapat menentukan pagu indikatif untuk setiap SKPD
                            SKPD dapat melihat sisa alokasi dana yang dimiliki ketika meraka memasukan kegiatan2 ke dalam eplanning
                        </p>
                        <a href="#contact" class="page-scroll btn btn-xl btn-danger pv15">Login</a>

                    </div>
                    <div class="hidden-sm hidden-xs col-md-6">
                        <?= yii\helpers\Html::img('@web/img/features/flat_feature1.png', ['alt' => 'Benefit E-planning', 'class' => 'img-responsive pull-right']); ?>
                    </div>
                </div>

            </div>
        </section>

        <!-- Flat Features Section -->
        <section id="features-flat">
            <div class="container">

                <div class="row">
                    <div class="hidden-sm hidden-xs col-md-6">
                        <?= yii\helpers\Html::img('@web/img/features/flat_feature2.png', ['alt' => 'Solusi Berbasis Mobile', 'class' => 'img-responsive pull-left']); ?>
                    </div>
                    <div class="col-sm-12 col-md-6 text-center">
                        <h2 class="section-heading mt70">Solusi Berbasis Mobile</h2>
                        <h3 class="section-subheading text-muted mb30"></h3>
                        <p class="text-muted mb50">E-Planning akan dikembangkan dalam aplikasi yang berjalan di sistem operasi android. Untuk memudahkan akses dan monitoring e-planning </p>
                    </div>
                </div>

            </div>
        </section>
        <!-- Features Section -->

        <!-- Portfolio Grid Section -->
        <section id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading mt20">Gallery</h2>
                        <h3 class="section-subheading text-muted">Pembangunan Kota Medan</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <?= yii\helpers\Html::img('@web/img/gallery/1a.png', ['alt' => 'Gallery 1', 'class' => 'img-responsive']); ?>
                        </a>
                        <div class="portfolio-caption">
                            <h4>Taman Lion Club</h4>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <?= yii\helpers\Html::img('@web/img/gallery/2a.png', ['alt' => 'Gallery 2', 'class' => 'img-responsive']); ?>
                        </a>
                        <div class="portfolio-caption">
                            <h4>Lapangan Merdeka</h4>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <?= yii\helpers\Html::img('@web/img/gallery/3a.png', ['alt' => 'Gallery 3', 'class' => 'img-responsive']); ?>
                        </a>
                        <div class="portfolio-caption">
                            <h4>Forum Diskusi Pembangunan Kota</h4>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <?= yii\helpers\Html::img('@web/img/gallery/4a.png', ['alt' => 'Gallery 4', 'class' => 'img-responsive']); ?>
                        </a>
                        <div class="portfolio-caption">
                            <h4>Pasar Tuntungan</h4>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <?= yii\helpers\Html::img('@web/img/gallery/5a.png', ['alt' => 'Gallery 5', 'class' => 'img-responsive']); ?>
                        </a>
                        <div class="portfolio-caption">
                            <h4>Pelabuhan Belawan</h4>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 portfolio-item">
                        <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content">
                                    <i class="fa fa-plus fa-3x"></i>
                                </div>
                            </div>
                            <?= yii\helpers\Html::img('@web/img/gallery/6.png', ['alt' => 'Gallery 6', 'class' => 'img-responsive']); ?>
                        </a>
                        <div class="portfolio-caption">
                            <h4>Kantor Walikota Medan</h4>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Clients Section -->

        <!-- Footer -->
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <span class="copyright text-muted">Copyright &copy; <b>E-Planning Bappeda Kota Medan</b> <?= date('Y') ?></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <?= Yii::powered() ?>
                    </div>
                    <div class="col-md-4 hidden">
                        <ul class="list-inline quicklinks">
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Terms of Use</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- About Section (timeline/hidden) -->
        <section id="about" class="hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">About</h2>
                        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-image">
                                    <?= yii\helpers\Html::img('@web/img/about/1.jpg', ['alt' => 'Icon 1', 'class' => 'img-responsive img-circle']); ?>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>2009-2011</h4>
                                        <h4 class="subheading">Our Humble Beginnings</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <?= yii\helpers\Html::img('@web/img/about/2.jpg', ['alt' => 'Icon 2', 'class' => 'img-responsive img-circle']); ?>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>March 2011</h4>
                                        <h4 class="subheading">An Agency is Born</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-image">
                                    <?= yii\helpers\Html::img('@web/img/about/3.jpg', ['alt' => 'Icon 3', 'class' => 'img-responsive img-circle']); ?>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>December 2012</h4>
                                        <h4 class="subheading">Transition to Full Service</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <?= yii\helpers\Html::img('@web/img/about/4.jpg', ['alt' => 'Icon 4', 'class' => 'img-responsive img-circle']); ?>
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4>July 2014</h4>
                                        <h4 class="subheading">Phase Two Expansion</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-image">
                                    <h4>Be Part
                                        <br>Of Our
                                        <br>Story!</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section (hidden) -->
        <section id="team" class="bg-light hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">The Team You Need</h2>
                        <h3 class="section-subheading text-muted">Lorem amet ipsum dolor sit consectetur.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="team-member">
                            <img src="img/team/1.jpg" class="img-responsive" alt="">
                            <ul class="list-inline social-buttons">
                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                            <h4>Kay Garland</h4>
                            <p class="text-muted">Lead Designer</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="team-member">
                            <img src="img/team/2.jpg" class="img-responsive" alt="">
                            <h4>Larry Parker</h4>
                            <p class="text-muted">Lead Marketer</p>
                            <ul class="list-inline social-buttons">
                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="team-member">
                            <img src="img/team/3.jpg" class="img-responsive" alt="">
                            <h4>Diana Pertersen</h4>
                            <p class="text-muted">Lead Developer</p>
                            <ul class="list-inline social-buttons">
                                <li><a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
                    </div>
                </div>
            </div>
        </section>

        <!--Call to Action Section (hidden) -->
        <section id="call-to-action" class="hidden">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Portfolio</h2>
                        <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                    </div>
                </div>
            </div>
        </section>


        <!-- Portfolio Modals -->
        <!-- Use the modals below to showcase details about your portfolio projects! -->

        <!-- Portfolio Modal 1 -->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Taman Lion Club</h2>
                                <p class="item-intro text-muted"></p>
                                <?= yii\helpers\Html::img('@web/img/gallery/1.png', ['alt' => 'Gallery 1', 'class' => 'img-responsive img-centered']); ?>
                                <p>Taman Lion Club yang berada di Lapangan Benteng Kota Medan</p>
                                <p>
                                </p>

                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 2 -->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <h2>Lapangan Merdeka</h2>
                                <p class="item-intro text-muted"></p>
                                <?= yii\helpers\Html::img('@web/img/gallery/2.png', ['alt' => 'Gallery 2', 'class' => 'img-responsive img-centered']); ?>
                                <p>Lapangan Merdeka</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 3 -->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>forum diskusi pembangunan kota</h2>
                                <?= yii\helpers\Html::img('@web/img/gallery/3.png', ['alt' => 'Gallery 3', 'class' => 'img-responsive img-centered']); ?>
                                <p>forum diskusi pembangunan kota</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 4 -->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Pasar Tuntungan</h2>
                                <?= yii\helpers\Html::img('@web/img/gallery/4.png', ['alt' => 'Gallery 4', 'class' => 'img-responsive img-centered']); ?>
                                <p>Pasar Tuntungan </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 5 -->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Pelabuhan Belawan</h2>
                                <p class="item-intro text-muted"></p>
                                <?= yii\helpers\Html::img('@web/img/gallery/5.png', ['alt' => 'Gallery 5', 'class' => 'img-responsive img-centered']); ?>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 6 -->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Kantor Walikota Medan</h2>
                                <?= yii\helpers\Html::img('@web/img/gallery/6.png', ['alt' => 'Gallery 6', 'class' => 'img-responsive img-centered']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>