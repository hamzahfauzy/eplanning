<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaPokirAcara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-pokir-acara-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_User')->textInput() ?>

    <?= $form->field($model, 'Waktu_Unduh_Absen')->textInput() ?>

    <?= $form->field($model, 'Waktu_Unduh_Berita_Acara')->textInput() ?>

    <?= $form->field($model, 'Waktu_Mulai')->textInput() ?>

    <?= $form->field($model, 'Waktu_Selesai')->textInput() ?>

    <?= $form->field($model, 'Masa_Reses')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'Nama_Tempat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Nama_Tempat2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Nama_Tempat3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Jumlah_Peserta')->textInput() ?>
	<?= $form->field($model, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'Nomor_BA')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Tanggal_BA')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
