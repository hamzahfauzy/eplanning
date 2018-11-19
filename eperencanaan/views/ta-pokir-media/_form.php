<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaPokirMedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-pokir-media-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_User')->textInput() ?>

    <?= $form->field($model, 'Kd_Media')->textInput() ?>

    <?= $form->field($model, 'Jenis_Dokumen')->dropDownList([ 'Absensi' => 'Absensi', 'Berita Acara' => 'Berita Acara', 'Foto' => 'Foto', 'Video' => 'Video', 'Pakta Integritas' => 'Pakta Integritas', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
