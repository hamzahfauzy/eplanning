<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\search\TaMusrenbangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-musrenbang-search">

    <?php $form = ActiveForm::begin([   
        'action' => ['usulan-kecamatan'],
        'method' => 'get',
    ]); ?>
    
    <div class="row">
        <div class="col-md-8">
            <?php 
                echo $form->field($model, 'globalSearch', ['inputOptions' => ['placeholder' => 'Masukkan kata kunci', 'class' => 'form-control', 'autocomplete' => 'off']])->label(false) 
            ?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'Tahun') ?>

    <?php // $form->field($model, 'Kd_Prov') ?>

    <?php // $form->field($model, 'Kd_Kab') ?>

    <?php // $form->field($model, 'Kd_Kec') ?>

    <?php // echo $form->field($model, 'Kd_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Urut_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Lingkungan') ?>

    <?php // echo $form->field($model, 'Kd_Jalan') ?>

    <?php // echo $form->field($model, 'Kd_Urusan') ?>

    <?php // echo $form->field($model, 'Kd_Bidang') ?>

    <?php // echo $form->field($model, 'Kd_Prog') ?>

    <?php // echo $form->field($model, 'Kd_Keg') ?>

    <?php // echo $form->field($model, 'Kd_Unit') ?>

    <?php // echo $form->field($model, 'Kd_Sub') ?>

    <?php // echo $form->field($model, 'Kd_Pem') ?>

    <?php // echo $form->field($model, 'Nm_Permasalahan') ?>

    <?php // echo $form->field($model, 'Kd_Klasifikasi') ?>

    <?php // echo $form->field($model, 'Jenis_Usulan') ?>

    <?php // echo $form->field($model, 'Jumlah') ?>

    <?php // echo $form->field($model, 'Kd_Satuan') ?>

    <?php // echo $form->field($model, 'Harga_Satuan') ?>

    <?php // echo $form->field($model, 'Harga_Total') ?>

    <?php // echo $form->field($model, 'Kd_Sasaran') ?>

    <?php // echo $form->field($model, 'Detail_Lokasi') ?>

    <?php // echo $form->field($model, 'Latitute') ?>

    <?php // echo $form->field($model, 'Longitude') ?>

    <?php // echo $form->field($model, 'Tanggal') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'Status_Survey') ?>

    <?php // echo $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah') ?>

    <?php // echo $form->field($model, 'Skor') ?>

    <?php // echo $form->field($model, 'Rincian_Skor') ?>

    <?php // echo $form->field($model, 'Status_Usulan') ?>

    <?php // echo $form->field($model, 'Status_Penerimaan_Kelurahan') ?>

    <?php // echo $form->field($model, 'Alasan_Kelurahan') ?>

    <?php // echo $form->field($model, 'Status_Penerimaan_Kecamatan') ?>

    <?php // echo $form->field($model, 'Alasan_Kecamatan') ?>

    <?php // echo $form->field($model, 'Status_Penerimaan_Skpd') ?>

    <?php // echo $form->field($model, 'Alasan_Skpd') ?>

    <?php // echo $form->field($model, 'Status_Penerimaan_Kota') ?>

    <?php // echo $form->field($model, 'Alasan_Kota') ?>

    <?php // echo $form->field($model, 'Kd_User') ?>

    <?php // echo $form->field($model, 'Kd_Asal') ?>

    <?php // echo $form->field($model, 'Kd1') ?>

    <?php // echo $form->field($model, 'Kd2') ?>

    <?php // echo $form->field($model, 'Kd3') ?>

    <?php // echo $form->field($model, 'Kd4') ?>

    <?php // echo $form->field($model, 'Kd5') ?>

    <?php // echo $form->field($model, 'Kd6') ?>

    <?php // echo $form->field($model, 'Uraian_Usulan') ?>

    <?php // echo $form->field($model, 'Kd_Asal_Usulan') ?>

    <!-- <div class="form-group">
        <?php //Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?php //Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
