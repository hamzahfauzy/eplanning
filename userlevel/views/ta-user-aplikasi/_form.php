<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaUserAplikasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-user-aplikasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_User')->hiddenInput(['value'=>$id])->label('') ?>

    <?= $form->field($model, 'Kd_Aplikasi')->dropdownlist($DNDataAplikasi,
		['prompt' => 'Pilih Aplikasi',
		'class' => 'dependent-input form-control',
		'id' => 'Kd_Aplikasi']
		); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
