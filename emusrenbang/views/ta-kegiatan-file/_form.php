<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaKegiatanFile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kegiatan-file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'Tahun')->textInput() ?>

    <?php //$form->field($model, 'Kd_Urusan')->textInput() ?>

    <?php //$form->field($model, 'Kd_Bidang')->textInput() ?>

    <?php //$form->field($model, 'Kd_Unit')->textInput() ?>

    <?php //$form->field($model, 'Kd_Sub')->textInput() ?>

    <?php //$form->field($model, 'Kd_Prog')->textInput() ?>

    <?php //$form->field($model, 'Kd_Keg')->textInput() ?>

    <?php //$form->field($model, 'Nama_File')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'uploat_at')->textInput() ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
