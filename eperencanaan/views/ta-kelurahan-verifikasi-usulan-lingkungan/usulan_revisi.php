<?php
use yii\helpers\Html;

$this->registerJsFile(
        '@web/js/sistem/jquery.number.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/usulan-revisi.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Usulan Revisi';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12 nav-wrap">
  <ul class="nav nav-tabs">
    <li role="presentation">
      <?= Html::a('Usulan Dusun/Lingkungan', ['ta-kelurahan-verifikasi-usulan-lingkungan/usulan-lingkungan']) ?>
    </li>
    <!--
    <li role="presentation">
      <?= Html::a('Usulan Direvisi', ['ta-kelurahan-verifikasi-usulan-lingkungan/usulan-revisi']) ?>
    </li>
    -->
    <li role="presentation">
      <?= Html::a('Usulan Ditolak', ['ta-kelurahan-verifikasi-usulan-lingkungan/usulan-tolak']) ?>
    </li>
    <li role="presentation">
      <?= Html::a('Usulan Diterima', ['ta-kelurahan-verifikasi-usulan-lingkungan/usulan-terima']) ?>
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


<!-- Modal -->
<div class="modal fade" id="modal_terima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Usulan Diterima</h4>
      </div>
      <div class="modal-body">
        <form id="form-terima">
          <input type="hidden" id="kd_usulan_diterima" name="Kd_Ta_Musrenbang_Kelurahan_Verifikasi">
          <div class="form-group">
            <label for="prioritas">Prioritas Pembangunan</label>
            <select class="form-control" name="Kd_Prioritas_Pembangunan_Daerah">
              <?php
                foreach ($rpjmd as $key => $val_rpjmd) :
                  $Kd_Prioritas_Pembangunan_Kota = $val_rpjmd['Kd_Prioritas_Pembangunan_Kota'];
                  $Nm_Prioritas_Pembangunan_Kota = $val_rpjmd['Nm_Prioritas_Pembangunan_Kota'];
                ?>
                  <option value="<?= $Kd_Prioritas_Pembangunan_Kota ?>"><?= ucfirst($Nm_Prioritas_Pembangunan_Kota) ?></option>
                <?php
                endforeach;
              ?>
            </select>
          </div>
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

<!-- Modal -->
<div class="modal fade" id="modal_revisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Usulan Direvisi</h4>
      </div>
      <div class="modal-body">
        <form id="form-revisi">
          <input type="hidden" id="kd_usulan_direvisi" name="Kd_Ta_Musrenbang_Kelurahan_Verifikasi">
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" name="Keterangan" rows="3"></textarea>
          </div>
        </form>
        *) Berikan penjelasan yang harus di perbaiki dusun/lingkungan
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="btn-simpan-revisi">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_tolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Usulan Ditolak</h4>
      </div>
      <div class="modal-body">
        <form id="form-tolak">
          <input type="hidden" id="kd_usulan_ditolak" name="Kd_Ta_Musrenbang_Kelurahan_Verifikasi">
          <div class="form-group">
            <label for="prioritas">Prioritas Pembangunan</label>
            <select class="form-control" name="Kd_Prioritas_Pembangunan_Daerah">
              <?php
                foreach ($rpjmd as $key => $val_rpjmd) :
                  $Kd_Prioritas_Pembangunan_Kota = $val_rpjmd['Kd_Prioritas_Pembangunan_Kota'];
                  $Nm_Prioritas_Pembangunan_Kota = $val_rpjmd['Nm_Prioritas_Pembangunan_Kota'];
                ?>
                  <option value="<?= $Kd_Prioritas_Pembangunan_Kota ?>"><?= ucfirst($Nm_Prioritas_Pembangunan_Kota) ?></option>
                <?php
                endforeach;
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" name="Keterangan" rows="3"></textarea>
          </div>
        </form>
        *) Berikan alasan mengapa usulan ditolak
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="btn-simpan-tolak">Simpan</button>
      </div>
    </div>
  </div>
</div>