<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahanAcara */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-musrenbang-kelurahan-acara-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab')->textInput() ?>

    <?= $form->field($model, 'Kd_Kec')->textInput() ?>

    <?= $form->field($model, 'Kd_Kel')->textInput() ?>

    <?= $form->field($model, 'Kd_Urut_Kel')->textInput() ?>

    <?= $form->field($model, 'Waktu_Unduh_Absen')->textInput() ?>

    <?= $form->field($model, 'Waktu_Unduh_Berita_Acara')->textInput() ?>

    <?= $form->field($model, 'Waktu_Mulai')->textInput() ?>

    <?= $form->field($model, 'Waktu_Selesai')->textInput() ?>

    <?= $form->field($model, 'Nama_Tempat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Nama_Pejabat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jumlah_Peserta')->textInput() ?>

<?= $form->field($model, 'Nomor_Berita_Model')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Pimpinan_Sidang')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Tanggal_Berita_Model')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Sambutan_1')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Sambutan_2')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Sambutan_3')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Sambutan_4')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Sambutan_5')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Pemateri_1')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Pemateri_2')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'Pemateri_3')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
