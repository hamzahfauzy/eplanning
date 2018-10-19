<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-musrenbang-form">
 <div class="container">
  <div class="row">
    <div class="col-md-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->hiddenInput(['maxlength' => true])->label(false) ?>
    <?= $form->field($model, 'Kd_Prov')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Kd_Klasifikasi')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Tanggal')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Kd1')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Kd2')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Kd3')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Kd4')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Kd5')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Kd6')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Status_Usulan')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Rincian_Skor')->hiddenInput()->label(false)  ?>
    <?= $form->field($model, 'Status_Survey')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Status_Penerimaan_Kelurahan')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Alasan_Kelurahan')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Status_Penerimaan_Kecamatan')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Alasan_Kecamatan')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Status_Penerimaan_Skpd')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Alasan_Skpd')->hiddenInput()->label(false)  ?>
    <?= $form->field($model, 'Status_Penerimaan_Kota')->hiddenInput()->label(false)  ?>
    <?= $form->field($model, 'Alasan_Kota')->hiddenInput()->label(false)  ?>
    <?= $form->field($model, 'Kd_User')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Kd_Asal')->hiddenInput()->label(false) ?>


    <?= $form->field($model, 'Kd_Kab')->textInput()?>
    <?= $form->field($model, 'Kd_Kec')->textInput() ?>
    <?= $form->field($model, 'Kd_Kel')->textInput() ?>
    <?= $form->field($model, 'Kd_Urut_Kel')->textInput() ?>
    <?= $form->field($model, 'Kd_Lingkungan')->textInput() ?>
    <?= $form->field($model, 'Kd_Jalan')->textInput() ?>
    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>
    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>
    <?= $form->field($model, 'Kd_Prog')->textInput() ?>
    <?= $form->field($model, 'Kd_Keg')->textInput() ?>
    <?= $form->field($model, 'Kd_Unit')->textInput() ?>
    <?= $form->field($model, 'Kd_Pem')->textInput() ?>
    <?= $form->field($model, 'Nm_Permasalahan')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Jenis_Usulan')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Jumlah')->textInput() ?>
    <?= $form->field($model, 'Kd_Satuan')->textInput() ?>
    <?= $form->field($model, 'Harga_Satuan')->textInput() ?>
    <?= $form->field($model, 'Harga_Total')->textInput() ?>
    <?= $form->field($model, 'Kd_Sasaran')->textInput() ?>
    <?= $form->field($model, 'Detail_Lokasi')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Latitute')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Longitude')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Uraian_Usulan')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'Kd_Asal_Usulan')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'Skor')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
