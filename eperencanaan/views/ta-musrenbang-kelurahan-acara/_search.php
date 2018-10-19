<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\search\TaMusrenbangKelurahanAcaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-musrenbang-kelurahan-acara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?= $form->field($model, 'Kd_Kab') ?>

    <?= $form->field($model, 'Kd_Kec') ?>

    <?= $form->field($model, 'Kd_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Urut_Kel') ?>

    <?php // echo $form->field($model, 'Waktu_Unduh_Absen') ?>

    <?php // echo $form->field($model, 'Waktu_Unduh_Berita_Acara') ?>

    <?php // echo $form->field($model, 'Waktu_Mulai') ?>

    <?php // echo $form->field($model, 'Waktu_Selesai') ?>

    <?php // echo $form->field($model, 'Nama_Tempat') ?>

    <?php // echo $form->field($model, 'Alamat') ?>

    <?php // echo $form->field($model, 'Nama_Pejabat') ?>

    <?php // echo $form->field($model, 'Jumlah_Peserta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
