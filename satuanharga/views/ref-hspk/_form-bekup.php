<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\base\DynamicModel;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk */
/* @var $form yii\widgets\ActiveForm */


$this->registerJsFile(
    '@web/js/skrip-hspk.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);


$Kd_Hspk2=array();
$Kd_Hspk3=array();
?>

<div class="ref-hspk-form">
  <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Hspk1')->dropDownList($dataHspk, ['prompt'=>'Pilih HSPK', 'id'=>'Kd_Hspk1', 'class'=>'form-control input-sm']) ?>
      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Hspk2')->dropDownList($Kd_Hspk2, ['prompt'=>'Pilih HSPK 2', 'id'=>'Kd_Hspk2', 'class'=>'form-control input-sm']) ?>
      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Hspk3')->dropDownList($Kd_Hspk3, ['prompt'=>'Pilih HSPK 3', 'id'=>'Kd_Hspk3', 'class'=>'form-control input-sm']) ?> 
      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Hspk4')->textInput(['readonly' => true, 'id'=>'Kd_Hspk4', 'class'=>'form-control input-sm']) ?>
      </div>
      <div class="col-md-6">
        <?= $form->field($model, 'Uraian_Kegiatan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Satuan')->dropDownList($dataSatuan, ['prompt'=>'Pilih Satuan', 'id'=>'Kd_Satuan', 'class'=>'form-control input-sm']) ?>
      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'Harga')->textInput(['id'=>'harga_hspk', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>
    </div><!-- end of row -->
    <hr/>
    <div class="row">
      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Kd_Ssh1')->dropDownList($dataSsh, ['prompt'=>'Pilih SSH1', 'id'=>'Kd_Ssh1', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Kd_Ssh2')->dropDownList([], ['prompt'=>'Pilih SSH2', 'id'=>'Kd_Ssh2', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Kd_Ssh3')->dropDownList([], ['prompt'=>'Pilih SSH3', 'id'=>'Kd_Ssh3', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Kd_Ssh4')->dropDownList([], ['prompt'=>'Pilih SSH4', 'id'=>'Kd_Ssh4', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Kd_Ssh5')->dropDownList([], ['prompt'=>'Pilih SSH5', 'id'=>'Kd_Ssh5', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Kd_Ssh6')->dropDownList([], ['prompt'=>'Pilih SSH6', 'id'=>'Kd_Ssh6', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label" for="refhspk-uraian_kegiatan">Satuan</label>
          <input class="form-control input-sm" id="satuan-ssh" readonly>
        </div>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Harga_Satuan')->textInput(['id'=>'harga-ssh', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>
      
      <div class="col-md-3" style="display: none">
        <?= $form->field($modelanak[0], 'Kd_Satuan')->hiddenInput(['id'=>'kdsatuan-ssh', 'readonly'=>true, 'class'=>'form-control input-sm'])->label(false) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Koefisien')->textInput(['id'=>'koefisien', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak[0], 'Harga')->textInput(['id'=>'harga', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>
    </div>
  	<?php if (!Yii::$app->request->isAjax){ ?>
  	  	<div class="form-group">
  	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  	    </div>
  	<?php } ?>

  <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
  /*
  $("#Kd_Hspk3").change(function(){
    var Kd_Hspk1 = $("#Kd_Hspk1").val();
    var Kd_Hspk2 = $("#Kd_Hspk2").val();
    var Kd_Hspk3 = $("#Kd_Hspk3").val();

    $("#Kd_Hspk4").val(Kd_Hspk1+Kd_Hspk2+Kd_Hspk3);
  });
  */
  $("#Kd_Hspk3").change(function(){
    var Kd_Hspk1 = $("#Kd_Hspk1").val();
    var Kd_Hspk2 = $("#Kd_Hspk2").val();
    var Kd_Hspk3 = $("#Kd_Hspk3").val();
    $.ajax({ 
      type: "GET",
      url:'index.php?r=ref-hspk/get-nomor',
      data:{Kd_Hspk1:Kd_Hspk1, Kd_Hspk2:Kd_Hspk2, Kd_Hspk3:Kd_Hspk3},
      success: function(isi){
        $("#Kd_Hspk4").val(isi);
      },
      error: function(){
        alert("failure");
      }
    });
  });

  $('#Kd_Ssh1').change(function(){
      var Kd_Ssh1=$(this).val();
      //alert(Kd_Urusan);
      $.post('index.php?r=ajax/getssh2&Kd_Ssh1='+Kd_Ssh1, function(data){
          //alert(data);
          $('#Kd_Ssh2').html(data);
      })
  })

  $('#Kd_Ssh2').change(function(){
      var Kd_Ssh1=$("#Kd_Ssh1").val();
      var Kd_Ssh2=$(this).val();
      $.post('index.php?r=ajax/getssh3&Kd_Ssh1='+Kd_Ssh1+'&Kd_Ssh2='+Kd_Ssh2, function(data){
          $('#Kd_Ssh3').html(data);
      })
  })

  $('#Kd_Ssh3').change(function(){
      var Kd_Ssh1=$("#Kd_Ssh1").val();
      var Kd_Ssh2=$("#Kd_Ssh2").val();
      var Kd_Ssh3=$(this).val();
      $.post('index.php?r=ajax/getssh4&Kd_Ssh1='+Kd_Ssh1+
                                      '&Kd_Ssh2='+Kd_Ssh2+
                                      '&Kd_Ssh3='+Kd_Ssh3, function(data){
          $('#Kd_Ssh4').html(data);
      })
  })

  $('#Kd_Ssh4').change(function(){
      var Kd_Ssh1=$("#Kd_Ssh1").val();
      var Kd_Ssh2=$("#Kd_Ssh2").val();
      var Kd_Ssh3=$("#Kd_Ssh3").val();
      var Kd_Ssh4=$(this).val();
      $.post('index.php?r=ajax/getssh5&Kd_Ssh1='+Kd_Ssh1+
                                      '&Kd_Ssh2='+Kd_Ssh2+
                                      '&Kd_Ssh3='+Kd_Ssh3+
                                      '&Kd_Ssh4='+Kd_Ssh4, function(data){
          $('#Kd_Ssh5').html(data);
      })
  })

  $('#Kd_Ssh5').change(function(){
      var Kd_Ssh1=$("#Kd_Ssh1").val();
      var Kd_Ssh2=$("#Kd_Ssh2").val();
      var Kd_Ssh3=$("#Kd_Ssh3").val();
      var Kd_Ssh4=$("#Kd_Ssh4").val();
      var Kd_Ssh5=$(this).val();

      $.post('index.php?r=ajax/getssh6&Kd_Ssh1='+Kd_Ssh1+
                                      '&Kd_Ssh2='+Kd_Ssh2+
                                      '&Kd_Ssh3='+Kd_Ssh3+
                                      '&Kd_Ssh4='+Kd_Ssh4+
                                      '&Kd_Ssh5='+Kd_Ssh5, function(data){
          $('#Kd_Ssh6').html(data);
      })
  })

  $('#Kd_Ssh6').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$("#Kd_Ssh2").val();
    var Kd_Ssh3=$("#Kd_Ssh3").val();
    var Kd_Ssh4=$("#Kd_Ssh4").val();
    var Kd_Ssh5=$("#Kd_Ssh5").val();
    var Kd_Ssh6=$(this).val();
    $.post('index.php?r=ajax/get-info-ssh6&Kd_Ssh1='+Kd_Ssh1+
                                    '&Kd_Ssh2='+Kd_Ssh2+
                                    '&Kd_Ssh3='+Kd_Ssh3+
                                    '&Kd_Ssh4='+Kd_Ssh4+
                                    '&Kd_Ssh5='+Kd_Ssh5+
                                    '&Kd_Ssh6='+Kd_Ssh6, function(data){
        var ssh = data.split('|');
        $("#kdsatuan-ssh").val(ssh[1]);
        $("#satuan-ssh").val(ssh[2]);
        $("#harga-ssh").val(ssh[3]);
    })
  })

  $("#koefisien").keyup(function(){
    var harga_ssh = parseFloat($("#harga-ssh").val());
    var koefisien = parseFloat($("#koefisien").val()); 

    var harga = harga_ssh*koefisien;
    $("#harga").val(harga); 
  });
  //harga-ssh
  //koefisien
  //harga
</script>