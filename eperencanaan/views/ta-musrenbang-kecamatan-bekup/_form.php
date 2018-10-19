<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKecamatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-musrenbang-kecamatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Musrenbang_Kecamatan')->textInput() ?>

    <?= $form->field($model, 'Kd_Benua')->textInput() ?>

    <?= $form->field($model, 'Kd_Benua_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Benua_Sub_Negara')->textInput() ?>

    <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab')->textInput() ?>

    <?= $form->field($model, 'Kd_Kec')->textInput() ?>

    <?= $form->field($model, 'Kd_Kel')->textInput() ?>

    <?= $form->field($model, 'Kd_Urut_kel')->textInput() ?>

    <?= $form->field($model, 'Kd_Lingkungan')->textInput() ?>

    <?= $form->field($model, 'Kd_Jalan')->textInput() ?>

    <?= $form->field($model, 'Kd_Usulan')->textInput() ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Prog')->textInput() ?>

    <?= $form->field($model, 'Kd_Keg')->textInput() ?>

    <?= $form->field($model, 'Kd_Klasifikasi')->textInput() ?>

    <?= $form->field($model, 'Nm_Permasalahan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Satuan')->textInput() ?>

    <?= $form->field($model, 'Kd_Sasaran')->textInput() ?>

    <?= $form->field($model, 'Kd_Status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
