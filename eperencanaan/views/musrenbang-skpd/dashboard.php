<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

$this->registerJsFile(
        '@web/js/musrenbang/dashboard.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

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

$PC_Kelompok = Yii::$app->levelcomponent->getUnit();
$PC_InfoUser = Yii::$app->levelcomponent->getProfile();
//$namaopd = Yii::$app->levelcomponent->getNamaSkpdByUrusanSektor();
$Kd_Urut_Kel = 0;


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
$namaopd = Yii::$app->levelcomponent->getNamaOPD();
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
    <?php elseif ($acara->Waktu_Mulai == null && $acara->Waktu_Unduh_Absen != null && $dataSkoring == null) : ?>
    <div class="alert alert-info">
    <strong>Klik tombol Ambil (Load Data) untuk mengambil usulan kelurahan.</strong>
        <i>Anda tidak bisa mengakses menu lain sebelum melakukan proses ini</i>
        </div>
    <?php elseif ($dataSkoring != null && $acara->Waktu_Mulai == 0 ) : ?>
    <div class="alert alert-info">
    <strong>Klik tombol Mulai untuk memulai Forum Perangkat Daerah.</strong>
        <i>Anda tidak bisa mengakses menu lain sebelum melakukan proses ini</i>
        </div>
     <?php elseif ($acara->Waktu_Selesai == 0) : ?>
    <div class="alert alert-info">
    <h4>Saat ini, Tahapan yang perlu dilakukan <br>
    1. Lakukan Load Data Usulan Kelurahan dan Usulan Lingkungan yang disetujui Kelurahan <br/>
    2. Klik Menu Skoring untuk menentukan OPD, Prioritas Pembangunan dan Skor Usulan <br/>
    3. Selesaikan Skoring dan Tambah Usulan Kecamatan untuk mengirim usulan ke OPD
    </h4>
        </div>
    <?php else : ?>
    <div class="alert alert-info">
    <strong>Forum Perangkat Daerah telah selesai</strong>
        <i>Terima Kasih.</i>
        </div>
   <?php endif ?>

    <div class="col-md-3">
      <div class="tile2 tile-warning">
        <div class="media-middle media-left">
          <span class="circle bg-warning">
            <span class="glyphicon glyphicon-download"></span>
          </span>
        </div>
        <div class="media-middle media-right myTooltipClass"
                                            >
          <h3>Panduan Pengguna</h3>
          <h5><a href=# target="_blank">Download SOP</a></h5>
          <h5><a href="../panduan/Forum Perangkat Daerah.pdf" target="_blank">Download Panduan Pengguna</a></h5>
        </div>
      </div>
    </div>


    <div class="col-md-3">
      <div class="tile2 tile-danger">
        <div class="media-middle media-left">
          <span class="circle bg-danger">
            <span class="glyphicon glyphicon-bullhorn"></span>
          </span>
        </div>
        <div class="media-middle media-right">
          <h3>Jumlah Usulan Kecamatan</h3>
          <h2> <?= number_format($usulanKec,0,',', '.') ?> </h2>
        </div>
      </div>
    </div>
	<div class="col-md-3">
      <div class="tile2 tile-primary">
        <div class="media-middle media-left">
          <span class="circle bg-danger">
            <span class="glyphicon glyphicon-bullhorn"></span>
          </span>
        </div>
        <div class="media-middle media-right">
          <h3>Jumlah Usulan Pokir</h3>
          <h2> <?= number_format($usulanPokir,0,',', '.') ?> </h2>
        </div>
      </div>
    </div>
    <div class="col-md-3">
        <div class="tile2 tile-info">
        
        <?php
            if ($acara->Waktu_Unduh_Absen == null) : ?>
            <?= Html::Button('<span class="glyphicon glyphicon-download"></span> Unduh Absensi', 
						['class' => 'btn btn-primary btn-lg',
                        'data-toggle' => 'modal','tooltip',
                        'data-target' => '#modal_info_rembuk',
                        'data-placement' => 'bottom',
                        'title' => 'Unduh absen untuk memulai']) ?>
                <p>Download Absen sebelum memulai Forum</p>
            
           <?php elseif ($acara->Waktu_Unduh_Absen !== null && $acara->Waktu_Mulai == 0) : ?>
             <h3>Memulai Forum Perangkat Daerah</h3>
              <h2><?= Html::a('MULAI', ['musrenbang-skpd-acara/mulai'], ['class' => 'btn btn-warning']) ?></h2>
            <?php elseif ($acara->Waktu_Selesai == 0) : ?>
                <h3 class="waktu_text" >Waktu</h3>
                <span id="waktu" class="waktu_value" ></span>
            <?php else : ?>
                <h4><b>Forum Perangkat Daerah SELESAI</b></h4>
            <?php endif; ?>
    

        </div>

        <!--Untuk Akses Lingkungan -->
<?php elseif ($Kd_Urut_Kel != 0) : ?>

        <div class="alert alert-info">
        <strong>Anda hanya diperbolehkan untuk melihat usulan anda pada Menu Usulan</strong>
            <i>Terima Kasih.</i>
        </div>
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
          <h2><a href="../web/sop/sopwarga.pdf" target="_blank">Download</a></h2>
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
          <h3>Jumlah Usulan Kecamatan</h3>
          <h2> <?= number_format($jlh_usulan,0,',', '.') ?> </h2>
        </div>
      </div>
    </div>
    <div class="col-md-4">
        <div class="tile tile-info">
                <h4><b>Forum Perangkat Daerah Selesai</b></h4>
        </div>
<?php endif ?>


<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_info_rembuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'action' => ['musrenbang-skpd-acara/absensi', 'kode'=>1],'options'=>[
                'target' =>'_blank'
            ]]) ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Silakan isi lokasi Forum Perangkat Daerah</h4>
            </div>
            <div class="modal-body">
             

                <?= $form->field($acara, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($acara, 'Alamat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($acara, 'Nama_Pejabat')->textInput(['maxlength' => true])->label("Nama Kadis"); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
               
                <?= Html::submitButton('Mulai', ['class' => 'btn btn-primary',
                    'onclick'=>'return (function(event){setTimeout(function () { window.location.reload(); }, 6000);})()']) ?>
               

                 </div>
            <?php ActiveForm::end(); ?>

        </div>

      </div>
    </div>  
</div>
</div>



<div class="row">
  <!-- <?php
    if ($acara->Waktu_Mulai == null && $acara->Waktu_Unduh_Absen != null && $dataSkoring == null) :
    ?>
    <div class="col-md-4 col-md-offset-4">
      <div class="tile2 tile-success" id="btn_load" style="cursor: pointer">
        <div class="media-middle media-left">
          <span class="circle bg-success">
            <span class="glyphicon glyphicon-save"></span>
          </span>
        </div>
        <div class="media-middle media-right">
          <h3>Ambil (Load Data) Usulan Desa/Kelurahan dan Usulan Dusun/Lingkungan yang disetujui Desa/Kelurahan</h3>
        </div>
      </div>
    </div>
    <?php 
    endif; 
  ?> -->

  <?php
    //echo $acara->Waktu_Selesai;
    //if ($jlh_data_skoring == false && $acara->Waktu_Mulai != null && $acara->Waktu_Selesai == null) : 
	if ($acara->Waktu_Mulai != null && $acara->Waktu_Selesai == null) : 
    ?>
    <div class="col-md-4 col-md-offset-4">
      <div class="tile2 tile-success" id="btn_kirim" style="cursor: pointer">
        <div class="media-middle media-left">
          <span class="circle bg-success">
            <span class="glyphicon glyphicon-share-alt"></span>
          </span>
        </div>
        <div class="media-middle media-right">
          <h3>Klik Jika Forum Perangkat Daerah Selesai</h3>
           <?= Html::Button('<span class=" "></span> Selesai', ['class' => 'btn btn-warning btn-md',
                          'data-toggle' => 'modal','tooltip',
                          'data-target' => '#modal_info_kirim',
                          'data-placement' => 'bottom',
                          'title' => 'Peringatan']) ?>
        </div>
      </div>
    </div>
    <?php 
    endif 
  ?>

</div>

 
<div class="modal fade" id="modal_info_kirim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Selesai Forum Perangkat Daerah</h4>
      </div>
      <div class="modal-body" id="modal-skpd-content">
        <div id="modal_selesai_isi">
          <font color="red"><h3>Peringatan !!! </h3>
          <h3>Setelah Forum Perangkat Daerah Selesai, Usulan yang sudah di verifikasi tidak dapat di ubah.</h3></font>
        </div> 
        <div id="modal_selesai_loading" style="text-align: center; display: none;">
          <?= Html::img('@web/img/loading.gif', ['alt'=>'Loading...', 'class'=>'thing']);?>
          <h3 align="center">Jangan Tutup atau Refresh Browser sampai proses selesai!</h3>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>               
        <?= Html::button('Kirim', ['class' => 'btn btn-primary', 'id' => 'btn-kirim-opd']) ?>
      </div>
    </div>
  </div>
</div>


<div class="row">
    <div class="jumbotron col-md-12">
        <h2><?=$namaopd; ?></h2>
        <h3>Selamat Datang Bapak/Ibu <?= $PC_InfoUser['Nm_Lengkap'] ?></h3>
    </div>
</div>

<?php
Modal::begin([
    'header' => '<h4>Load Data</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tunda',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal", 'id'=>"btn_ambil_cancel"]).
                Html::button('Setuju & Proses',['class'=>'btn btn-success btn-save','type'=>"button", 'id'=>"btn_ambil_simpan_opd"]),
    "id"=>"ambilModal",
]);
echo "<div id='ambilContent' class='isi-modal'></div>";
Modal::end();
?>