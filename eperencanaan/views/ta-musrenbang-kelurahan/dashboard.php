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
/**
  // Register tooltip/popover initialization javascript
  $this->registerJsFile(
  '@web/js/sistem/menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]
  );
$this->registerCssFile(
        '@web/css/sistem/menu.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

 * 
 */
$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = '';
$PC_Kelompok = Yii::$app->levelcomponent->getKelompok();
$PC_InfoUser = Yii::$app->levelcomponent->getProfile();
$Kd_Lingkungan = $PC_Kelompok->Kd_Lingkungan;

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

$status = $setting[0]->status;
?>
<div class="row">

    <?php if ($Kd_Lingkungan == 0) : ?>
        <?php if ($acara->Waktu_Unduh_Absen == null) : ?>
            <div class="alert alert-info">
                <strong>Silahkan Unduh Absensi Terlebih dahulu untuk memulai.</strong>
                <i>Anda tidak bisa mengakses menu lain sebelum melakukan proses ini</i>
            </div>
        <?php elseif ($acara->Waktu_Mulai == 0) : ?>
            <div class="alert alert-info">
                <strong>Klik tombol Mulai untuk memulai Musrenbang Desa/Kelurahan.</strong>
                <i>Anda tidak bisa mengakses menu lain sebelum melakukan proses ini</i>
            </div>
        <?php elseif ($acara->Waktu_Selesai == 0) : ?>
            <div class="alert alert-info">
                <h4>Saat ini, Tahapan yang perlu dilakukan <br>
                    1. Lakukan verifikasi usulan dusun/lingkungan, dengan mengelik  menu "Rekapitulasi Usulan". <br>
                    2. Klik menu Tambah Usulan Dusun/Lingkungan jika ada usulan dusun/lingkungan yang belum diakomodir , dengan mengelik  menu "Tambah usulan Dusun/Lingkungan".<br>
                    3. Selesaikan Verifikasi usulan dusun/lingkungan seluruhnya untuk melakukan tahap berikutnnya.
                </h4>
            </div>
        <?php else : ?>
            <div class="alert alert-info">
                <strong>Musrenbang Desa/Kelurahan telah selesai</strong>
                <i>Terima Kasih.</i>
            </div>
        <?php endif ?>

        <div class="col-md-4">
            <div class="tile2 tile-warning">
                <div class="media-middle media-left">
                    <span class="circle bg-warning">
                        <span class="glyphicon glyphicon-download"></span>
                    </span>
                </div>
                <div class="media-middle media-right myTooltipClass"
                     >
                    <h3>Panduan Pengguna</h3>
                    <h5><a href="../sop/sop-musrenbang-kelurahan.pdf" target="_blank">Download SOP</a></h5>
                    <h5><a href="http://eplanning.asahankab.go.id/eperencanaan/eperencanaan/panduan/Musrenbang%20desa_kelurahan.pdf" target="_blank">Download Panduan Pengguna</a></h5>
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
                    <h3>Jumlah Usulan Dusun/Lingkungan</h3>
                    <h2> <?= number_format($jlh_usulan, 0, ',', '.') ?> </h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tile2 tile-info">

                <?php if ($acara->Waktu_Unduh_Absen == null) : ?>
                    <?=
                    Html::Button('<span class="glyphicon glyphicon-download"></span> Unduh Absensi', ['class' => 'btn btn-primary btn-lg',
                        'data-toggle' => 'modal', 'tooltip',
                        'data-target' => '#modal_info_rembuk',
                        'data-placement' => 'bottom',
                        'title' => 'Unduh absen untuk memulai'])
                    ?>
                    <p>Download Absen sebelum memulai Musrenbang</p>
                <?php elseif ($acara->Waktu_Mulai == 0) : ?>
                    <h3>Memulai Musrenbang Desa/Kelurahan</h3>
                    <h2><?= Html::a('MULAI', ['ta-musrenbang-kelurahan-acara/mulai', 'kode' => '2'], ['class' => 'btn btn-warning']) ?></h2>
                <?php elseif ($acara->Waktu_Selesai == 0) : ?>
                    <h3 class="waktu_text" >Waktu</h3>
                    <span id="waktu" class="waktu_value" ></span>
                <?php else : ?>
                    <h4><b>MUSRENBANG SELESAI</b></h4>
                    <p>Silakan pilih menu cetak usulan desa/kelurahan untuk mencetak usulan.</p>
                <?php endif; ?>
                <!--Untuk Akses Lingkungan -->
            <?php elseif ($Kd_Lingkungan != 0) : ?>

                <div class="alert alert-info">
                    <strong>Anda hanya diperbolehkan untuk melihat usulan anda pada Menu Usulan</strong>
                    <i>Terima Kasih.</i>
                </div>

                <div class="col-md-4">
                    <div class="tile2 tile-warning">
                        <div class="media-middle media-left">
                            <span class="circle bg-warning">
                                <span class="glyphicon glyphicon-download"></span>
                            </span>
                        </div>
                        <div class="media-middle media-right myTooltipClass"
                             >
                            <h3>Panduan Pengguna</h3>
                            <h2><a href="../sop/sop-rembuk-warga.pdf" target="_blank"">Download</a></h2>
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
                            <h3>Jumlah Usulan Dusun/Lingkungan</h3>
                            <h2> <?= number_format($jlh_usulan, 0, ',', '.') ?> </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tile tile-info">
                        <h4><b>Rembuk Warga Selesai</b></h4>
                        <p>Anda sedang berada pada masa Musrenbang Desa/Kelurahan.</p>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <!-- modal musrenbang kelurahan -->
        <div class="modal fade" id="modal_info_rembuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php
                    $form = ActiveForm::begin(['layout' => 'horizontal', 'action' => ['ta-musrenbang-kelurahan-acara/absensi', 'kode' => 1], 'options' => [
                                    'target' => '_blank'
                        ]])
                    ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Silakan isi lokasi musrenbang desa/kelurahan</h4>
                    </div>
                    <div class="modal-body">
                       
                        <?php if ($jlhlingkungan == $acaracount || $status == 0): ?> 
                            <?= $form->field($acara, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($acara, 'Alamat')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($acara, 'Nama_Pejabat')->textInput(['maxlength' => true])->label("Nama Kepala Desa/Lurah"); ?>
                        <?php else : ?>
                            <p>Mohon maaf, dusun/lingkungan yang berada di bawah desa/kelurahan anda belum semua mengirimkan usulannya. Berikut daftar dusun/lingkungan yang sudah mengirim data.</p>
                            <h3>Desa/Kelurahan Yang Belum Menyelenggarakan</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Dusun/Lingkungan</th>
                                        <th>Status Penyelenggaraan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($data_lingkungan as $key => $value) :
                                        ?>
                                            <tr>
                                                <td><?= $value['Nm_Lingkungan'] ?></td>
                                                <td><?= $value['Status'] ?></td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        <?php endif; ?>  
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
                    <?php if ($jlhlingkungan == $acaracount || $status == 0): ?>
                            <?=
                            Html::submitButton('Mulai', ['class' => 'btn btn-primary',
                                'onclick' => 'return (function(event){setTimeout(function () { window.location.reload(); }, 6000);})()'])
                            ?>
                        <?php endif; ?> 

                    </div>
                    <?php ActiveForm::end(); ?>

                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="jumbotron col-md-12">
        <h2><b>Desa/Kelurahan <?= $PC_Kelompok->kdKel->Nm_Kel ?></b> Kecamatan  <?= $PC_Kelompok->kdKec->Nm_Kec ?></h2>
        <h3>Selamat Datang Bapak/Ibu <?= $PC_InfoUser['Nm_Lengkap'] ?></h3>
    </div>
</div>
