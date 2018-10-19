<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb */
/* @var $form yii\widgets\ActiveForm */
$this->registerCSSFile(
    '@web/css/tabel_style.css',
    ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]
);

/*
$this->registerJsFile(
    '@web/js/drepdrop-satuan.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Asb2=array();
$Kd_Asb3=array();
$Kd_Asb4=array();
*/

$this->registerJsFile(
    '@web/js/form_hspk_asb.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/*
$this->registerJsFile(
    '@web/js/getasal.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
    $Asal=array();
    $dataSH=array();
    $Kd_Ssh2=array();
    $Kd_Ssh3=array();
    $Kd_Ssh4=array();
    $Kd_Ssh5=array();
    $Kd_Ssh6=array();

    $Kd_Hspk2=array();
    $Kd_Hspk3=array();
    $Kd_Hspk4=array();
    $dataHarga=array();
    $dataKdsatuan=array();
*/
?>

<div class="ref-asb-form">
  <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-md-2">
        <?= $form->field($model, 'Kd_Asb1')->dropDownList($dataAsb, ['prompt'=>'Pilih ASB1', 'id'=>'Kd_Asb1']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($model, 'Kd_Asb2')->dropDownList($Data_Asb2, ['prompt'=>'Pilih ASB2', 'id'=>'Kd_Asb2']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($model, 'Kd_Asb3')->dropDownList($Data_Asb3, ['prompt'=>'Pilih ASB3', 'id'=>'Kd_Asb3']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($model, 'Kd_Asb4')->dropDownList($Data_Asb4, ['prompt'=>'Pilih ASB4', 'id'=>'Kd_Asb4']) ?>
      </div>

      <div class="col-md-2">
        <?= $form->field($model, 'Kd_Asb5')->textInput(['id' => 'Kd_Asb5']) ?>
      </div>

      <div class="col-md-6">
        <?= $form->field($model, 'Jenis_Pekerjaan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Satuan')->dropDownList($Kd_Satuan, ['prompt'=>'Pilih Satuan', 'id'=>'Kd_Satuan', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($model, 'Harga')->textInput(['id'=>'harga_asb', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>

    </div> <!-- akhir row-->

    <hr/>

    <div class="row">
      <div class="col-md-3">  
        <?= $form->field($model2, 'Kategori_Pekerjaan')->dropDownList($Kategori_Pekerjaan, ['prompt'=>'-Pilih Kategori Pekerjaan-', 'id'=>'Kategori_Pekerjaan']) ?>
        <input type="hidden" name="Kategori_Pekerjaan_Nama" id="Kategori_Pekerjaan_Nama">
      </div>
      
      <div class="col-md-3">  
        <!--- //$form->field($model2, 'Asal')->dropDownList(['1' => 'SSH', '2' => 'HSPK', '3' => 'ASB'], ['prompt'=>'-Pilih Asal-', 'id'=>'Asal']) -->
      
        <?= $form->field($model2, 'Asal')->dropDownList(['1' => 'SSH', '2' => 'HSPK'], ['prompt'=>'-Pilih Asal-', 'id'=>'Asal']) ?>
      </div>
    </div> <!-- akhir row -->

    <div class="row" id="borang_wrap">
    </div> <!-- akhir row -->
    
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="tabel-wrap" id="wrap-data">
            <table class="tabel-hasil">
            </table>
          </div>
        </div>
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
//-----------------skrip asb1 - 3-------------------//
$('#Kd_Asb1').change(function(){
    var Kd_Asb1=$(this).val();
    $('#kdasb1').val(Kd_Asb1);
    //alert(Kd_Urusan);
    $.post('index.php?r=ajax/getasb2&Kd_Asb1='+Kd_Asb1, function(data){
        //alert(data);
        $('#Kd_Asb2').html(data);
    })
})

$('#Kd_Asb2').change(function(){
    var Kd_Asb1=$("#Kd_Asb1").val();
    var Kd_Asb2=$(this).val();
    $.post('index.php?r=ajax/getasb3&Kd_Asb1='+Kd_Asb1+'&Kd_Asb2='+Kd_Asb2, function(data){
        $('#Kd_Asb3').html(data);
    })
})

$('#Kd_Asb3').change(function(){
    var Kd_Asb1=$("#Kd_Asb1").val();
    var Kd_Asb2=$("#Kd_Asb2").val();
    var Kd_Asb3=$(this).val();
    $.post('index.php?r=ajax/getasb4&Kd_Asb1='+Kd_Asb1+
                                    '&Kd_Asb2='+Kd_Asb2+
                                    '&Kd_Asb3='+Kd_Asb3, function(data){
        $('#Kd_Asb4').html(data);
    })
})

$('#Kd_Asb4').change(function(){
    var Kd_Asb1=$('#Kd_Asb1').val();
    var Kd_Asb2=$('#Kd_Asb2').val();
    var Kd_Asb3=$('#Kd_Asb3').val();
    var Kd_Asb4=$(this).val();

    $.post('index.php?r=ajax/max-asb5&Kd_Asb1='+Kd_Asb1+
                                    '&Kd_Asb2='+Kd_Asb2+
                                    '&Kd_Asb3='+Kd_Asb3+
                                    '&Kd_Asb4='+Kd_Asb4+
                                    '&Kode1=<?= $model->Kd_Asb1.$model->Kd_Asb2.$model->Kd_Asb3.$model->Kd_Asb4 ?>'+'&Kode2=<?= $model->Kd_Asb5 ?>', function(data){
        $('#Kd_Asb5').val(data);
    })
})

//-----------------akhir skrip asb1 - 3-------------------//

//-----------------awal skrip sumber-------------------//
$("#Asal").change(function(){
  var Asal = $(this).val();
  //alert('index.php?r=ref-asb/get-form&Asal='+Asal);
  $.post('index.php?r=ref-asb/get-form&Asal='+Asal, function(data){
    $("#borang_wrap").html(data);
  })
});

$("#Kategori_Pekerjaan").change(function(){
  //alert($("#Kategori_Pekerjaan option:selected").text());
  $("#Kategori_Pekerjaan_Nama").val($("#Kategori_Pekerjaan option:selected").text());
});
//-----------------akhir skrip sumber-------------------//

//-----------------awal skrip sumber-------------------//
function get_data_cookie(){
  $.ajax({ 
    type: "GET",
    url: 'index.php?r=ajax/get-cookie',
    data: '',
    success: function(isi){
      $("#wrap-data").html(isi);
      var jumlah_hspk=$("#jumlah_hspk").html();
      $("#harga_asb").val(jumlah_hspk);
    },
    error: function(){
      $("#wrap-data").html('data-kosong');
    }
  });
}
get_data_cookie();
//-----------------akhir skrip sumber-------------------//
</script>