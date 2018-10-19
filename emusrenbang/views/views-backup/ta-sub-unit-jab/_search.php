<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaSubUnitJabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-sub-unit-jab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?= $form->field($model, 'Kd_Unit') ?>

    <?= $form->field($model, 'Kd_Sub') ?>

    <?php // echo $form->field($model, 'Kd_Jab') ?>

    <?php // echo $form->field($model, 'No_Urut') ?>

    <?php // echo $form->field($model, 'Nama') ?>

    <?php // echo $form->field($model, 'Nip') ?>

    <?php // echo $form->field($model, 'Jabatan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
