<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use eperencanaan\assets\AppAsset;
use dmstr\widgets\Alert;
use yii\web\Request;

//use common\components\LevelComponent;

AppAsset::register($this);

//user information
$PC_InfoUser = Yii::$app->levelcomponent->getProfile();
$PC_Kelompok = Yii::$app->levelcomponent->getKelompok();
$PC_ip = Request::getUserIP();

$PC_NamaLingkungan = Yii::$app->levelcomponent->getNamaLingkungan();

if ($PC_InfoUser['Foto'] == '') {
    $foto = 'avatar.jpg';
} else {
    $foto = $PC_InfoUser['Foto'];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="container-fluid">
            <div class="row" id="header">
                <div class="col-md-3 text-left" id="header1">
                    <img src="img/logo.png" id="logo"> e-Planning Kabupaten Asahan
                </div>
                <div class="col-md-9" id="header2">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Laporan E-Planning</h3>
                        </div>
                        <div class="col-md-4">
                            <div class="pull-right" id="user-wrap">
                                <a href="#" data-toggle="modal" data-target="#foto"><img id="user-image"  class="img-circle" src='<?= "http://manajemen.pemkomedan.go.id//uploads/" . $foto ?>'></a>
                            </div>
                            <div class="pull-right user-info">
                                <span class="user-name"><?= yii::$app->user->identity->username ?></span>
                                <span class="user-place"><?= $PC_InfoUser['Nm_Lengkap'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="col-md-12 navbar navbar-default navigator">
                    <?=
                    Nav::widget(
                            [
                                'options' => ['class' => 'nav navbar-nav'],
                                'encodeLabels' => false,
                                'items' => [
                                    ['label' => 'Beranda', 'url' => ['/laporan-bappeda/index']],
                                    ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                                ],
                            ]
                    )
                    ?>
                    <ul class="nav navbar-nav navbar-right"></ul>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 page-title">
                    <?php
                    $PC_action = Yii::$app->controller->action->id;
                    $PC_controller = Yii::$app->controller->id;
                    if ($this->title !== null && $PC_action != 'index') {
                        echo "<h3>" . \yii\helpers\Html::encode($this->title) . "</h3>";
                    } else {
                        echo "<h4>Rembuk Warga " . $PC_NamaLingkungan . "</h4>";
                    }
                    ?>
                    <?=
                    Breadcrumbs::widget(
                            [
                                'homeLink' => ['label' => 'Beranda',
                                    'url' => 'index.php?r=lingkungan/index'],
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]
                    )
                    ?>
                </div>
            </div>
            <div class="row content">
                <?= Alert::widget() ?> 
                <?= $content ?>
            </div>
            <div class="row">
                <div class="col-md-12 footer">
                        <strong>Copyright &copy; 2017-<?= date('Y') ?> <a href="<?= Yii::$app->params['websiteCustomer'] ?>"><?= Yii::$app->name ?></a>. </strong> All rights reserved. | <?= Yii::$app->params['softwareBy'] ?>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>