<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\RefRekAset2;
use common\models\RefRekAset3;
use common\models\RefRekAset4;
use common\models\RefRekAset5;
use common\models\RefStandardHarga2;

/* @var $this yii\web\View */
/* @var $model common\models\TaHargaSatuanPokokKegiatan */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/drepdrop-aset.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Aset2=array();
$Kd_Aset3=array();
$Kd_Aset4=array();
$Kd_Aset5=array();

$this->registerJsFile(
    '@web/js/drepdrop-standardharga.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_2=array();
$Kd_3=array();

?>


<div class="ta-harga-satuan-pokok-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'Tahun')->hiddenInput(['value'=>'2016'])->label(false); ?>
    
    <?= $form->field($model, 'Kd_Benua')->hiddenInput(['value'=>'1'])->label(false); ?>
    
    <?= $form->field($model, 'Kd_Benua_Sub')->hiddenInput(['value'=>'4'])->label(false); ?>
    
    <?= $form->field($model, 'Kd_Benua_Sub_Negara')->hiddenInput(['value'=>'1'])->label(false); ?>
    
    <?= $form->field($model, 'Kd_Prov')->hiddenInput(['value'=>'12'])->label(false); ?>
    
    <?= $form->field($model, 'Kd_Kab')->hiddenInput(['value'=>'1'])->label(false); ?>

    <?= $form->field($model, 'Kd_Klasifikasi')->textInput() ?>
    
    <?= $form->field($model, 'Kd_Aset1')->dropDownList($Kd_Aset1, ['prompt'=>'Pilih Kd Aset1', 'id'=>'Kd_Aset1']) ?>

    <?= $form->field($model, 'Kd_Aset2')->dropDownList($Kd_Aset2, ['prompt'=>'Pilih Kd Aset2', 'id'=>'Kd_Aset2']) ?>

    <?= $form->field($model, 'Kd_Aset3')->dropDownList($Kd_Aset3, ['prompt'=>'Pilih Kd Aset3', 'id'=>'Kd_Aset3']) ?>

    <?= $form->field($model, 'Kd_Aset4')->dropDownList($Kd_Aset4, ['prompt'=>'Pilih Kd Aset4', 'id'=>'Kd_Aset4']) ?>

    <?= $form->field($model, 'Kd_Aset5')->dropDownList($Kd_Aset5, ['prompt'=>'Pilih Kd Aset5', 'id'=>'Kd_Aset5']) ?>
    
    <?= $form->field($model, 'Kd_1')->dropDownList($Kd_1, ['prompt'=>'Pilih Kd1', 'id'=>'Kd_1']) ?>

  <?= $form->field($model, 'Kd_2')->dropDownList($Kd_1, ['prompt'=>'Pilih Kd1', 'id'=>'Kd_2']) ?>

    <?= $form->field($model, 'Kd_Satuan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
