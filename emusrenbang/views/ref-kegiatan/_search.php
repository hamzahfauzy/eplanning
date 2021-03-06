<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefKegiatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kegiatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?= $form->field($model, 'Kd_Prog') ?>

    <?= $form->field($model, 'Kd_Keg') ?>

    <?= $form->field($model, 'Ket_Kegiatan') ?>
	    <?= $form->field($model, 'Indikator') ?>

    <?= $form->field($model, 'Pagu_Indikatif') ?>
    <?= $form->field($model, 'Tahun_Pertama') ?>
    <?= $form->field($model, 'Tahun_Kedua') ?>
    <?= $form->field($model, 'Tahun_Ketiga') ?>
    <?= $form->field($model, 'Tahun_Keempat') ?>
    <?= $form->field($model, 'Tahun_Klima') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
