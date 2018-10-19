<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefKelurahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kelurahan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Prov')->hiddenInput(['value' => $model->Kd_Prov, 'id' => 'Kd_Prov_Id'])->label(false) ?>

    <?= $form->field($model, 'Kd_Kab')->hiddenInput(['value' => $model->Kd_Kab, 'id' => 'Kd_Kab_Id'])->label(false) ?>

    <?=
            $form->field($model, 'Kd_Kec')
            ->dropDownList(// Flat array ('id'=>'label')
                    $dataKec, ['prompt' => '-Pilih Kecamatan-', 'id' => 'Kd_Kec_Id']    // options
            )->label('Kecamatan');
    ?>

    <?=
            $form->field($model, 'Kd_Kel')
            ->dropDownList(// Flat array ('id'=>'label')
                    ['1' => 'Kelurahan', '2' => 'Desa']
            )->label('Pilih Kategori (Desa/Kelurahan)');
    ?>

    <?= $form->field($model, 'Kd_Urut')->textInput(['maxlength' => true])->label('Kode Urut Kel') ?>


    <?= $form->field($model, 'Nm_Kel')->textInput(['maxlength' => true])->label('Nama Kelurahan') ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
