<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

// $this->registerJsFile(
//         '@web/js/sistem/kompilasi.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );

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
  <h4>Silahkan melakukan Kompilasi Usulan Lingkungan
  </h4>
    <i>Kompilasi Usulan berfungsi sebagai pengelompokkan usulan lingkungan. Ataupun Usulan dari kelurahan yang tidak mengakomodir usulan dari Lingkungan</i>          
        </div>

<div class="row">
  <div class="col-md-6 col-md-offset-3">
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

                    <?= 
                        $form->field($model, 'Kd_Urut_Kel')->dropdownList(
                           $kelurahan,
                            ['prompt'=>'Pilih Kelurahan', 'class' => 'form-control select2-allow-clear'])->label("Kelurahan");
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
  <!-- <div class="col-md-6">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">Usulan Dari Lingkungan</h3>
      </div>
      <div class="panel-body">
        <div class="control-wrap">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modal_usulan">Tambah</button>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Lingkungan</th>
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
  </div> -->
</div>

