<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaSubUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-sub-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nm_Pimpinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Pimpinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Pimpinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ur_Visi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
