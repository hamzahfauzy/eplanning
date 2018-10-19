<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailKegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_kegiatan')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagu')->textInput() ?>

    <?= $form->field($model, 'sumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prakiraan_target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prakiraan_pagu')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Draft' => 'Draft', 'Usul' => 'Usul', 'Verifikasi' => 'Verifikasi', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
