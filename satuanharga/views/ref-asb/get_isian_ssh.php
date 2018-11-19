<?php
use yii\helpers\Html;
?>
<div class="col-md-2">
	<div class="form-group">
    <label>Kode SSH 1</label>
    <?= Html::dropDownList('kd1', null, $data,[
    			'prompt' => '-Pilih-',
    			'id' => 'Kd_Ssh1',
    			'class' => 'form-control',
    		]) 
    ?>
  </div>
</div>
<div class="col-md-2">
	<div class="form-group">
    <label>Kode SSH 2</label>
    <?= Html::dropDownList('kd2', null, [],[
    			'id' => 'Kd_Ssh2',
    			'class' => 'form-control',
    		]) 
    ?>
  </div>
</div>
<div class="col-md-2">
	<div class="form-group">
    <label>Kode SSH 3</label>
    <?= Html::dropDownList('kd3', null, [],[
    			'id' => 'Kd_Ssh3',
    			'class' => 'form-control',
    		]) 
    ?>
  </div>
</div>
<div class="col-md-2">
	<div class="form-group">
    <label>Kode SSH 4</label>
    <?= Html::dropDownList('kd4', null, [],[
    			'id' => 'Kd_Ssh4',
    			'class' => 'form-control',
    		]) 
    ?>
  </div>
</div>
<div class="col-md-2">
	<div class="form-group">
    <label>Kode SSH 5</label>
    <?= Html::dropDownList('kd5', null, [],[
    			'id' => 'Kd_Ssh5',
    			'class' => 'form-control',
    		]) 
    ?>
  </div>
</div>
<div class="col-md-2">
	<div class="form-group">
    <label>Kode SSH 6</label>
    <?= Html::dropDownList('kd6', null, [],[
    			'id' => 'Kd_Ssh6',
    			'class' => 'form-control',
    		]) 
    ?>
  </div>
</div>

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
$('#Kd_Ssh1').change(function(){
    var Kd_Ssh1=$(this).val();
    $.post('index.php?r=ajax/getssh2&Kd_Ssh1='+Kd_Ssh1, function(data){
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