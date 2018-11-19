<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/drepdrop-satuan.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Asb2=array();
$Kd_Asb3=array();
$Kd_Asb4=array();

$Kd_Ssh2=array();
$Kd_Ssh3=array();
$Kd_Ssh4=array();
$Kd_Ssh5=array();
$Kd_Ssh6=array();

$Asal=array();

?>

<div class="ref-asb-form">

    <?php $form = ActiveForm::begin(); ?>
 
  <div class="row">

  

      <div class="row">
      <div class="col-md-2">
      <?= $form->field($modelanak, 'Kd_Hspk_Ssh1')->dropDownList($dataSsh, ['prompt'=>'Pilih SSH1', 'id'=>'Kd_Ssh1', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Hspk_Ssh2')->dropDownList([], ['prompt'=>'Pilih SSH2', 'id'=>'Kd_Ssh2', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Hspk_Ssh3')->dropDownList([], ['prompt'=>'Pilih SSH3', 'id'=>'Kd_Ssh3', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Hspk_Ssh4')->dropDownList([], ['prompt'=>'Pilih SSH4', 'id'=>'Kd_Ssh4', 'class'=>'form-control input-sm']) ?>
      </div>


      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Ssh5')->dropDownList([], ['prompt'=>'Pilih SSH5', 'id'=>'Kd_Ssh5', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($modelanak, 'Kd_Ssh6')->dropDownList([], ['prompt'=>'Pilih SSH6', 'id'=>'Kd_Ssh6', 'class'=>'form-control input-sm']) ?>
      </div>
      </div>



    <div class="row">
    <div class="col-md-3">
        <div class="form-group">
          <label class="control-label" >Satuan</label>
          <input class="form-control input-sm" id="satuan-ssh" readonly>
        </div>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak, 'Harga_Satuan')->textInput(['id'=>'harga-ssh', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>

       <div class="col-md-3" style="display: none">
        <?= $form->field($modelanak, 'Kd_Satuan')->hiddenInput(['id'=>'kdsatuan-ssh', 'readonly'=>true, 'class'=>'form-control input-sm'])->label(false) ?>
      </div>

      <input type="hidden" id="uraian-ssh" name="uraian_ssh">
      <div class="col-md-3">
        <?= $form->field($modelanak, 'Koefisien')->textInput(['id'=>'koefisien', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak, 'Jumlah_Harga')->textInput(['id'=>'harga', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>

     </div>

       <?php ActiveForm::end(); ?>