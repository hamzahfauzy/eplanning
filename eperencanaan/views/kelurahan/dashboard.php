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

$this->title = 'Dashboard';
$this->params['subtitle'] = 'Home';
$this->params['breadcrumbs'][] = '';
/*
  $this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $this->title;
 */

if ($acara != null) {
    $js = 'var myVar = setInterval(function(){ myTimer() }, 1000);

    function myTimer() {
        var d = new Date(1000*' . $acara->Waktu_Mulai . ');
        var t = new Date() - d;
    	var cur = new Date(t)
        document.getElementById("waktu").innerHTML = cur.getUTCHours() + " : " + cur.getUTCMinutes() + " : " +cur.getUTCSeconds();
    }';
    $this->registerJS($js);
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible alert-besar" role="alert">
            <strong>Maaf. Waktu Penyelenggaraan Forum Dusun/Lingkungan Telah Habis,</strong> Silahkan hubungi pihak desa/kelurahan untuk info lebih lanjut.
        </div>
    </div>

    <div class="jumbotron">
        <h2>FORUM Lingkungan</h2>
        <p>
            Selamat datang Team (Nama Lingkungan), Kelurahan Belawan I , Kecamatan Medan Belawan.<br>
            Anda masuk sebagai user Kepala Lingkungan. <br><br>
        </p>
    </div>

    <div class="col-md-4">
        <a href="#" class="tile tile-primary">
            <span class="pagu">Rp. <span class="rupiah"><?= $indikatifKecamatan ?></span></span>
            <p>Pagu Indikatif Kecamatan</p>
        </a>
    </div> 
    <div class="col-md-4">
        <a href="#" class="tile tile-danger ">
            <span class="pagu">Rp. <span class="rupiah"><?= $indikatifKelurahan ?></span></span>
            <p>Pagu Indikatif Kelurahan</p>
        </a>
    </div> 
    <div class="col-md-4">
        <div class="tile tile-info">
            <?php if ($acara->Waktu_Unduh_Absen == null) : ?>
                <div class="alert alert-info">
                <strong>Info!</strong> Indicates a neutral informative change or action.
                </div>
                <?= Html::a('<span class="glyphicon glyphicon-download"></span> Download Absensi', ['ta-musrenbang-kelurahan-acara/absensi', 'kode' => '1'], ['class' => 'btn btn-primary btn-lg btn-refresh', 'target' => '_blank','data-toggle' => 'modal', 'data-target' => '#modal_info_rembuk']) ?>
                <p>Download Absen sebelum memulai Forum</p>
            <?php elseif ($acara->Waktu_Mulai == 0) : ?>
                <?= Html::a('<span class="glyphicon glyphicon-download"></span> MULAI', ['ta-musrenbang-kelurahan-acara/mulai', 'kode' => '2'], ['class' => 'btn btn-primary']) ?>
                <p>Klik Tombol Mulai di atas apabila forum akan dimulai</p>
            <?php elseif ($acara->Waktu_Selesai == 0) : ?>
                <h3 class="waktu_text" >Waktu</h3>
                <span id="waktu" class="waktu_value" ></span>
            <?php else : ?>
                <h4><b>FORUM SELESAI</b></h4>
                <p>Silakan pilih menu rekapitulasi usulan untuk mencetak berita acara atau usulan.</p>
            <?php endif; ?>

            <!--<button class="btn btn-primary btn-lg">Download</button>
            <p>Download Absensi untuk memulai</p>-->
        </div>
    </div> 
    <div class="col-md-4">
        <a href="#" class="tile tile-success">
            <span class="pagu">Rp. <span class="rupiah"><?= $indikatifLingkungan ?></span></span>
            <p>Pagu Indikatif Lingkungan</p>
        </a>
    </div> 
    <div class="col-md-4">
        <a href="#" class="tile tile-success">
            <?php
            $NASpagulingkungan = $indikatifLingkungan;
            $NASTotalLingkungan = $NASTotalLingkungan['cnt'];
            $NASSisaPagu = $NASpagulingkungan - $NASTotalLingkungan;
            ?>
            <span class="pagu">Rp. <span class="rupiah"><?= $NASSisaPagu ?></span></span>
            <p>Sisa Pagu Indikatif Lingkungan</p>
        </a>
    </div> 
    <div class="col-md-4">
        <a href="#" class="tile tile-warning">
            <?= $usulanLingkungan ?>
            <p>Jumlah Usulan Lingkungan</p>
        </a>
    </div> 
</div>

<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_info_rembuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options'=>[
                'action' => 'TaMusrenbagKelurahanAcara/absensi'
            ]]) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
            </div>
            <div class="modal-body">
                <?= $form->field($acara, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($acara, 'Alamat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($acara, 'Nama_Pejabat')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
                <?= Html::submitButton('Mulai', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- /.modal form -->