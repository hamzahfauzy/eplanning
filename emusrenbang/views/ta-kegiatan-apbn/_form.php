<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaKegiatanApbn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kegiatan-apbn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Prog')->textInput() ?>

    <?= $form->field($model, 'Kd_Keg')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'ID_Prog')->textInput() ?>

    <?= $form->field($model, 'Ket_Kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kelompok_Sasaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Status_Kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Pagu_Anggaran')->textInput() ?>

    <?= $form->field($model, 'Waktu_Pelaksanaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Sumber')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'Keterangan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Pagu_Anggaran_Nt1')->textInput() ?>

    <?= $form->field($model, 'Verifikasi_Bappeda')->textInput() ?>

    <?= $form->field($model, 'Tanggal_Verifikasi_Bappeda')->textInput() ?>

    <?= $form->field($model, 'Keterangan_Verifikasi_Bappeda')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Kd_Urusan_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub_Prov')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
