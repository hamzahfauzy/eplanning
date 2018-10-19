<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaKegiatanFileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kegiatan-file-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?= $form->field($model, 'Kd_Unit') ?>

    <?= $form->field($model, 'Kd_Sub') ?>

    <?php // echo $form->field($model, 'Kd_Prog') ?>

    <?php // echo $form->field($model, 'Kd_Keg') ?>

    <?php // echo $form->field($model, 'Nama_File') ?>

    <?php // echo $form->field($model, 'uploat_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
