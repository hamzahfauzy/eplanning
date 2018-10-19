<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\base\DynamicModel;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/form_ssh_hspk.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/drepdrop-satuan.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
    '@web/css/tabel_style.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="ref-hspk-form">
  <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Hspk1')->dropDownList($dataHspk, ['prompt'=>'Pilih HSPK', 'id'=>'Kd_Hspk1', 'class'=>'form-control input-sm']) ?>
      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Hspk2')->dropDownList($dataHspk2, ['prompt'=>'Pilih HSPK 2', 'id'=>'Kd_Hspk2', 'class'=>'form-control input-sm']) ?>
      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'Kd_Hspk3')->dropDownList($dataHspk3, ['prompt'=>'Pilih HSPK 3', 'id'=>'Kd_Hspk3', 'class'=>'form-control input-sm']) ?> 
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
        <?= $form->field($model, 'Harga')->textInput(['id'=>'harga_hspk', 'readonly'=>true, 'class'=>'form-control input-sm', 'value'=>$harga]) ?>
      </div>
    </div><!-- end of row -->
    <hr/>
    <div class="row">
      <div class="col-md-3">
        <?= $form->field($modelanak, 'Kd_Ssh1')->dropDownList($dataSsh, ['prompt'=>'Pilih SSH1', 'id'=>'Kd_Ssh1', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak, 'Kd_Ssh2')->dropDownList([], ['prompt'=>'Pilih SSH2', 'id'=>'Kd_Ssh2', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak, 'Kd_Ssh3')->dropDownList([], ['prompt'=>'Pilih SSH3', 'id'=>'Kd_Ssh3', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak, 'Kd_Ssh4')->dropDownList([], ['prompt'=>'Pilih SSH4', 'id'=>'Kd_Ssh4', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak, 'Kd_Ssh5')->dropDownList([], ['prompt'=>'Pilih SSH5', 'id'=>'Kd_Ssh5', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <?= $form->field($modelanak, 'Kd_Ssh6')->dropDownList([], ['prompt'=>'Pilih SSH6', 'id'=>'Kd_Ssh6', 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label" >Satuan</label>
          <input class="form-control input-sm" name="satuan_ssh" id="satuan-ssh" readonly>
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
        <?= $form->field($modelanak, 'Harga')->textInput(['id'=>'harga', 'readonly'=>true, 'class'=>'form-control input-sm']) ?>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label">Kategori</label>
          <select class="form-control input-sm" name="kategori">
            <option value="1">Upah</option>
            <option value="2">Bahan / Material</option>
            <option value="3">Sewa Peralatan</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label class="control-label">&nbsp;</label>
          <button type="button" id="btn-tambah-ssh" class="form-control btn btn-warning input-sm" >Tambah</button>
        </div>
      </div>
    </div>
    <!-- melihat data yang di tambah -->
    <div class="row">
      <div class="tabel-wrap" id="wrap-ssh">
        <table class="tabel-hasil">
          <thead>
            <tr>
              <th>NOMOR</th>
              <th>URAIAN KEGIATAN</th>
              <th>KOEF.</th>
              <th>SAT</th>
              <th>HARGA SATUAN</th>
              <th>HARGA</th>
            </tr>
          </thead>
          <tbody>
            <tr><!-- kategori -->
              <td></td>
              <td class="kategori_pekerjaan">Upah:</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr><!-- jumlah ssh -->
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right text-bold">Jumlah</td>
              <td class="uang jumlah">0,00</td>
            </tr>
            <tr><!-- kategori -->
              <td></td>
              <td class="kategori_pekerjaan">Bahan/Material:</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right text-bold">Jumlah</td>
              <td class="uang jumlah">0,00</td>
            </tr>
            <tr><!-- kategori -->
              <td></td>
              <td class="kategori_pekerjaan">Sewa Peralatan:</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr><!-- jumlah ssh -->
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right text-bold">Jumlah</td>
              <td class="uang jumlah">0,00</td>
            </tr>
            <tr class="akhir"> <!-- toal akhir semua jumlah -->
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="text-right text-bold">Nilai HSPK</td>
              <td class="uang jumlah">0,00</td>
            </tr>
            <!-- akhir kegiatan -->
          </tbody>
        </table>
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
/*drepdrop*/
$('#Kd_Ssh1').change(function(){
    var Kd_Ssh1=$(this).val();
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

$("#Kd_Hspk3").change(function(){
    var Kd_Hspk1 = $("#Kd_Hspk1").val();
    var Kd_Hspk2 = $("#Kd_Hspk2").val();
    var Kd_Hspk3 = $(this).val();
    $.post('index.php?r=ref-hspk/get-nomor&Kd_Hspk1='+Kd_Hspk1+'&Kd_Hspk2='+Kd_Hspk2+'&Kd_Hspk3='+Kd_Hspk3+'&Kode1=<?= $model->Kd_Hspk1.$model->Kd_Hspk2.$model->Kd_Hspk3 ?>'+'&Kode2=<?= $model->Kd_Hspk4 ?>', function(data){
        $('#Kd_Hspk4').val(data);
    })
});

/*khusus hspk*/

  /*
  $("#Kd_Hspk3").change(function(){
    var Kd_Hspk1 = $("#Kd_Hspk1").val();
    var Kd_Hspk2 = $("#Kd_Hspk2").val();
    var Kd_Hspk3 = $("#Kd_Hspk3").val();

    $("#Kd_Hspk4").val(Kd_Hspk1+Kd_Hspk2+Kd_Hspk3);
  });
  */

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
  //harga-ssh
  //koefisien
  //harga
  //$("#wrap-ssh").html('isi');
  function get_ssh(){
    $.ajax({ 
      type: "GET",
      url: 'index.php?r=ref-hspk/get-cookie',
      data: '',
      success: function(isi){
        $("#wrap-ssh").html(isi);
        var jumlah_hspk=$("#jumlah_hspk").html();
        $("#harga_hspk").val(jumlah_hspk);
      },
      error: function(){
        alert("Belum ada SSH Terpilih");
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
        alert("failure1");
      }
    });
  });
/**/
</script>