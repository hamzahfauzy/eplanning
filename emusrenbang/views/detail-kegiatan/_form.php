<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailKegiatan */
/* @var $form yii\widgets\ActiveForm */
$sumber=$this->context->getAllSumber();
?>

<div class="detail-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode_kegiatan')->hiddenInput(['value'=>$id])->label('') ?>

    <?php //$form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagu')->textInput()->Label('Pagu (Juta)'); ?>

    <?= $form->field($model, 'sumber')->dropDownList($sumber, ['prompt'=>'Pilih Sumber'])?>

    <?= $form->field($model, 'catatan')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'prakiraan_target')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'prakiraan_pagu')->textInput() ?>

    <?php //$form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'kode_skpd')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'create_at')->textInput() ?>

    <?php //$form->field($model, 'save_status')->textInput(['maxlength' => true]) ?>
    <?php
    //$dataK=array('Bencana'=>'Bencana', 'Tenaga Kerja'=>'Tenaga Kerja');
    ?>
    <?php //$form->field($model, 'kategori')->dropDownList($dataK,['prompt'=>'Pilih Kategori Resposif Gender']) ?>

    <?php //$form->field($model, 'file')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'map')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
