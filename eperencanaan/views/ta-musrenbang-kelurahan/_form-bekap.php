<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefJalan;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahan */
/* @var $form yii\widgets\ActiveForm */


$this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>


<div class="row">
    <div class="col-md-12">
        <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                    <div class="ta-musrenbang-kelurahan-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab')->textInput() ?>

    <?= $form->field($model, 'Kd_Kec')->textInput() ?>

    <?= $form->field($model, 'Kd_Kel')->textInput() ?>

    <?= $form->field($model, 'Kd_Urut_Kel')->textInput() ?>

    <?= $form->field($model, 'Kd_Lingkungan')->textInput() ?> -->

    <?= $form->field($model, 'Kd_Jalan')->textInput() ?>

    <?= $form->field($model, 'Kd_Urusan', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Kd_Bidang', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Kd_Prog', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Kd_Keg', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Kd_Klasifikasi', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>
    <?= $form->field($model, 'Kd_Sasaran', ['options' => ['class' => 'form-group-hide']])->textInput(['value'=>'0'])->label(false); ?>


    <?= $form->field($model, 'Nm_Permasalahan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Jenis_Usulan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Jumlah')->textInput() ?>

    <!-- <?= $form->field($model, 'Kd_Satuan')->textInput() ?> -->

    <?= 
    $form->field($model, 'Kd_Satuan')->dropdownList(
    $NASsatuan,
        ['prompt'=>'Pilih Satuan', 'class' => 'form-control select2-allow-clear'])
     ?>
                    

    <?= $form->field($model, 'Harga_Satuan')->textInput(['maxlength' => true, 'class' => 'form-control nomor hitung', 'id' => 'harga', 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'Harga_Total')->textInput(['maxlength' => true, 'class' => 'form-control nomor', 'id' => 'total', 'readonly' => true]) ?>

     <div class="form-group required">
                        <label class="control-label col-sm-3" for="total"></label>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-warning" title="Tambahkan Jalan Jika Belum ada" data-toggle="modal" data-target="#modal_jalan">Tambah Jalan</button>
                            *) Tambahkan Jalan Bila Tidak ditemukan
                        </div>
                    </div>

     <?php
                    $dl_jalan = Yii::$app->levelcomponent->getKelompok();
                    echo $form->field($model, 'Kd_Jalan')->dropdownList(
                            ArrayHelper::map(RefJalan::find()->orderBy('Nm_Jalan')->where(
                                            [ 'Kd_Prov' => $dl_jalan->Kd_Prov,
                                                'Kd_Kab' => $dl_jalan->Kd_Kab,
                                                'Kd_Kec' => $dl_jalan->Kd_Kec,
                                                'Kd_Kel' => $dl_jalan->Kd_Kel,
                                                'Kd_Urut_Kel' => $dl_jalan->Kd_Urut_Kel,
                                                'Kd_Lingkungan'=>$dl_jalan->Kd_Lingkungan]
                                    )->all(), 'Kd_Jalan', 'Nm_Jalan'), ['prompt' => 'Pilih Jalan', 'class' => 'form-control select2-allow-clear'])
                    ?>


                          
    <!-- <?= $form->field($model, 'Tanggal')->textInput() ?> -->

    <!-- <?= $form->field($model, 'Kd_Status')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div> 
    </div>       
</div>
