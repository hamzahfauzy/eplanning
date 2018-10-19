<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\RefUrusanApbn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-urusan-apbn-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Nm_Urusan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Flag')->textInput() ?>

    <?= $form->field($model, 'Token')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
