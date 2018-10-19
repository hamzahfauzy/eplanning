<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/tambahusulankec.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$Kd_Sub = array();
$Kd_Bidang = array();


?>


 <div class="ta-musrenbang-form">



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->hiddenInput(['maxlength' => true, 'value'=>2017])->label(false) ?>

   <!--  <?= $form->field($model, 'Kd_Prov')->textInput() ?>
    <?= $form->field($model, 'Kd_Kab')->textInput() ?>
    <?= $form->field($model, 'Kd_Kec')->textInput() ?>
    <?= $form->field($model, 'Kd_Kel')->textInput() ?>
    <?= $form->field($model, 'Kd_Urut_Kel')->textInput() ?>
    <?= $form->field($model, 'Kd_Lingkungan')->textInput() ?>
    <?= $form->field($model, 'Kd_Jalan')->textInput() ?>
   
    
    <?= $form->field($model, 'Kd_Prog')->textInput() ?>
    <?= $form->field($model, 'Kd_Keg')->textInput() ?> -->
    
    <?= $form->field($model, 'Kd_Unit')->dropdownList($NASunit,
        ['prompt'=>'Pilih Unit', 'class' => 'form-control select2-allow-clear', 'id'=> 'Kd_Unit']); ?>
 
    <?= $form->field($model, 'Kd_Sub')->dropDownList($Kd_Sub, ['prompt'=>'Pilih Sub Unit', 'id'=>'Kd_Sub']); ?>
    <?= $form->field($model, 'Kd_Bidang')->dropDownList($Kd_Bidang, ['prompt'=>'Bidang', 'id'=>'Kd_Sub']); ?>

    <!-- <?= $form->field($model, 'Kd_Urusan')->textInput()?> -->
     

     <?= $form->field($model, 'Kd_Pem')->radioList($NASbidangpem)->label("Bidang Pembangunan"); ?>

    <?= 
    $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah')->dropdownList(
       $NASrpjmd,
        ['prompt'=>'Pilih Prioritas', 'class' => 'form-control select2-allow-clear'])->label("Prioritas Pembangunan Daerah");
    ?>

    <?= $form->field($model, 'Nm_Permasalahan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Kd_Klasifikasi')->radioList(['1' => 'Fisik', '2' => 'Non Fisik']); ?>

    <?= $form->field($model, 'Jenis_Usulan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Harga_Satuan')->textInput(['maxlength' => true, 'class' => 'form-control nomor hitung', 'id' => 'harga', 'autocomplete' => 'off']) ?>  

    <?= $form->field($model, 'Kd_Satuan')->dropdownList($NASsatuan,
        ['prompt'=>'Pilih Satuan', 'class' => 'form-control select2-allow-clear']);
    ?>

      <?= $form->field($model, 'Jumlah')->textInput(['maxlength' => true, 'class' => 'form-control hitung', 'id' => 'jumlah', 'autocomplete' => 'off']) ?>

       <?= $form->field($model, 'Harga_Total')->textInput(['maxlength' => true, 'class' => 'form-control nomor', 'id' => 'total', 'readonly' => true]) ?>

  <!--   <?= $form->field($model, 'Kd_Sasaran')->textInput() ?>
 -->
    <?= $form->field($model, 'Detail_Lokasi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Latitute')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Longitude')->textInput(['maxlength' => true]) ?>

   <!--  <?= $form->field($model, 'Tanggal')->textInput() ?> -->
   <!--  <?= $form->field($model, 'status')->textInput() ?>
    <?= $form->field($model, 'Status_Survey')->textInput() ?>
 -->
  <!--   <?= $form->field($model, 'Skor')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Rincian_Skor')->textarea(['rows' => 6]) ?> -->
<!--     <?= $form->field($model, 'Status_Usulan')->textInput() ?>
    <?= $form->field($model, 'Status_Penerimaan_Kelurahan')->dropDownList([ '0', '1', '2', '3', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'Alasan_Kelurahan')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Status_Penerimaan_Kecamatan')->dropDownList([ '0', '1', '2', '3', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'Alasan_Kecamatan')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Status_Penerimaan_Skpd')->dropDownList([ '0', '1', '2', '3', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'Alasan_Skpd')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Status_Penerimaan_Kota')->dropDownList([ '0', '1', '2', '3', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'Alasan_Kota')->textarea(['rows' => 6]) ?> -->
  <!--  <?= $form->field($model, 'Kd_User')->textInput() ?> -->
 <!--   <?= $form->field($model, 'Kd_Asal')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', ], ['prompt' => '']) ?>
 -->
 <!--    <?= $form->field($model, 'Kd1')->textInput() ?>
    <?= $form->field($model, 'Kd2')->textInput() ?>
    <?= $form->field($model, 'Kd3')->textInput() ?>
    <?= $form->field($model, 'Kd4')->textInput() ?>
    <?= $form->field($model, 'Kd5')->textInput() ?>
    <?= $form->field($model, 'Kd6')->textInput() ?> -->
    <?= $form->field($model, 'Uraian_Usulan')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Kd_Asal_Usulan')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

 </div>


