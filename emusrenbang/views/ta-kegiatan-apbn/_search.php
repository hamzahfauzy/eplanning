<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\search\TaKegiatanApbnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kegiatan-apbn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?= $form->field($model, 'Kd_Prog') ?>

    <?= $form->field($model, 'Kd_Keg') ?>

    <?php // echo $form->field($model, 'Kd_Unit') ?>

    <?php // echo $form->field($model, 'Kd_Sub') ?>

    <?php // echo $form->field($model, 'ID_Prog') ?>

    <?php // echo $form->field($model, 'Ket_Kegiatan') ?>

    <?php // echo $form->field($model, 'Lokasi') ?>

    <?php // echo $form->field($model, 'Kelompok_Sasaran') ?>

    <?php // echo $form->field($model, 'Status_Kegiatan') ?>

    <?php // echo $form->field($model, 'Pagu_Anggaran') ?>

    <?php // echo $form->field($model, 'Waktu_Pelaksanaan') ?>

    <?php // echo $form->field($model, 'Kd_Sumber') ?>

    <?php // echo $form->field($model, 'Status') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <?php // echo $form->field($model, 'Pagu_Anggaran_Nt1') ?>

    <?php // echo $form->field($model, 'Verifikasi_Bappeda') ?>

    <?php // echo $form->field($model, 'Tanggal_Verifikasi_Bappeda') ?>

    <?php // echo $form->field($model, 'Keterangan_Verifikasi_Bappeda') ?>

    <?php // echo $form->field($model, 'Kd_Urusan_Prov') ?>

    <?php // echo $form->field($model, 'Kd_Bidang_Prov') ?>

    <?php // echo $form->field($model, 'Kd_Unit_Prov') ?>

    <?php // echo $form->field($model, 'Kd_Sub_Prov') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
