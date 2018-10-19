<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaUraianKegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-uraian-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Prog')->textInput() ?>

    <?= $form->field($model, 'Kd_Keg')->textInput() ?>

    <?= $form->field($model, 'lokasi_Kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kelompok_sasaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu_pelaksanaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagu')->textInput() ?>

    <?= $form->field($model, 'sumber_dana')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DAK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
