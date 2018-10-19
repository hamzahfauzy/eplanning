<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefStandardHarga3Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-standard-harga3-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_1') ?>

    <?= $form->field($model, 'Kd_2') ?>

    <?= $form->field($model, 'Kd_3') ?>

    <?= $form->field($model, 'Uraian') ?>

    <?php // echo $form->field($model, 'Harga') ?>

    <?php // echo $form->field($model, 'Satuan') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
