<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use eperencanaan\assets\AppAsset;
use dmstr\widgets\Alert;
use yii\bootstrap\ActiveForm;

AppAsset::register($this);
$PC_Roles = Yii::$app->levelcomponent->getRoles();
$PC_InfoUser = Yii::$app->levelcomponent->getProfile();
//mengganti foto dengan avatar jika tidak menemukan foto
if ($PC_InfoUser['Foto'] == '') {
    $foto = 'avatar.jpg';
} else {
    $foto = $PC_InfoUser['Foto'];
}

$js = '$("#input-fp").on("change",function(event){
          var output = document.getElementById("fp");
          //alert(event.target.files[0]);
          output.src = URL.createObjectURL(event.target.files[0]);
        })';
$this->registerJs(
        $js, \yii\web\View::POS_READY);


//menentukan judul
$PCJadwal = Yii::$app->levelcomponent->getJadwal();
switch ($PCJadwal) {
    case 1:
        $judul = "E-Planning Kabupaten Asahan";
        //$judul2 = "Rembuk Warga " . $Nama_Lingkungan;
        break;
    case 2:
        $judul = "E-Planning Kabupaten Asahan";
        //$judul2 = "Musrenbang Kelurahan " . $Nama_Kelurahan;
        break;
    case 3:
        $judul = "E-Planning Kabupaten Asahan";
        //$judul2 = "Musrenbang Kecamatan " . $Nama_Kelurahan;
        break;
    default:
        $judul = "";
        $judul2 = "";
        break;
}
$judul2 = "";
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
                <div class="col-md-5 text-left" id="header1">
                    <img src="img/logo.png" id="logo">  <?= Yii::$app->pengaturan->Kolom('Nm_Pemda') ?>
                </div>
                <div class="col-md-7" id="header2">
                    <div class="row">
                        <div class="col-md-8">
                            <h3><?= $judul ?></h3>
                        </div>
                        <div class="col-md-4">
                            <div class="pull-right" id="user-wrap">
                                <a href="#"><img id="user-image"  class="img-circle" src='<?= "http://eplanning.asahankab.go.id/eperencanaan/userlevel/web/uploads/" . $foto ?>'></a>
                            </div>
                            <div class="pull-right user-info">
                                <span class="user-name"><?= yii::$app->user->identity->username ?></span>
                                <span class="user-place"><?= $PC_InfoUser['Nm_Lengkap'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "main_menu.php" ?>
            <div class="row">
                <div class="col-md-12 page-title">
                    <?php
                    $PC_action = Yii::$app->controller->action->id;
                    $PC_controller = Yii::$app->controller->id;
                    if ($this->title !== null && $PC_action != 'index') {
                        echo "<h3>" . \yii\helpers\Html::encode($this->title) . "</h3>";
                    } else {
                        echo "<h4>" . $judul2 . "</h4>";
                    }

                    $acara = Yii::$app->levelcomponent->getWaktuAcara();
                    if ($acara == 1)
                        $url = 'index.php?r=lingkungan/index';
                    elseif ($acara == 2)
                        $url = 'index.php?r=ta-musrenbang-kelurahan/index';
                    elseif ($acara == 3)
                        $url = 'index.php?r=ta-musrenbang-kecamatan/index';
                    else {
                        $url = '#';
                    }

                    echo Breadcrumbs::widget(
                            [
                                'homeLink' => ['label' => 'Dashboard',
                                    'url' => $url],
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
                    &copy <?= $Tahun = Yii::$app->pengaturan->getTahun(); ?> Badan Perencanaan Pembangunan <?= Yii::$app->pengaturan->Kolom('Nm_Pemda') ?>.
                </div>
            </div>
        </div>
        <div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php
                    $form = ActiveForm::begin([
                                'method' => 'post',
                                'action' => ['user/upload-foto'],
                                'options' => ['enctype' => 'multipart/form-data']
                            ])
                    ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ganti Foto Profil a</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="kd_usulan" id="kd_usulan_input">
                        <img src="" class="img-circle" width="300px" height = "300px"id="fp">
                        <div class="form-group">
                            <label >Pilih Foto</label>
                            <input type="file" name="Foto" class="form-control" placeholder="Nama Jalan"id="input-fp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
