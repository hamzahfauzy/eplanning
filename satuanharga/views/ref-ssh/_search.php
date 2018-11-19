<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\RefSsh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-ssh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Kd_Ssh1') ?>

    <?= $form->field($model, 'Kd_Ssh2') ?>

    <?= $form->field($model, 'Kd_Ssh3') ?>

    <?= $form->field($model, 'Kd_Ssh4') ?>

    <?= $form->field($model, 'Kd_Ssh5') ?>

    <?php // echo $form->field($model, 'Kd_Ssh6') ?>

    <?php // echo $form->field($model, 'Nama_Barang') ?>

    <?php // echo $form->field($model, 'Kd_Satuan') ?>

    <?php // echo $form->field($model, 'Harga_Satuan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
