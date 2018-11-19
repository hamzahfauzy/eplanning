<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProgramNasionalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-nasional-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_prioritas') ?>

    <?= $form->field($model, 'id_nawacita') ?>

    <?= $form->field($model, 'id_urusan') ?>

    <?= $form->field($model, 'id_misi') ?>

    <?php // echo $form->field($model, 'urusan') ?>

    <?php // echo $form->field($model, 'bidang') ?>

    <?php // echo $form->field($model, 'id_program') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'username') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
