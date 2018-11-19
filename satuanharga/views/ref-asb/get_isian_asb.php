<?php
use yii\helpers\Html;
?>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode Asb 1</label>
    <?= Html::dropDownList('kd1', null, $data,[
          'prompt' => '-Pilih-',
          'id' => 'Kd_Asb1s',
          'class' => 'form-control input-sm',
        ]) 
    ?>
  </div>
</div>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode Asb 2</label>
    <?= Html::dropDownList('kd2', null, [],[
          'id' => 'Kd_Asb2s',
          'class' => 'form-control input-sm',
        ]) 
    ?>
  </div>
</div>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode Asb 3</label>
    <?= Html::dropDownList('kd3', null, [],[
          'id' => 'Kd_Asb3s',
          'class' => 'form-control input-sm',
        ]) 
    ?>
  </div>
</div>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode Asb 4</label>
    <?= Html::dropDownList('kd4', null, [],[
          'id' => 'Kd_Asb4s',
          'class' => 'form-control input-sm',
        ]) 
    ?>
  </div>
</div>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode Asb 5</label>
    <?= Html::dropDownList('kd5', null, [],[
          'id' => 'Kd_Asb5s',
          'class' => 'form-control input-sm',
        ]) 
    ?>
  </div>
</div>
<div class="clearfix"></div>
<!--
<div class="col-md-2">
  <div class="form-group">
    <label class="control-label" >&nbsp;</label>
    <input class="form-control input-sm" name="kd5" value="0" >
  </div>
</div>
<div class="col-md-2">
  <div class="form-group">
    <label class="control-label" >&nbsp;</label>
    <input class="form-control input-sm" name="kd6" value="0" >
  </div>
</div>
-->
<div class="col-md-3">
  <div class="form-group">
    <label class="control-label" >Satuan</label>
    <input class="form-control input-sm" name="Satuan" id="satuan-ssh" readonly>
  </div>
</div>

<div class="col-md-3">
  <div class="form-group">
    <label class="control-label" >Harga Satuan</label>
    <input class="form-control input-sm" name="Harga_Satuan" id="harga-ssh" readonly>
  </div>
</div>

<div class="col-md-3">
  <div class="form-group">
    <label class="control-label" >Koefisien</label>
    <input class="form-control input-sm" name="Koefisien" id="koefisien">
  </div>
</div>

<div class="col-md-3">
  <div class="form-group">
    <label class="control-label" >Harga</label>
    <input class="form-control input-sm" name="Harga" id="harga" readonly>
  </div>
</div>

<input type="hidden" id="uraian-ssh" name="Uraian">
<input type="hidden" id="kdsatuan-ssh" name="Kd_Satuan">

<div class="col-md-4 col-md-offset-4">
  <div class="form-group">
    <label class="control-label">&nbsp;</label>
    <button type="button" id="btn-tambah-cookie" class="form-control btn btn-warning input-sm" >Tambah</button>
  </div>
</div>



<script type="text/javascript">

$('#Kd_Asb1s').change(function(){
    var Kd_Asb1=$(this).val();
    //alert('index.php?r=ajax/getasb2&Kd_Asb1='+Kd_Asb1);
    $.post('index.php?r=ajax/getasb2&Kd_Asb1='+Kd_Asb1, function(data){
        //alert(data);
        $('#Kd_Asb2s').html(data);
    })
})

$('#Kd_Asb2s').change(function(){
    var Kd_Asb1=$("#Kd_Asb1s").val();
    var Kd_Asb2=$(this).val();
    $.post('index.php?r=ajax/getasb3&Kd_Asb1='+Kd_Asb1+'&Kd_Asb2='+Kd_Asb2, function(data){
        $('#Kd_Asb3s').html(data);
    })
})

$('#Kd_Asb3s').change(function(){
    var Kd_Asb1=$("#Kd_Asb1s").val();
    var Kd_Asb2=$("#Kd_Asb2s").val();
    var Kd_Asb3=$(this).val();
    $.post('index.php?r=ajax/getasb4&Kd_Asb1='+Kd_Asb1+
                                    '&Kd_Asb2='+Kd_Asb2+
                                    '&Kd_Asb3='+Kd_Asb3, function(data){
        $('#Kd_Asb4s').html(data);
    })
})

$('#Kd_Asb4s').change(function(){
    var Kd_Asb1=$("#Kd_Asb1s").val();
    var Kd_Asb2=$("#Kd_Asb2s").val();
    var Kd_Asb3=$("#Kd_Asb3s").val();
    var Kd_Asb4=$(this).val();
    $.post('index.php?r=ajax/getasb5&Kd_Asb1='+Kd_Asb1+
                                    '&Kd_Asb2='+Kd_Asb2+
                                    '&Kd_Asb3='+Kd_Asb3+
                                    '&Kd_Asb4='+Kd_Asb4, function(data){
        $('#Kd_Asb5s').html(data);
    })
})

$('#Kd_Asb5s').change(function(){
    var Kd_Asb1=$("#Kd_Asb1s").val();
    var Kd_Asb2=$("#Kd_Asb2s").val();
    var Kd_Asb3=$("#Kd_Asb3s").val();
    var Kd_Asb4=$("#Kd_Asb4s").val();
    var Kd_Asb5=$(this).val();
    $.post('index.php?r=ajax/get-info-asb&Kd_Asb1='+Kd_Asb1+
                                    '&Kd_Asb2='+Kd_Asb2+
                                    '&Kd_Asb3='+Kd_Asb3+
                                    '&Kd_Asb4='+Kd_Asb4+
                                    '&Kd_Asb5='+Kd_Asb5, function(data){
      var ssh = data.split('|');
      $("#uraian-ssh").val(ssh[0]);
      $("#kdsatuan-ssh").val(ssh[1]);
      $("#satuan-ssh").val(ssh[2]);
      $("#harga-ssh").val(ssh[3]);
      $("#koefisien").val(0);
      $("#harga").val(0);
  })
})

$("#koefisien").keyup(function(){
  var harga_ssh = parseFloat($("#harga-ssh").val());
  var koefisien = parseFloat($("#koefisien").val()); 

  var harga = harga_ssh*koefisien;
  $("#harga").val(harga); 
});



$("#btn-tambah-cookie").click(function(){
  //alert('index.php?r=ref-hspk/set-cookie');
  $.ajax({ 
    type: "POST",
    url:'index.php?r=ajax/set-cookie',
    data:$("#w0").serialize(),
    success: function(isi){
      alert(isi);
      get_data_cookie();
    },
    error: function(){
      alert("failure1");
    }
  });
});
</script>