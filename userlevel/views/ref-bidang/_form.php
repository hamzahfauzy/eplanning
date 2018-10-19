<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use emusrenbang\models\Referensi;

$ref = new Referensi;
$urusan = $ref->getUrusan();
$fungsi = $ref->getFungsi();

/* @var $this yii\web\View */
/* @var $model app\models\RefBidang */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="ref-bidang-form">

    <?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan, ['prompt' => 'Pilih Urusan']) ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput(['placeholder' => "Kode Berdasarkan SOTK"]) ?>

    <?= $form->field($model, 'Nm_Bidang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Fungsi')->dropDownList($fungsi, ['prompt' => 'Pilih Fungsi']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
