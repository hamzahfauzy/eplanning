<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\search\TaMusrenbangKelurahanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-musrenbang-kelurahan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Ta_Muserenbang_Kelurahan') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?= $form->field($model, 'Kd_Kab') ?>

    <?= $form->field($model, 'Kd_Kec') ?>

    <?php // echo $form->field($model, 'Kd_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Urut_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Lingkungan') ?>

    <?php // echo $form->field($model, 'Kd_Jalan') ?>

    <?php // echo $form->field($model, 'Kd_Urusan') ?>

    <?php // echo $form->field($model, 'Kd_Bidang') ?>

    <?php // echo $form->field($model, 'Kd_Prog') ?>

    <?php // echo $form->field($model, 'Kd_Keg') ?>

    <?php // echo $form->field($model, 'Nm_Permasalahan') ?>

    <?php // echo $form->field($model, 'Kd_Klasifikasi') ?>

    <?php // echo $form->field($model, 'Jenis_Usulan') ?>

    <?php // echo $form->field($model, 'Jumlah') ?>

    <?php // echo $form->field($model, 'Kd_Satuan') ?>

    <?php // echo $form->field($model, 'Harga_Satuan') ?>

    <?php // echo $form->field($model, 'Harga_Total') ?>

    <?php // echo $form->field($model, 'Kd_Sasaran') ?>

    <?php // echo $form->field($model, 'Tanggal') ?>

    <?php // echo $form->field($model, 'Kd_Status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
