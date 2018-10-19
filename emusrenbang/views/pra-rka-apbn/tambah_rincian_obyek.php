<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\ActiveField;


/* @var $this yii\web\View */
/* @var $model app\models\Misi */

$this->title = 'Tambah Kegiatan';
$this->params['breadcrumbs'][] = $this->title;

if(isset($ubah)){
  //$aksi = ;
  $url = ['pra-rka-apbn/ubah-rincian-obyek-proses',
        'Tahun' => $Tahun,
        'Kd_Urusan' => $Kd_Urusan,
        'Kd_Bidang' => $Kd_Bidang,
        'Kd_Unit' => $Kd_Unit,
        'Kd_Sub' => $Kd_Sub,
        'Kd_Prog' => $Kd_Prog,
        'Kd_Keg' => $Kd_Keg,
        'Kd_Rek_1' => $Kd_Rek_1,
        'Kd_Rek_2' => $Kd_Rek_2,
        'Kd_Rek_3' => $Kd_Rek_3,
        'Kd_Rek_4' => $Kd_Rek_4,
        'Kd_Rek_5' => $Kd_Rek_5,
        'No_Rinc' => $No_Rinc,
        'No_ID' => $No_ID,
  ];
  $disable = true;
}
else{
  $url = ['pra-rka-apbn/tambah-rincian-obyek-proses'];
  $disable = false;
}
?>

<div class="misi-form">
	<div class="row">
  <?php $form = ActiveForm::begin(['action' =>$url,'id' => 'tambah_rincian_obyek_form']); ?>
    <input type="hidden" id="Ref_Usulan_Rincian" value="<?= $Ref_Usulan_Rincian ?>">
  	<?= $form->field($model, 'Tahun')->hiddenInput(['value'=> $Tahun])->label(false); ?>
  	<?= $form->field($model, 'Kd_Urusan')->hiddenInput(['value'=> $Kd_Urusan])->label(false); ?>
  	<?= $form->field($model, 'Kd_Bidang')->hiddenInput(['value'=> $Kd_Bidang])->label(false); ?>
  	<?= $form->field($model, 'Kd_Unit')->hiddenInput(['value'=> $Kd_Unit])->label(false); ?>
  	<?= $form->field($model, 'Kd_Sub')->hiddenInput(['value'=> $Kd_Sub])->label(false); ?>
  	<?= $form->field($model, 'Kd_Prog')->hiddenInput(['value'=> $Kd_Prog])->label(false); ?>
  	<?= $form->field($model, 'Kd_Keg')->hiddenInput(['value'=> $Kd_Keg])->label(false); ?>
  	<?= $form->field($model, 'Kd_Rek_1')->hiddenInput(['value'=> $Kd_Rek_1, 'id'=>'Kd_Rek_1'])->label(false); ?>
  	<?= $form->field($model, 'Kd_Rek_2')->hiddenInput(['value'=> $Kd_Rek_2, 'id'=>'Kd_Rek_2'])->label(false); ?>
  	<?= $form->field($model, 'Kd_Rek_3')->hiddenInput(['value'=> $Kd_Rek_3, 'id'=>'Kd_Rek_3'])->label(false); ?>
  	<?= $form->field($model, 'Kd_Rek_4')->hiddenInput(['value'=> $Kd_Rek_4, 'id'=>'Kd_Rek_4'])->label(false); ?>
    <?= $form->field($model, 'Kd_Rek_5')->hiddenInput(['value'=> $Kd_Rek_5, 'id'=>'Kd_Rek_5'])->label(false); ?>
    <?= $form->field($model, 'No_Rinc')->hiddenInput(['value'=> $No_Rinc, 'id'=>'No_Rinc'])->label(false); ?>
  	<?= $form->field($model, 'Uraian_Asal_Biaya')->hiddenInput([ 'id'=>'Uraian_Asal_Biaya'])->label(false); ?>
    <div class="col-md-3">
      Sumber:
      <br/>
      <button type="button" id="btn_ssh" class="btn btn-primary btn-block" value="<?= Url::to(['ajax/modal-sshs']) ?>">SSH</button>
      <br/>
      <button type="button" id="btn_asb" id="btn_asb" class="btn btn-primary btn-block" value="<?= Url::to(['ajax/modal-asbs']) ?>">ASB</button>
      <br/>
      <br/>
      <br/>
    </div>
		<div class="col-md-9">
      <?= $form->field($model, 'No_ID')->textInput(['maxlength' => true, 'class'=>'form-control input-sm', 'value'=>$No_ID]) ?>
      <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm', 'id'=>'uraian_obyek']) ?>
      <?= $form->field($model, 'Nilai_Rp')->textInput(['maxlength' => true, 'class'=>'form-control input-sm uang','readonly'=>true, 'id'=>'nilai_obyek']) ?>
		</div>
    <div class="col-md-12"><hr/></div>
    <div class="col-md-8">
      <h4>Rincian</h4>
      <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'Nilai_1')->textInput(['maxlength' => true, 'class'=>'form-control input-sm hitung_nilai', 'id'=>'nilai1']) ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'Sat_1')->dropDownList($Standard_Satuan, ['prompt'=>'Pilih Satuan', 'class'=>'form-control input-sm hitung_satuan selects', 'id'=>'satuan1']) ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'Nilai_2')->textInput(['maxlength' => true, 'class'=>'form-control input-sm hitung_nilai', 'id'=>'nilai2']) ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'Sat_2')->dropDownList($Standard_Satuan, ['prompt'=>'Pilih Satuan', 'class'=>'form-control input-sm hitung_satuan selects', 'id'=>'satuan2']) ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'Nilai_3')->textInput(['maxlength' => true, 'class'=>'form-control input-sm hitung_nilai', 'id'=>'nilai3']) ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'Sat_3')->dropDownList($Standard_Satuan, ['prompt'=>'Pilih Satuan', 'class'=>'form-control input-sm hitung_satuan selects', 'id'=>'satuan3']) ?>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <h4>Jumlah</h4>
      <?= $form->field($model, 'Jml_Satuan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm','readonly'=>true, 'id'=>'jumlah_satuan']) ?>
      <?= $form->field($model, 'Satuan123')->textInput(['maxlength' => true, 'class'=>'form-control input-sm','readonly'=>true, 'id'=>'satuan123']) ?>
      <?= $form->field($model, 'Total')->textInput(['maxlength' => true, 'class'=>'form-control input-sm uang','readonly'=>true, 'id'=>'total_nilai']) ?>
    </div>
  <?php  //echo Html::submitButton('Tambah' , ['class' => 'btn btn-success' ]) ?>

  <?php ActiveForm::end(); ?>
	</div>
