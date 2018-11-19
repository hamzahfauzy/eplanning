<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\search\TaPokirAcaraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-pokir-acara-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_User') ?>

    <?= $form->field($model, 'Waktu_Unduh_Absen') ?>

    <?= $form->field($model, 'Waktu_Unduh_Berita_Acara') ?>

    <?= $form->field($model, 'Waktu_Mulai') ?>

    <?php // echo $form->field($model, 'Waktu_Selesai') ?>

    <?php // echo $form->field($model, 'Masa_Reses') ?>

    <?php // echo $form->field($model, 'Nama_Tempat') ?>

    <?php // echo $form->field($model, 'Nama_Tempat2') ?>

    <?php // echo $form->field($model, 'Nama_Tempat3') ?>

    <?php // echo $form->field($model, 'Alamat') ?>

    <?php // echo $form->field($model, 'Jumlah_Peserta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
