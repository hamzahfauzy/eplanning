<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model emusrenbang\models\search\RefUnitApbnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-unit-apbn-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?= $form->field($model, 'Kd_Unit') ?>

    <?= $form->field($model, 'Nm_Unit') ?>

    <?= $form->field($model, 'Flag') ?>

    <?php // echo $form->field($model, 'Token') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
