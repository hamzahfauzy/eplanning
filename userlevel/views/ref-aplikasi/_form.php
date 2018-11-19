<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAplikasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-aplikasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Aplikasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Aplikasi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
