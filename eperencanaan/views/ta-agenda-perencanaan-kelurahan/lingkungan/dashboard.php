<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

$this->registerCssFile(
        '@web/css/sistem/dashboard_style.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/jquery.number.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);


$this->registerJsFile(
        '@web/js/sistem/dashboard_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
/*$this->registerJsFile(
        '@web/js/sistem/dashboard_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);*/



/*
  $this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $this->title;
 */

if ($acara->Waktu_Mulai != null) {
    $js = 'var myVar = setInterval(function(){ myTimer() }, 1000);

    function myTimer() {
        var d = new Date(1000*' . $acara->Waktu_Mulai . ');
        var t = new Date() - d;
    	var cur = new Date(t)
        document.getElementById("waktu").innerHTML = cur.getUTCHours() + " : " + cur.getUTCMinutes() + " : " +cur.getUTCSeconds();
    }';
    $this->registerJS($js);
}


$PC_Kelompok = Yii::$app->levelcomponent->getKelompok();
$PC_InfoUser = Yii::$app->levelcomponent->getProfile();
$PC_NamaLingkungan =  Yii::$app->levelcomponent->getNamaLingkungan();
$nama_user='';
$nama_lingkungan='';
$Nm_Kec='';
$Nm_Kel='';

if ($PC_InfoUser !='') {
  $nama_user=$PC_InfoUser->Nm_Lengkap;
};

if ($PC_NamaLingkungan !='') {
  $nama_lingkungan=$PC_NamaLingkungan;
};

if($PC_Kelompok->kdKec != ''){
  $Nm_Kec=$PC_Kelompok->kdKec->Nm_Kec;
}

if($PC_Kelompok->kdKel != ''){
  $Nm_Kel=$PC_Kelompok->kdKel->Nm_Kel;
}

$this->title = 'Dashboard';
$this->params['subtitle'] = 'Home';
$this->params['breadcrumbs'][] = '';
//$PC_NamaLingkungan
//$PC_Kelompok->kdKel->Nm_Kel
//$PC_Kelompok->kdKec->Nm_Kec


?>
<div class="row wrapper">
    <!--
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible alert-besar" role="alert">
            <strong>Maaf. Waktu Penyelenggaraan Forum Lingkungan Telah Habis,</strong> Silahkan hubungi pihak kelurahan untuk info lebih lanjut.
        </div>
    </div>
    -->
    <div class="col-md-4">
      <div class="tile2 tile-warning">
        <div class="media-middle media-left">
          <span class="circle bg-warning">
            <span class="glyphicon glyphicon-download"></span>
          </span>
        </div>
        <div class="media-middle media-right">
          <h2>Panduan </h2>
          <p><a href="../panduan/panduan-rembuk-warga.pdf" target="_blank">Download Pengguna</a></p>
          <p><a href="../sop/sopwarga.pdf" target="_blank">Download SOP</a></p></h5>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="tile2 tile-danger">
        <div class="media-middle media-left">
          <span class="circle bg-danger">
            <span class="glyphicon glyphicon-bullhorn"></span>
          </span>
        </div>
        <div class="media-middle media-right">
          <h3>Jumlah Usulan</h3>
          <h2> <?= number_format($ZULtotallingkungan,"0", ",", "."); ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="tile2 tile-success">
        <div class="media-middle media-left">
          <span class="circle bg-success">
            <span class="glyphicon glyphicon-list-alt"></span>
          </span>
        </div>
        <div class="media-middle media-right" title="Klik Download Untuk Memulai Rembuk Warga">
          <?php if ($acara->Waktu_Unduh_Absen == null) : ?>
              <h3>Memulai Rembuk Warga</h3>
              <h2><?= Html::Button('Unduh Absensi', ['class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#modal_info_rembuk']) ?></h2>
          <?php elseif ($acara->Waktu_Mulai == $acara->Waktu_Selesai && $acara->Waktu_Mulai !== 0) : ?>
               <h3>Lihat Data di Rekapitulasi</h3>
               <h3>REMBUK WARGA TIDAK TERLAKSANA</h3>
          <?php elseif ($acara->Waktu_Mulai == 0) : ?>
              <h3>Memulai Rembuk Warga</h3>
              <h2><?= Html::a('MULAI', ['lingkungan/mulai', 'kode' => '2'], ['class' => 'btn btn-warning']) ?></h2>
          <?php elseif ($acara->Waktu_Selesai == 0) : ?>
              <h3 class="waktu_text" >Waktu</h3>
              <h2><span id="waktu" class="waktu_value" ></span></h2>

          <?php else : ?>
              <h3>Lihat Data di Rekapitulasi</h3>
              <h2>REMBUK WARGA SELESAI</h2>
          <?php endif; ?>
        </div>
      </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 ">
      <div class="description">
        <h2>Selamat Datang</h2>
        <p>
        <h1>
         <b><?= $nama_user ?></b>
          dari <b><?= $nama_lingkungan ?></b>
          Kelurahan <b><?= $Nm_Kel ?></b>
          Kecamatan <b><?= $Nm_Kec ?></b>.
        </h1>
        </p>
        <br>
         <?php if ($acara->isNewRecord) : ?>
        <h3>Tidak dapat melakukan Rembuk Warga? Silakan
            <?= Html::a('klik di sini!', '#', ['data-toggle' => 'modal', 'data-target' => '#modal_nihil']);
            ?>
        </h3>
        <?php endif;?>
      </div>

    </div>
</div>

<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_info_rembuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['target' => '_blank']]) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
            </div>
            <div class="modal-body">
                <?= $form->field($acara, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($acara, 'Alamat')->textInput(['maxlength' => true]) ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
                <?= Html::submitButton('Mulai', ['class' => 'btn btn-primary', 'id' => 'absen_btn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_nihil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'action' => ['lingkungan/nihil'],'options' => [ 'enctype' => 'multipart/form-data']]) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
            </div>
            <div class="modal-body">
                <?= Html::a('Unduh Format Surat Pernyataan', ['lingkungan/berita-nihil'],['target'=> '_blank','class' => 'btn btn-primary']) ?>
                <br><br>
                <?= $form->field($ZULnihil, 'nihil')->widget(kartik\widgets\FileInput::className()) ?>
                <?= $form->field($ZULnihil, 'alasan')->textInput(['maxlength' => true]) ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
                <?= Html::submitButton('Mulai', ['class' => 'btn btn-primary', 'id' => 'absen_btn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /.modal form -->
