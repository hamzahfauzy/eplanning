<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Misi */

$this->title = 'Tambah Kegiatan';
$this->params['breadcrumbs'][] = $this->title;

if(isset($ubah)){
  //$aksi = ;
  $url = ['pra-rka-apbn/ubah-rincian-sub-proses',
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
  ];
  // $disable = true;
  $disable = false;
}
else{
  $url = ['pra-rka-apbn/tambah-rincian-sub-proses'];
  $disable = false;
}

?>

<div class="misi-form">
	<div class="row">
  <?php $form = ActiveForm::begin(['action' =>$url,'id' => 'tambah_rincian_sub_form']); ?>

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
		<div class="col-md-6">
			<?= $form->field($model, 'No_Rinc')->textInput(['maxlength' => true, 'class'=>'form-control input-sm', 'value'=>$No_Rinc, 'disabled'=>$disable]) ?>
			<?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true, 'class'=>'form-control input-sm']) ?>
		</div>
		
  <?php //echo Html::submitButton('Tambah' , ['class' => 'btn btn-success' ]) ?>

  <?php ActiveForm::end(); ?>
	</div>
</div>
