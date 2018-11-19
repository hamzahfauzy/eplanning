<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefIndikator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-indikator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Indikator')->textInput() ?>

    <?= $form->field($model, 'Nm_Indikator')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
