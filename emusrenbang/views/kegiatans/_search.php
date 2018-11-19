<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatansSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kegiatans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode_kegiatan') ?>

    <?= $form->field($model, 'kode_program') ?>
    <?= $form->field($model, 'nama_program') ?>

    <?= $form->field($model, 'nama_kegiatan') ?>

    <?= $form->field($model, 'indikator') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'aktif') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
