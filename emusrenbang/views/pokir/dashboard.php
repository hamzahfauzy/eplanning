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

 if ($acara->Waktu_Mulai != null && $acara->Waktu_Selesai == null) {
    $js = 'var myVar = setInterval(function(){ myTimer() }, 1000);

    function myTimer() {
        var d = new Date(1000*' . $acara->Waktu_Mulai . ');
        var t = new Date() - d;
      var cur = new Date(t)
        document.getElementById("waktu").innerHTML = cur.getUTCHours() + " : " + cur.getUTCMinutes() + " : " +cur.getUTCSeconds();
    }';
    $this->registerJS($js);
}

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = '';

//$PC_Kelompok = Yii::$app->levelcomponent->getKelompok();
//$PC_InfoUser = Yii::$app->levelcomponent->getProfile();
//$Kd_Urut_Kel = $PC_Kelompok->Kd_Urut_Kel;



?>
<div class="row">
    <!--
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible alert-besar" role="alert">
            <strong>Maaf. Waktu Penyelenggaraan Musrenbang Kelurahan Telah Habis,</strong> Silahkan hubungi pihak Kecamatan untuk info lebih lanjut.
        </div>
    </div>

    -->
<?php //if ($Kd_Urut_Kel == 0) : ?>
    
    <div class="alert alert-info">
    <h4>Saat ini, Tahapan yang perlu dilakukan <br>
    1. Lakukan Load Data Usulan Kelurahan dan Usulan Lingkungan yang disetujui Kelurahan <br/>
    2. Klik Menu Skoring untuk menentukan OPD, Prioritas Pembangunan dan Skor Usulan <br/>
    3. Selesaikan Skoring dan Tambah Usulan Kecamatan untuk mengirim usulan ke OPD
    </h4>
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
          <h3>Jumlah Usulan Anda</h3>
          <h2> <?= number_format($jlh_usulan,0,',', '.') ?> </h2>
        </div>
      </div>
    </div>

    <div class="col-md-4">
        <div class="tile2 tile-info">
            <?php if ($acara->Waktu_Mulai == null ) : ?>
             <h3>Memulai Input Usulan Pokir</h3>
              <h2><?= Html::a('MULAI', ['pokir/mulai'], ['class' => 'btn btn-warning']) ?></h2>
            <?php elseif ($acara->Waktu_Selesai == 0) : ?>
                <h3 class="waktu_text" >Waktu</h3>
                <span id="waktu" class="waktu_value" ></span>
            <?php else : ?>
                <h4><b>INPUT USULAN POKIR SELESAI</b></h4>
                <p>Silakan pilih menu cetak usulan  untuk mencetak usulan.</p>
            <?php endif; ?>
    

        </div>

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
             
                <?= $form->field($acara, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>
                <?= $form->field($acara, 'Alamat')->textInput(['maxlength' => true]) ?> 

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
    <div class="jumbotron col-md-12">
        <h3>Selamat Datang Bapak/Ibu </h3>
        <h2>Dapil  <?= $Dapil->kdDapil->Nm_Dapil ?></h2>
        <h3>Mewakili Kecamatan : </h3>
        <?php foreach ($DapilKec as $Kecamatan): 
         ?>
        <h4> <?= $Kecamatan->refKecamatan['Nm_Kec']; ?> </h4>

        <?php endforeach; ?>
        
    </div>
</div>
  