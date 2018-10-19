<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\TaRpjmdProgramPrioritasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-rpjmd-program-prioritas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?= $form->field($model, 'Kd_Kab') ?>

    <?= $form->field($model, 'No_Misi') ?>

    <?= $form->field($model, 'No_Tujuan') ?>

    <?php // echo $form->field($model, 'No_Sasaran') ?>

    <?php // echo $form->field($model, 'No_Prioritas') ?>

    <?php // echo $form->field($model, 'Kd_Urusan') ?>

    <?php // echo $form->field($model, 'Kd_Bidang') ?>

    <?php // echo $form->field($model, 'Kd_Prog') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
