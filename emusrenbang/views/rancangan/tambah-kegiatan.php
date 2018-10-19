<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Misi */

$this->title = 'Tambah Kegiatan';
$this->params['breadcrumbs'][] = $this->title;




// $this->registerCssFile(
//         '@web/plugins/select2/select2.css', ['depends' => [\yii\web\JqueryAsset::className()]]
// );

// $this->registerJsFile(
//         '@web/plugins/select2/select2.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );
if(isset($ubah)){
	//$aksi = ;
	$url = ['pra-rka/ubah-kegiatan-proses',
				'Tahun' => $Tahun,
				'Kd_Urusan' => $Kd_Urusan,
				'Kd_Bidang' => $Kd_Bidang,
				'Kd_Unit' => $Kd_Unit,
				'Kd_Sub' => $Kd_Sub,
				'Kd_Prog' => $Kd_Prog,
				'Kd_Keg' => $Kd_Keg,
	];
	$disable = true;
}
else{
	$url = ['pra-rka/tambah-kegiatan-proses'];
	$disable = false;
}
$disable = false;  //pemilihan kegiatan dari kamus kegiatan tetap terbuka
?>
<div class="misi-form">
  <?php $form = ActiveForm::begin(['action' =>$url,'id' => 'tambah_kegiatan_form']); ?>

  	<?= $form->field($model, 'Tahun')->hiddenInput(['value'=> $Tahun])->label(false); ?>
  	<?= $form->field($model, 'Kd_Urusan')->hiddenInput(['value'=> $Kd_Urusan])->label(false); ?>
  	<?= $form->field($model, 'Kd_Bidang')->hiddenInput(['value'=> $Kd_Bidang])->label(false); ?>
  	<?= $form->field($model, 'Kd_Unit')->hiddenInput(['value'=> $Kd_Unit])->label(false); ?>
  	<?= $form->field($model, 'Kd_Sub')->hiddenInput(['value'=> $Kd_Sub])->label(false); ?>
  	<?= $form->field($model, 'Kd_Prog')->hiddenInput(['value'=> $Kd_Prog])->label(false); ?>
  	<div class="col-md-12">
			<?php // $form->field($model, 'ID_Prog')->textInput(['maxlength' => true, 'class'=>'form-control input-sm','value'=> $ID_Prog]) ?>
			<?php // $form->field($model, 'Kd_Keg')->textInput(['maxlength' => true, 'class'=>'form-control input-sm', 'readonly'=>true]) ?>
			<?= $form->field($model, 'Ket_Kegiatan')->dropDownList($ref_kegiatan, ['prompt'=>'Pilih Sumber', 'class'=>'form-control input-sm selects', 'disabled'=>$disable]) ?>
			<!--
			<button type="button" class="btn btn-primary btn-xs pull-right" id="btn_tambah_kamus"
				value="<?= Url::to(['pra-rka/tambah-kamus',
                        'Kd_Urusan' => $Kd_Urusan,
                        'Kd_Bidang' => $Kd_Bidang,
                        'Kd_Prog' => $Kd_Prog]) ?>"
			>
				Tambah Kamus Kegiatan
			</button>
			-->
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'Kelompok_Sasaran')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
			<?= $form->field($model, 'Status_Kegiatan')->dropDownList([1=>'Baru', 2=>'Lanjutan'], ['prompt'=>'Pilih Status', 'class'=>'form-control input-sm']) ?>
			<?php //$form->field($model, 'Waktu_Pelaksanaan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
			<div class="form-group">
				<label >Waktu Pelaksanaan</label>
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control" name="waktu_pelaksanaan_nilai" value="<?php if(isset($waktu_pelaksanaan_nilai)) echo $waktu_pelaksanaan_nilai ?>">
					</div>
					<div class="col-md-6">
						<select class="form-control" name="waktu_pelaksanaan_satuan">
				    	<option value="Tahun" <?php if(isset($waktu_pelaksanaan_satuan)) if($waktu_pelaksanaan_satuan=='Tahun') echo 'selected' ?>>Tahun</option>
				    	<option value="Bulan" <?php if(isset($waktu_pelaksanaan_satuan)) if($waktu_pelaksanaan_satuan=='Bulan') echo 'selected' ?>>Bulan</option>
				    	<option value="Jam" <?php if(isset($waktu_pelaksanaan_satuan)) if($waktu_pelaksanaan_satuan=='Jam') echo 'selected' ?>>Jam</option>
				    </select>
					</div>
				</div>
		  </div>
			<?php // $form->field($model, 'Pagu_Anggaran')->textInput(['maxlength' => true, 'class'=>'form-control input-sm uang']) ?>
			<?= $form->field($model, 'Pagu_Anggaran_Nt1')->textInput(['maxlength' => true, 'class'=>'form-control input-sm uang']) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'Lokasi')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
			<?= $form->field($model, 'Kd_Sumber')->dropDownList($sumber_dana, ['prompt'=>'Pilih Sumber', 'class'=>'form-control input-sm selects']) ?>
			<?php // $form->field($model, 'Status')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
			<?= $form->field($model, 'Keterangan')->textarea(['rows' => '3']) ?>
		</div>
		<div class="clearfix"></div>
		<hr>
		<h3 align="center">Indikator</h3>
		<!-- untuk edit -->
		<?php
			foreach ($indikator as $key => $value):
			?>
				<div class="col-md-12">
					<div class="row box box-primary">
						<div class="col-md-2">
							<h4><?= $value->Nm_Indikator ?></h4>
						</div>
						<div class="col-md-4">
							<div class="form-group">
						    <label >Tolak Ukur</label>
						    <input type="text" class="form-control" name="tolak_ukur[<?= $value->Kd_Indikator ?>]" value="<?php if(isset($Tolak_Ukur[$value->Kd_Indikator])) echo $Tolak_Ukur[$value->Kd_Indikator] ?>">
						  </div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
						    <label >Target</label>
						    <input type="text" class="form-control angka" name="target[<?= $value->Kd_Indikator ?>]" value="<?php if(isset($Target_Angka[$value->Kd_Indikator])) echo $Target_Angka[$value->Kd_Indikator] ?>">
						  </div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
						    <label >&nbsp;</label>
						    <select  class="form-control input-sm selects" name="target_satuan[<?= $value->Kd_Indikator ?>]">
						    	<?php
						    		foreach ($satuan as $key => $sat):
						    			$selected = '';
						    			if(isset($Target_Uraian[$value->Kd_Indikator])){
						    				$nilai = $Target_Uraian[$value->Kd_Indikator];

						    				if ($nilai == $sat) {
						    					$selected = 'selected';
						    				}
						    			}

						    			if ($value->Kd_Indikator == 2 && $sat == 'Rupiah') {
						    					$selected = 'selected';
						    			}

						    		?>
						    				<option value="<?= $sat ?>" <?= $selected ?> ><?= $sat ?></option>
						    		<?php
						    		endforeach;
						    	?>
						    </select>
						  </div>
						</div>
					</div>
				</div>
			<?php
			endforeach;
		?>
		
		<div class="clearfix"></div>
  <?php  // echo Html::submitButton('Tambah' , ['class' => 'btn btn-success' ]) ?>

  <?php ActiveForm::end(); ?>

</div>


<script type="text/javascript">
$('#btn_tambah_kamus').on('click', function () {
  $('#tambahKamusModal').modal('show')
          .find('#tambahKamusContent')
          .load($(this).attr('value'));
  //alert($(this).attr('value'));
  //$('#tambahKamusSave').attr('disabled', true);
});

$("#tambahKamusSave").click(function(){
  $('#tambahKamusSave').attr('disabled', true);
	$.ajax({ 
    type: "POST",
    url:'index.php?r=pra-rka/tambah-kamus-proses',
    data:$("#tambah_kamus_form").serialize(),
    success: function(isi){
    	$('#tambahKamusContent').html(isi);
      $('#tambahKamusModal').on('hidden.bs.modal', function () {
          window.location.reload(true);
      })
    },
    error: function(){
      alert("failure");
    }
  });
});

$('.uang').number( true, 2, ',', '.' );
$('.angka').number( true, 0, ',', '.' );

$(".selects").select2({
  allowClear: true
});
</script>