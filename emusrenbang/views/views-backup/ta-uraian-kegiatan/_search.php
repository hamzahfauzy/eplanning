<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaUraianKegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-uraian-kegiatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?= $form->field($model, 'Kd_Unit') ?>

    <?= $form->field($model, 'Kd_Prog') ?>

    <?php // echo $form->field($model, 'Kd_Keg') ?>

    <?php // echo $form->field($model, 'lokasi_Kegiatan') ?>

    <?php // echo $form->field($model, 'kelompok_sasaran') ?>

    <?php // echo $form->field($model, 'waktu_pelaksanaan') ?>

    <?php // echo $form->field($model, 'status_kegiatan') ?>

    <?php // echo $form->field($model, 'pagu') ?>

    <?php // echo $form->field($model, 'sumber_dana') ?>

    <?php // echo $form->field($model, 'DAK') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'username') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
