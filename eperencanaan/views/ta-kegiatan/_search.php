<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kegiatan-search">

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

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
