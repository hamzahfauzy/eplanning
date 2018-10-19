<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Misi */

$this->title = 'Tambah Kegiatan';
$this->params['breadcrumbs'][] = $this->title;

if(isset($ubah)){
  //$aksi = ;
  $url = ['pra-rka-prov/ubah-rincian-proses',
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
  ];
  //$disable = true;
  $disable = false;
}
else{
  $url = ['pra-rka-prov/tambah-rincian-proses'];
  $disable = false;
}
?>

<div class="misi-form">
	<div class="row">
  <?php $form = ActiveForm::begin(['action' =>$url,'id' => 'tambah_rincian_form']); ?>

  	<?= $form->field($model, 'Tahun')->hiddenInput(['value'=> $Tahun])->label(false); ?>
  	<?= $form->field($model, 'Kd_Urusan')->hiddenInput(['value'=> $Kd_Urusan])->label(false); ?>
  	<?= $form->field($model, 'Kd_Bidang')->hiddenInput(['value'=> $Kd_Bidang])->label(false); ?>
  	<?= $form->field($model, 'Kd_Unit')->hiddenInput(['value'=> $Kd_Unit])->label(false); ?>
  	<?= $form->field($model, 'Kd_Sub')->hiddenInput(['value'=> $Kd_Sub])->label(false); ?>
  	<?= $form->field($model, 'Kd_Prog')->hiddenInput(['value'=> $Kd_Prog])->label(false); ?>
  	<?= $form->field($model, 'Kd_Keg')->hiddenInput(['value'=> $Kd_Keg])->label(false); ?>
    <?= $form->field($model, 'Kd_Rek_1')->hiddenInput(['value'=> $Kd_Rek_1, 'id'=>'Kd_Rek_1'])->label(false); ?>
  	<?= $form->field($model, 'Kd_Rek_2')->hiddenInput(['value'=> $Kd_Rek_2, 'id'=>'Kd_Rek_2'])->label(false); ?>
		<div class="col-md-6">
      <?= $form->field($model, 'Nm_Rek_1')->textInput(['maxlength' => true, 'class'=>'form-control input-sm','value'=> $Nm_Rek_1, 'disabled'=>true]) ?>
			<?= $form->field($model, 'Nm_Rek_2')->textInput(['maxlength' => true, 'class'=>'form-control input-sm','value'=> $Nm_Rek_2, 'disabled'=>true]) ?>
			<?= $form->field($model, 'Kd_Rek_3')->dropDownList($Data_Rek_3, ['prompt'=>'Pilih Status', 'class'=>'form-control input-sm', 'id'=>'Kd_Rek_3', 'disabled'=>$disable]) ?>
			<?= $form->field($model, 'Kd_Rek_4')->dropDownList($Data_Rek_4, ['prompt'=>'Pilih Status', 'class'=>'form-control input-sm', 'id'=>'Kd_Rek_4', 'disabled'=>$disable]) ?>
			<?= $form->field($model, 'Kd_Rek_5')->dropDownList($Data_Rek_5, ['prompt'=>'Pilih Status', 'class'=>'form-control input-sm', 'id'=>'Kd_Rek_5', 'disabled'=>$disable]) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'Kd_Ap_Pub')->dropDownList($RefApPub, ['class'=>'form-control input-sm', 'readonly'=>true]) ?>
			<?= $form->field($model, 'Kd_Sumber')->dropDownList(['1'=>'Dana Bagi Hasil', '2'=>'Bantuan Keuangan Provinsi'], ['class'=>'form-control input-sm']) ?>
		</div>
		
  <?php //echo Html::submitButton('Tambah' , ['class' => 'btn btn-success' ]) ?>

  <?php ActiveForm::end(); ?>
	</div>
</div>


<script type="text/javascript">
	$('#Kd_Rek_2').change(function(){
      Kd_Rek_1=$('#Kd_Rek_1').val();
      Kd_Rek_2=$(this).val();
      $.post('index.php?r=ajax/get-rek3&Kd_Rek_1='+Kd_Rek_1+'&Kd_Rek_2='+Kd_Rek_2, function(data, status){
          $('#Kd_Rek_3').html(data);
      })
  });

	$('#Kd_Rek_3').change(function(){
      Kd_Rek_1=$('#Kd_Rek_1').val();
      Kd_Rek_2=$('#Kd_Rek_2').val();
      Kd_Rek_3=$(this).val();
      $.post('index.php?r=ajax/get-rek4&Kd_Rek_1='+Kd_Rek_1+'&Kd_Rek_2='+Kd_Rek_2+'&Kd_Rek_3='+Kd_Rek_3, function(data, status){
          $('#Kd_Rek_4').html(data);
      })
  });

	$('#Kd_Rek_4').change(function(){
      Kd_Rek_1=$('#Kd_Rek_1').val();
      Kd_Rek_2=$('#Kd_Rek_2').val();
      Kd_Rek_3=$('#Kd_Rek_3').val();
      Kd_Rek_4=$(this).val();
      $.post('index.php?r=ajax/get-rek5&Kd_Rek_1='+Kd_Rek_1+'&Kd_Rek_2='+Kd_Rek_2+'&Kd_Rek_3='+Kd_Rek_3+'&Kd_Rek_4='+Kd_Rek_4, function(data, status){
          $('#Kd_Rek_5').html(data);
      })
  });
</script>