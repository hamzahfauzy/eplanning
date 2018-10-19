<?php
use yii\helpers\Html;

$this->registerJsFile(
        '@web/js/sistem/jquery.number.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/usulan-tolak.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/ajax_jumlah_usulan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/sistem/revisi_ajax_1.js', ['depends' => [\yii\web\JqueryAsset::className(),
            ]]
);


$this->title = 'Usulan Tolak';


//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12 nav-wrap">
  <ul class="nav nav-tabs">
    <li role="presentation">
      <?= Html::a('Usulan Dusun/Lingkungan Belum Verifikasi (<span id="jlh-usulan"></span>)', ['ta-kelurahan-verifikasi-usulan-lingkungan/usulan-lingkungan']) ?>
    </li>
    <!--
    <li role="presentation">
      <?= Html::a('Usulan Direvisi', ['ta-kelurahan-verifikasi-usulan-lingkungan/usulan-revisi']) ?>
    </li>
    -->
    <li role="presentation" class="active">
      <?= Html::a('Usulan Ditolak (<span id="jlh-ditolak"></span>)', ['ta-kelurahan-verifikasi-usulan-lingkungan/usulan-tolak']) ?>
    </li>
    <li role="presentation">
      <?= Html::a('Usulan Diterima (<span id="jlh-diterima"></span>)', ['ta-kelurahan-verifikasi-usulan-lingkungan/usulan-terima']) ?>
    </li>
  </ul>
</div>
<div class="col-md-12">
  <div class="box-widget widget-module">
    <div class="widget-container">
      <div class=" widget-block">
        <div class="control-wrap">
          <form class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-1 control-label">Dusun/Lingkungan</label>
              <div class="col-sm-2">
                <select class="form-control" id="select-lingkungan">
                  <option>-Pilih-</option>
                  <?php
                    foreach ($lingkungan as $key => $val) :
                      $Kd_Lingkungan = $val['Kd_Lingkungan'];
                      $nama_lingkungan = $val['Nm_Lingkungan'];
                    ?>
                      <option value="<?= $Kd_Lingkungan ?>"><?= ucfirst($nama_lingkungan) ?></option>
                    <?php
                    endforeach;
                  ?>
                </select>
              </div>
            </div>
          </form>
        </div>
        <table class="table table-bordered data-table tabel-data">
          <thead>
            <tr>
                <th>
                    No
                </th>
                <th>
                    Usulan
                </th>
                <th>
                    Jumlah/vol
                </th>
                <th>
                    Biaya (Rp)
                </th>
                <th>
                    Lokasi
                </th>
                <th>
                    Status Survey
                </th>
                <th>
                    Aksi
                </th>
                <th>
                    Keterangan
                </th>
                <th>
                    Status
                </th>
                <th>
                    Penerimaan
                </th>
            </tr>
          </thead>
          <tbody id="body-tabel"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php if ($ZULstatus == 0){
    if (Yii::$app->levelcomponent->getVerifikasiKelurahan()){
        echo Html::Button('Selesai Verifikasi',['class' => 'btn btn-danger btn-lg',
        'data-toggle' => 'modal', 'data-target' => '#ubah_status','id'=>'btn-revisi']);
    }else{
        echo Html::Button('Selesai Verifikasi',['class' => 'btn btn-danger btn-lg',
        'disabled' => 'disabled']);
    }
}?>


<!-- Modal -->
<div class="modal fade" id="modal_lihat_dokumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>

<div class="modal fade" id="modal_lihat_riwayat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div> 

<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_koordinat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Koordinat</h4>
            </div>
            <div class="modal-body">
                <div id="peta" style="height:300px; width: 550px" class="col-md-12"></div>
                <input type="hidden" name="kd_usulan" id="kd_usulan_input">
                <div class="form-group">
                    <label >Latitude</label>
                    <input type="text" name="lat" id="lat" class="form-control" placeholder="Latitude">
                </div>
                <div class="form-group">
                    <label >Longitude</label>
                    <input type="text" name="long" id="lng" class="form-control" placeholder="Longitude">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_terima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Usulan Diterima</h4>
      </div>
      <div class="modal-body">
          <div id="keterangan_ajax"></div>
        <form id="form-terima">
          <input type="hidden" id="kd_usulan_diterima" name="Kd_Ta_Forum_Lingkungan">
          <input type="hidden" name="Kd_Prioritas_Pembangunan_Daerah">
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" name="Keterangan" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="btn-simpan-terima">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="ubah_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
            </div>
            <div class="modal-body">
                <h2>Apakah anda yakin usulan sudah selesai diverifikasi?</h2>
                *) Apabila tombol ini telah di klik, anda tidak dapat melakukan verifikasi dan tambah usulan dusun/lingkungan lagi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
                <?= Html::a('Selesai', ['ta-musrenbang-kelurahan-acara/ubah-status-usulan'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
<!-- /.modal form -->

<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="revisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Revisi Usulan</h4>
            </div>
            <div class="modal-body" id="revisi-body">
               
            </div>
            <div class="modal-footer" id="revisi-footer">
                <button type="button" class="btn pull-left" data-dismiss="modal">Tutup</button>
                <?= Html::Button('Revisi', ['class' => 'btn btn-success', 'id' => 'btn-simpan-revisi', 'data-kr' => '', 'style' => 'display: none;']) ?>
            </div>
        </div>
    </div>
</div>
<!-- /.modal form -->