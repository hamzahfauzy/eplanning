<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->registerJsFile(
        '@web/js/sistem/kompilasi.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/jquery.number.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

// Register tooltip/popover initialization javascript
$this->registerJsFile(
        '@web/js/sistem/menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/css/sistem/menu.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="alert alert-info">
  <h4>Silahkan melakukan Kompilasi Usulan Dusun/Lingkungan
  </h4>
    <i>Kompilasi Usulan berfungsi sebagai pengelompokkan usulan dusun/lingkungan. Ataupun Usulan dari desa/kelurahan yang tidak mengakomodir usulan dari Dusun/Lingkungan</i>          
        </div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Usulan</h3>
      </div>
      <div class="panel-body">
        <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                    <?php $form = ActiveForm::begin(['layout' => 'horizontal']) ?>

                    <?= $form->field($model, 'Kd_Urusan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                    
                    <?= $form->field($model, 'Kd_Bidang', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                    
                    <?= $form->field($model, 'Kd_Prog', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                    
                    <?= $form->field($model, 'Kd_Keg', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                    
                    <?= $form->field($model, 'Kd_Klasifikasi', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                    
                    <?= $form->field($model, 'Kd_Sasaran', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                    
                    <?= $form->field($model, 'Status_Usulan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                    
                    <?= $form->field($model, 'Status_Pembahasan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
                    
                    <?= $form->field($model, 'Kd_Lingkungan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>

                    <?= $form->field($model, 'Nm_Permasalahan')->textarea(['maxlength' => true])->label("Nama Permasalahan"); ?>
                    
                    <?= $form->field($model, 'Jenis_Usulan')->textarea(['maxlength' => true]) ?>
                    
                    <?= $form->field($model, 'Kd_Pem')->radioList($NASbidangpem)->label("Bidang Pembangunan"); ?>

                    <?= 
                        $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah')->dropdownList(
                           $NASrpjmd,
                            ['prompt'=>'Pilih Prioritas', 'class' => 'form-control select2-allow-clear'])->label("Prioritas Pembangunan Daerah");
                    ?>

                    <?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true, 'class' => 'form-control hitung', 'id' => 'jumlah', 'autocomplete' => 'off']) ?> <!--jumlahnya di pengaruhi oleh get_usulan_pilih() di kompilasi.js -->
                    
                    <?= 
                        $form->field($model, 'Kd_Satuan')->dropdownList(
                           $NASsatuan,
                            ['prompt'=>'Pilih Satuan', 'class' => 'form-control select2-allow-clear', 'id' => 'satuan'])->label("Satuan");
                    ?>

                    <?= $form->field($model, 'Harga_Satuan')->textInput(['maxlength' => true, 'class' => 'form-control nomor hitung', 'id' => 'harga', 'autocomplete' => 'off']) ?>

                    <?= $form->field($model, 'Harga_Total')->textInput(['maxlength' => true, 'class' => 'form-control nomor', 'id' => 'total', 'readonly' => true]) ?>
                    
                    <!--
                    <div class="form-group required">
                        <label class="control-label col-sm-3" for="total"></label>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-warning" title="Tambahkan Jalan Jika Belum ada" data-toggle="modal" data-target="#modal_jalan">Tambah Jalan</button>
                            *) Tambahkan Jalan Bila Tidak ditemukan
                        </div>
                    </div>
                    -->
                    <?php
                      /*
                        $dl_jalan = Yii::$app->levelcomponent->getKelompok();
                        echo $form->field($model, 'Kd_Jalan')->dropdownList(
                            $jalan, 
                            ['prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])->label("Jalan");
                      */
                    ?>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
       
    
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Usulan Dari Dusun/Lingkungan</h3>
      </div>
      <div class="panel-body">
        <div class="control-wrap">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modal_usulan">Tambah</button>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Dusun/Lingkungan</th>
              <th>Usulan</th>
              <th>Jumlah</th>
              <th>Satuan</th>
              <th>Biaya</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody id="usulan_terpilih"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_usulan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Usulan Dusun/Lingkungan(<span id="sisa-usulan"></span>)</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-3">
              <select class="form-control" id="select-lingkungan">
                <option value="0">-Dusun/Lingkungan-</option>
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
            <div class="col-md-3">
              <select class="form-control" id="select-bidpem">
                <option value="0">-Bidang Pembangunan-</option>
                <?php
                  foreach ($NASbidangpem as $key => $value) :
                    ?>
                      <option value="<?= $key ?>"><?= $value ?></option>
                    <?php
                  endforeach;
                ?>
              </select>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" id="cari-permasalahan" placeholder="Permasalahan">
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" id="cari-usulan" placeholder="Usulan">
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary" id="btn-cari-usulan">Cari</button>
            </div>
          </div>
        </form>
        <table class="table table-bordered data-table tabel-data">
          <thead>
            <tr>
                <th>
                    No
                </th>
                <th>
                    Dusun/Lingkungan
                </th>
                <th>
                    Usulan
                </th>
                <th>
                    Jumlah
                </th>
                <th>
                    Satuan
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
            </tr>
          </thead>
          <tbody id="body-tabel"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>