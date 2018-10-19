<?php
use yii\helpers\Html;
?>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode HSPK 1</label>
    <?= Html::dropDownList('kd1', null, $data,[
          'prompt' => '-Pilih-',
          'id' => 'Kd_Hspk1',
          'class' => 'form-control input-sm',
        ]) 
    ?>
  </div>
</div>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode HSPK 2</label>
    <?= Html::dropDownList('kd2', null, [],[
          'id' => 'Kd_Hspk2',
          'class' => 'form-control input-sm',
        ]) 
    ?>
  </div>
</div>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode HSPK 3</label>
    <?= Html::dropDownList('kd3', null, [],[
          'id' => 'Kd_Hspk3',
          'class' => 'form-control input-sm',
        ]) 
    ?>
  </div>
</div>
<div class="col-md-2">
  <div class="form-group">
    <label>Kode HSPK 4</label>
    <?= Html::dropDownList('kd4', null, [],[
          'id' => 'Kd_Hspk4',
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
$('#Kd_Hspk1').change(function(){
    var Kd_Hspk1=$(this).val();
    //alert(Kd_Urusan);
    $.post('index.php?r=ajax/gethspk2&Kd_Hspk1='+Kd_Hspk1, function(data){
        //alert(data);
        $('#Kd_Hspk2').html(data);
    })
})

$('#Kd_Hspk2').change(function(){
    var Kd_Hspk1=$("#Kd_Hspk1").val();
    var Kd_Hspk2=$(this).val();

    $.post('index.php?r=ajax/gethspk3&Kd_Hspk1='+Kd_Hspk1+'&Kd_Hspk2='+Kd_Hspk2, function(data){
        $('#Kd_Hspk3').html(data);
    })
})

$('#Kd_Hspk3').change(function(){
    var Kd_Hspk1=$("#Kd_Hspk1").val();
    var Kd_Hspk2=$("#Kd_Hspk2").val();
    var Kd_Hspk3=$(this).val();

    $.post('index.php?r=ajax/gethspk4&Kd_Hspk1='+Kd_Hspk1+'&Kd_Hspk2='+Kd_Hspk3+'&Kd_Hspk3='+Kd_Hspk3, function(data){
        $('#Kd_Hspk4').html(data);
    })
})

$('#Kd_Hspk4').change(function(){
    var Kd_Hspk1=$("#Kd_Hspk1").val();
    var Kd_Hspk2=$("#Kd_Hspk2").val();
    var Kd_Hspk3=$("#Kd_Hspk3").val();
    var Kd_Hspk4=$(this).val();
    $.post('index.php?r=ajax/get-info-hspk4&Kd_Hspk1='+Kd_Hspk1+
                                  '&Kd_Hspk2='+Kd_Hspk2+
                                  '&Kd_Hspk3='+Kd_Hspk3+
                                  '&Kd_Hspk4='+Kd_Hspk4, function(data){
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