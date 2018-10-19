<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefLingkungan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-lingkungan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Prov')->hiddenInput(['value' => $model->Kd_Prov, 'id' => 'Kd_Prov_Id'])->label(false) ?>

    <?= $form->field($model, 'Kd_Kab')->hiddenInput(['value' => $model->Kd_Kab, 'id' => 'Kd_Kab_Id'])->label(false) ?>

    <?=
            $form->field($model, 'Kd_Kec')
            ->dropDownList(// Flat array ('id'=>'label')
                    $dataKec, ['prompt' => '-Pilih Kecamatan-', 'id' => 'Kd_Kec_Id']    // options
    )->label('Kecamatan');
    ?>

    <?= $form->field($model, 'Kd_Kel')->textInput(['readonly' => true, 'id' => 'Kd_Kel_Id'])->label('Kategori') ?>

    <?=
            $form->field($model, 'Kd_Urut_Kel')
            ->dropDownList(// Flat array ('id'=>'label')
                    [], ['prompt' => '-Pilih Kelurahan-', 'id' => 'Kd_Kel_Urut_Id']    // options
    )->label('Desa/Kelurahan');
    ?>

    <?php // $form->field($model, 'Kd_Lingkungan')->textInput()  ?>

    <?= $form->field($model, 'Nm_Lingkungan')->textInput(['maxlength' => true]) ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
