<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\TaProgramApbn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-program-apbn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Prog')->textInput() ?>

    <?= $form->field($model, 'ID_Prog')->textInput() ?>

    <?= $form->field($model, 'Ket_Prog')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tolak_Ukur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Target_Angka')->textInput() ?>

    <?= $form->field($model, 'Target_Uraian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Urusan1')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang1')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
