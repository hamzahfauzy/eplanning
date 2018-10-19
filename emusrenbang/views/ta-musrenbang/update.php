<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

// $this->title = 'Update Ta Musrenbang: ' . $model->id;
$this->title = 'Ubah Data';
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbangs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-musrenbang-update">
	<div class="box box-success">
		<div class="box-header">
			<h1 class="box-title"><?= Html::encode($this->title) ?></h1>
		</div>
		<div class="box-body">
			<div class="ta-musrenbang-form">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
						<?php $form = ActiveForm::begin(); ?>

						<?= $form->field($model, 'Tahun')->hiddenInput(['maxlength' => true])->label(false) ?>
						<?= $form->field($model, 'Kd_Prov')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Klasifikasi')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Tanggal')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd1')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd2')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd3')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd4')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd5')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd6')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Status_Usulan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Rincian_Skor')->hiddenInput()->label(false)  ?>
						<?= $form->field($model, 'Status_Survey')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Status_Penerimaan_Kelurahan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Alasan_Kelurahan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Status_Penerimaan_Kecamatan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Alasan_Kecamatan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Status_Penerimaan_Skpd')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Alasan_Skpd')->hiddenInput()->label(false)  ?>
						<?= $form->field($model, 'Status_Penerimaan_Kota')->hiddenInput()->label(false)  ?>
						<?= $form->field($model, 'Alasan_Kota')->hiddenInput()->label(false)  ?>
						<?= $form->field($model, 'Kd_User')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Asal')->hiddenInput()->label(false) ?>


						<?= $form->field($model, 'Kd_Kab')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Kec')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Kel')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Urut_Kel')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Lingkungan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Jalan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Urusan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Bidang')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Prog')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Keg')->hiddenInput()->label(false) ?>

						<?= $form->field($model, 'Kd_Unit')->textInput() ?>
						<?= $form->field($model, 'Kd_Sub')->textInput() ?>

						<?= $form->field($model, 'Kd_Pem')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Nm_Permasalahan')->hiddenInput(['rows' => 6])->label(false) ?>
						<?= $form->field($model, 'Jenis_Usulan')->hiddenInput(['rows' => 6])->label(false) ?>
						<?= $form->field($model, 'Jumlah')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Satuan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Harga_Satuan')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Harga_Total')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Kd_Sasaran')->hiddenInput()->label(false) ?>
						<?= $form->field($model, 'Detail_Lokasi')->hiddenInput(['rows' => 6])->label(false) ?>
						<?= $form->field($model, 'Latitute')->hiddenInput(['maxlength' => true])->label(false) ?>
						<?= $form->field($model, 'Longitude')->hiddenInput(['maxlength' => true])->label(false) ?>
						<?= $form->field($model, 'Uraian_Usulan')->hiddenInput(['rows' => 6])->label(false) ?>
						<?= $form->field($model, 'Kd_Asal_Usulan')->hiddenInput()->label(false)->label(false) ?>
						<?= $form->field($model, 'Skor')->hiddenInput(['maxlength' => true])->label(false) ?>
						<?= $form->field($model, 'Kd_Prioritas_Pembangunan_Daerah')->hiddenInput()->label(false) ?>

						<div class="form-group">
						<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
						</div>

						<?php ActiveForm::end(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>