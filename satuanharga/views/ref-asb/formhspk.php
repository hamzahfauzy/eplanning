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
      <div class="col-md-2">

     <?= $form->field($model, 'Kd_Asb1')->dropDownList($dataAsb, ['prompt'=>'Pilih ASB1', 'id'=>'Kd_Asb1']) ?>
     </div>

     <div class="col-md-2">
    <?= $form->field($model, 'Kd_Asb2')->dropDownList($Kd_Asb2, ['prompt'=>'Pilih ASB2', 'id'=>'Kd_Asb2']) ?>
    </div>


     <div class="col-md-2">
     <?= $form->field($model, 'Kd_Asb3')->dropDownList($Kd_Asb3, ['prompt'=>'Pilih ASB3', 'id'=>'Kd_Asb3']) ?>
     </div>

     <div class="col-md-2">
      <?= $form->field($model, 'Kd_Asb4')->dropDownList($Kd_Asb4, ['prompt'=>'Pilih ASB4', 'id'=>'Kd_Asb4']) ?>
      </div>

    <div class="col-md-2">
    <?= $form->field($model, 'Kd_Asb5')->textInput(['readonly'=>false]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'Jenis_Pekerjaan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
      </div>

    </div>
    </div>

    <hr />

      <div class="row">

      <div class="col-md-3">  
   <?= $form->field($modelanak, 'Kategori_Pekerjaan')->dropDownList($dataKategori, ['prompt'=>'Kategori Pekerjaan', 'id'=>'Kategori_Pekerjaan']) ?>
   </div>

       <div class="col-md-3">  
   <?= $form->field($modelanak, 'Asal')->dropDownList(['1' => 'SSH', '2' => 'HSPK'], ['prompt'=>'Asal', 'id'=>'Asal']) ?>
   </div>
   </div>


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

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-warning' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
$("#koefisien").keyup(function(){
    var harga_ssh = parseFloat($("#harga-ssh").val());
    var koefisien = parseFloat($("#koefisien").val()); 

    var harga = harga_ssh*koefisien;
    $("#harga").val(harga); 
  });
  //harga-ssh
  //koefisien
  //harga

  function get_ssh(){
    $.ajax({ 
      type: "POST",
      url:'index.php?r=ref-hspk/get-cookie',
      data:'',
      success: function(isi){
        $("#wrap-ssh").html(isi);
      },
      error: function(){
        alert("failure");
      }
    });
  }
  get_ssh();

  $("#btn-tambah-ssh").click(function(){
    //alert('index.php?r=ref-hspk/set-cookie');
    $.ajax({ 
      type: "POST",
      url:'index.php?r=ref-hspk/set-cookie',
      data:$("#w0").serialize(),
      success: function(isi){
        alert(isi);
        get_ssh();
      },
      error: function(){
        alert("failure");
      }
    });
  });
</script>
