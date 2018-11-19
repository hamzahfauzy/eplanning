<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\RefJalan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-jalan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Prov')->hiddenInput(['value' => $model->Kd_Prov])->label(false) ?>
    <?= $form->field($model, 'Kd_Kab')->hiddenInput(['value' => $model->Kd_Kab])->label(false) ?>

    <?=
            $form->field($model, 'Kd_Kec')
            ->dropDownList(// Flat array ('id'=>'label')
                    $dataKec, ['prompt' => '-Pilih Kecamatan-']    // options
    )->label('Kecamatan');
    ?>

    <?= $form->field($model, 'Kd_Kel')->textInput(['readonly' => true])->label('Kategori') ?>

    <?=
            $form->field($model, 'Kd_Urut_Kel')
            ->dropDownList(// Flat array ('id'=>'label')
                    ['prompt' => '-Pilih Kecamatan-']    // options
    )->label('Desa/Kelurahan');
    ?>

    <?=
            $form->field($model, 'Kd_Lingkungan')
            ->dropDownList(// Flat array ('id'=>'label')
                    ['prompt' => '-Pilih Kecamatan-']    // options
    )->label('Lingkungan');
    ?>

    <?php // $form->field($model, 'Kd_Jalan')->textInput()  ?>

    <?= $form->field($model, 'Nm_Jalan')->textInput(['maxlength' => true])->label('Nama Jalan') ?>


    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