</div>


<script type="text/javascript">
  $('#btn_ssh').on('click', function () {
    $('#pilihSshModal').modal('show')
            .find('#pilihSshContent')
            .load($(this).attr('value'));
  });

  $( '#pilihSshModal' ).on( 'hidden.bs.modal' , function() {
    $( 'body' ).addClass( 'modal-open' );
  } ); //mengatasi modal di tutup hilang scroll


  $('#btn_asb').on('click', function () {
    $('#pilihAsbModal').modal('show')
            .find('#pilihAsbContent')
            .load($(this).attr('value'));
  });

  $( '#pilihAsbModal' ).on( 'hidden.bs.modal' , function() {
    $( 'body' ).addClass( 'modal-open' );
  } ); //mengatasi modal di tutup hilang scroll

  $(".hitung_nilai").keyup(function(){
    var nilai = $("#nilai_obyek").val();
    var nilai1 = $("#nilai1").val();
    var nilai2 = $("#nilai2").val();
    var nilai3 = $("#nilai3").val();

    if (nilai1=='') {nilai1 = 1}
    if (nilai2=='') {nilai2 = 1}
    if (nilai3=='') {nilai3 = 1}

    var jumlah = nilai1*nilai2*nilai3;
    var hasil = jumlah*nilai;

    $("#jumlah_satuan").val(jumlah);
    $("#total_nilai").val(hasil);
    
  });

  $(".hitung_satuan").change(function(){
    var satuan1 = $("#satuan1").val();
    var satuan2 = $("#satuan2").val();
    var satuan3 = $("#satuan3").val();
    var satuan2s = '';
    var satuan3s = '';

    if (satuan2 != '') {satuan2s = "/"+satuan2};
    if (satuan3 != '') {satuan3s = "/"+satuan3};

    var gabungan = satuan1+satuan2s+satuan3s;

    $("#satuan123").val(gabungan);
  });

  $('.uang').number( true, 0, ',', '.' );
  $(".selects").select2({
    placeholder: "Pilih Satuan",
    allowClear: true
  });

  var ref_usulan = $("#Ref_Usulan_Rincian").val();
  $("#tabelanjarincsub-ref_usulan_rincian [value='"+ref_usulan+"']").prop("checked",true);
</script>