<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */
if (class_exists('emusrenbang\assets\AppAsset')) {
    emusrenbang\assets\AppAsset::register($this);
} else {
    emusrenbang\assets\AppAsset::register($this);
}
dmstr\web\AdminLteAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
 
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
         <link href="http://eplanning.asahankab.go.id/eperencanaan/eperencanaan/web/img/logo1.png" rel="shortcut icon">
        <?php $this->head() ?>
    </head>
	
    <body class="hold-transition skin-purple-light layout-top-nav">
        <?php $this->beginBody() ?>
        <div class="wrapper">
		<?php if (isset($_GET['pesan']) && $_GET['pesan']=="uji") {?>
            <header class="main-header">
                <?php
                NavBar::begin([
                    'brandLabel' => 'RKPD Kabupaten Asahan',//Yii::$app->name,
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse',
                    ],
                ]);
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/site/home']],
                    //    ['label' => 'Panduan', 'url' => ['/site/index']],
                    //    ['label' => 'About Us', 'url' => ['/site/index']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                ];
                if (Yii::$app->user->isGuest) {
                    //   $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                } else {
                    $menuItems[] = [
                        'label' => 'Dashboard (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/dashboard/index'],
                        'linkOptions' => ['data-method' => 'post']
                    ];
                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                NavBar::end();
                ?>
            </header>
		<?php };?>
		<?php if (isset($_GET['pesan'])&& $_GET['pesan']=="coba") {?>
            <header class="main-header"> 
                <?php
                NavBar::begin([
                    'brandLabel' => 'KUA-PPAS Kabupaten Asahan',//Yii::$app->name,
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse',
                    ],
                ]);
                
                ?>
            </header>
		<?php };?>
            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">
                        <?php if (isset($this->blocks['content-header'])) { ?>
                            <h1><?= $this->blocks['content-header'] ?></h1>
                        <?php } else { ?>
                            <h1>
                                <?php
                                if ($this->title !== null) {
                                    echo \yii\helpers\Html::encode($this->title);
                                } else {
                                    echo \yii\helpers\Inflector::camel2words(
                                            \yii\helpers\Inflector::id2camel($this->context->module->id)
                                    );
                                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                                }
                                ?>
                            </h1>
                        <?php } ?>

                        <?=
                        Breadcrumbs::widget(
                                [
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]
                        )
                        ?>
                    </section>
                    <section class="content">
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </section>
                </div>
<?php if (isset($_GET['pesan'])&& $_GET['pesan']=="uji") {?>
                <div id="footer" class="footer-black">
                    <div class="container">
                        <h6>Version <?= Yii::$app->params['version'] ?> © 2017 BAPPEDA Kabupaten Asahan. </h6>
                        <div class="container" id="intro">
                            <h3>Rencana Kerja Pemerintah Daerah Kabupaten Asahan</h3>
                            <h6>
                            <p>
                                Badan Perencanaan Pembangunan Daerah<br>
                                Jl. Jend. Sudirman No. 5 Kisaran - 21216<br>
                                Tel: (0623) 41247, Fax: (0623) 42020 Email: bappedaasahankab@gmail.com
                            </p>
                            </h6>
                        </div>
                    </div>
                </div>
<?php };?>

<?php if (isset($_GET['pesan'])&& $_GET['pesan']=="coba") {?>
                <div id="footer" class="footer-black">
                    <div class="container">
                        <h6>Version <?= Yii::$app->params['version'] ?> © 2017 BAPPEDA Kabupaten Asahan. </h6>
                        <div class="container" id="intro">
                            <h3>Kebijakan Umum Anggaran-Prioritas Plafon Anggaran Sementara (KUA-PPAS) Kabupaten Asahan</h3>
                            <h6>
                            <p>
                                Badan Perencanaan Pembangunan Daerah<br>
                                Jl. Jend. Sudirman No. 5 Kisaran - 21216<br>
                                Tel: (0623) 41247, Fax: (0623) 42020 Email: bappedaasahankab@gmail.com
                            </p>
                            </h6>
                        </div>
                    </div>
                </div>
<?php };?>

            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>

<?php $this->endPage() ?>
