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

// Register tooltip/popover initialization javascript
$this->registerJsFile(
        '@web/js/sistem/menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/css/sistem/menu.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = '';

$PC_Kelompok = Yii::$app->levelcomponent->getKelompok();
$PC_InfoUser = Yii::$app->levelcomponent->getProfile();
$Kd_Urut_Kel = $PC_Kelompok->Kd_Urut_Kel;


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

?>
<div class="row">
    <!--
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible alert-besar" role="alert">
            <strong>Maaf. Waktu Penyelenggaraan Musrenbang Kelurahan Telah Habis,</strong> Silahkan hubungi pihak Kecamatan untuk info lebih lanjut.
        </div>
    </div>

    -->
<?php if ($Kd_Urut_Kel == 0) : ?>
    <?php if ($acara->Waktu_Unduh_Absen == null) : ?>
    <div class="alert alert-info">
    <strong>Silahkan Unduh Absensi Terlebih dahulu untuk memulai.</strong>
        <i>Anda tidak bisa mengakses menu lain sebelum melakukan proses ini</i>
        </div>
    <?php elseif ($acara->Waktu_Mulai == 0) : ?>
    <div class="alert alert-info">
    <strong>Klik tombol Mulai untuk memulai Musrenbang Kecamatan.</strong>
        <i>Anda tidak bisa mengakses menu lain sebelum melakukan proses ini</i>
        </div>
     <?php elseif ($acara->Waktu_Selesai == 0) : ?>
    <div class="alert alert-info">
    <h4>Saat ini, Tahapan yang perlu dilakukan <br>
    1. Lakukan verifikasi usulan kecamatan, dengan mengelik  menu "Rekapitulasi Usulan Lingkungan". <br>
    2. Klik menu Tambah Usulan Kelurahan jika ada usulan kelurahan yang belum diakomodir , dengan mengelik  menu "Tambah usulan Lingkungan".<br>
    3. Selesaikan Verifikasi usulan lingkungan seluruhnya untuk melakukan tahap berikutnnya.
    </h4>
        </div>
    <?php else : ?>
    <div class="alert alert-info">
    <strong>Musrenbang Kecamatan telah selesai</strong>
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
          <h5><a href="../web/sop/sopkecamatan.pdf" target="_blank">Download SOP</a></h5>
          <h5><a href="../web/uploads/USERMANUALMUSRENBANGKECAMATAN.pdf" target="_blank">Download Panduan Pengguna</a></h5>
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
          <h3>Jumlah Usulan Kelurahan</h3>
          <h2> <?= number_format($jlh_usulan,0,',', '.') ?> </h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
        <div class="tile2 tile-info">
        
        <?php
            if ($acara->Waktu_Unduh_Absen == null) : ?>
            <?= Html::Button('<span class="glyphicon glyphicon-download"></span> Unduh Absensi', ['class' => 'btn btn-primary btn-lg',
                        'data-toggle' => 'modal','tooltip',
                        'data-target' => '#modal_info_rembuk',
                        'data-placement' => 'bottom',
                        'title' => 'Unduh absen untuk memulai']) ?>
                <p>Download Absen sebelum memulai Musrenbang</p>
           <?php elseif ($acara->Waktu_Mulai == 0 ) : ?>
             <h3>Memulai Musrenbang Kecamatan</h3>
              <h2><?= Html::a('MULAI', ['ta-musrenbang-kecamatan-acara/mulai', 'kode' => '2'], ['class' => 'btn btn-warning']) ?></h2>
            <?php elseif ($acara->Waktu_Selesai == 0) : ?>
                <h3 class="waktu_text" >Waktu</h3>
                <span id="waktu" class="waktu_value" ></span>
            <?php else : ?>
                <h4><b>MUSRENBANG SELESAI</b></h4>
                <p>Silakan pilih menu cetak usulan kecamatan untuk mencetak usulan.</p>
            <?php endif; ?>
    

        </div>

        <!--Untuk Akses Lingkungan -->
<?php elseif ($Kd_Urut_Kel != 0) : ?>

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
          <h2><a href="../web/sop/sopwarga.pdf" target="_blank"">Download</a></h2>
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
          <h3>Jumlah Usulan Lingkungan</h3>
          <h2> <?= number_format($jlh_usulan,0,',', '.') ?> </h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
        <div class="tile tile-info">
                <h4><b>Rembuk Warga Selesai</b></h4>
                <p>Anda sedang berada pada masa Musrenbang Kecamatan.</p>
        </div>

<?php endif ?>

<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_info_rembuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'action' => ['ta-musrenbang-kecamatan-acara/absensi', 'kode'=>1],'options'=>[
                'target' =>'_blank'
            ]]) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Silakan isi lokasi Musrenbang Kecamatan</h4>
            </div>
            <div class="modal-body">
              <!--   <?php
                    if ($kel_acara->count() == 0) :?>
                    <?= $form->field($acara, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($acara, 'Alamat')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($acara, 'Nama_Pejabat')->textInput(['maxlength' => true])->label("Nama Camat"); ?>
                <?php else : ?>
                    <p>Mohon maaf, kelurahan yang berada di bawah Kecamatan anda belum semua mengirimkan usulannya. Berikut daftar kelurahan yang belum mengirim data.</p>
                    <table border="1">
                        <th width="50px">No</th>
                        <th width="200px">Lingkungan</th>
                        <th width="200px">Nama Kepala Lingkungan</th>
                        <th width="100px">No HP</th>
                        <?php $no=1;foreach ($kel_acara->all() as $data) : ?>
                        <tr>
                            
                        </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?> -->

                <?= $form->field($acara, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($acara, 'Alamat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($acara, 'Nama_Pejabat')->textInput(['maxlength' => true])->label("Nama Camat"); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
                <?php if ($kel_acara->count() == 0): ?>
                <?= Html::submitButton('Mulai', ['class' => 'btn btn-primary',
                    'onclick'=>'return (function(event){setTimeout(function () { window.location.reload(); }, 6000);})()']) ?>
                <?php endif; ?>

                 </div>
            <?php ActiveForm::end(); ?>

        </div>

      </div>
    </div>
</div>
<div class="row">
    <div class="jumbotron col-md-12">
        <h2>Kecamatan  <?= $PC_Kelompok->kdKec->Nm_Kec ?></h2>
        <h3>Selamat Datang Bapak/Ibu <?= $PC_InfoUser['Nm_Lengkap'] ?></h3>
    </div>
</div>
