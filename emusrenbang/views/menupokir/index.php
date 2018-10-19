<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
$this->title = "Setting Masa Reses Pokir";
?>
<div class="container-fluid" style="background:#FFF">
<h2>Setting Reses Pokir (Masa Reses Aktif : <?= $model->Masa_Reses; ?>)</h2>
<div class="row">
	<div class="col-sm-12 table-responsive">
	<?php 
	$form = ActiveForm::begin(['id' => 'login-form']);
	echo $form->field($model, 'Masa_Reses')->dropdownList([
        1 => 1, 
        2 => 2,
        3 => 3,
        4 => 4
    ],
	    ['prompt'=>'Pilih Masa Reses','class' => 'form-control']
	);
	echo Html::submitButton('Aktifkan', ['class' => 'btn btn-primary']);
	?>
	<?php ActiveForm::end() ?>
	</div>
</div>
<br>
<br>
<br>
</div>