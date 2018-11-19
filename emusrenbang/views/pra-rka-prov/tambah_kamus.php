<?php
use yii\widgets\ActiveForm;
?>
<div class="row">
	<div class="col-md-12">
		<?php $form = ActiveForm::begin(['action' =>['pra-rka/tambah-kamus-proses'],'id' => 'tambah_kamus_form']); ?>
			<?= $form->field($model, 'Kd_Urusan')->hiddenInput(['value'=> $Kd_Urusan])->label(false); ?>
	  	<?= $form->field($model, 'Kd_Bidang')->hiddenInput(['value'=> $Kd_Bidang])->label(false); ?>
	  	<?= $form->field($model, 'Kd_Prog')->hiddenInput(['value'=> $Kd_Prog])->label(false); ?>
			<?= $form->field($model, 'Kd_Keg')->textInput(['maxlength' => true, 'class'=>'form-control input-sm','value'=> $Kd_Keg, 'readonly'=>true]) ?>
			<?= $form->field($model, 'Ket_Kegiatan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
  	<?php ActiveForm::end(); ?>
	</div>
</div>