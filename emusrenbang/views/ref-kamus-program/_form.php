<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use emusrenbang\models\Referensi;

$ref=new Referensi();
if(empty($model->Kd_Program)){
	$model->Kd_Program=$ref->getKdKamusProgram();
}
$status=array('1'=>'Urusan Wajib Pelayanan Dasar', '2'=>' Urusan Wajib Bukan Pelayanan Dasar', '3'=>'Urusan Pilihan', '4'=>'Urusan Pemerintahan Fungsi Penunjang');

/* @var $this yii\web\View */
/* @var $model app\models\RefKamusProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kamus-program-form">
	<div class="box box-success">
		<div class="box-body">
			<?php $form = ActiveForm::begin(); ?>

		    <?= $form->field($model, 'Kd_Program')->textInput(['readonly'=>true]) ?>

		    <?= $form->field($model, 'Nm_Program')->textInput(['maxlength' => true]) ?>

		    <?= $form->field($model, 'Status')->dropDownList($status, ['prompt'=>'Pilih Status']) ?>

		    <div class="form-group">
		        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		    </div>

		    <?php ActiveForm::end(); ?>
		</div>
	</div>
</div>