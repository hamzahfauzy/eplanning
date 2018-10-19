<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailProgramSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detail-program-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode_program') ?>

    <?= $form->field($model, 'tahun') ?>

    <?= $form->field($model, 'lokasi') ?>

    <?= $form->field($model, 'target') ?>

    <?php // echo $form->field($model, 'pagu') ?>

    <?php // echo $form->field($model, 'sumber') ?>

    <?php // echo $form->field($model, 'catatan') ?>

    <?php // echo $form->field($model, 'prakiraan_target') ?>

    <?php // echo $form->field($model, 'prakiraan_pagu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
