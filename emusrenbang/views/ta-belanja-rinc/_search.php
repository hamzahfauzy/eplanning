<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaBelanjaRincSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-belanja-rinc-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang') ?>

    <?= $form->field($model, 'Kd_Unit') ?>

    <?= $form->field($model, 'Kd_Sub') ?>

    <?php // echo $form->field($model, 'Kd_Prog') ?>

    <?php // echo $form->field($model, 'ID_Prog') ?>

    <?php // echo $form->field($model, 'Kd_Keg') ?>

    <?php // echo $form->field($model, 'Kd_Rek_1') ?>

    <?php // echo $form->field($model, 'Kd_Rek_2') ?>

    <?php // echo $form->field($model, 'Kd_Rek_3') ?>

    <?php // echo $form->field($model, 'Kd_Rek_4') ?>

    <?php // echo $form->field($model, 'Kd_Rek_5') ?>

    <?php // echo $form->field($model, 'No_Rinc') ?>

    <?php // echo $form->field($model, 'Keterangan') ?>

    <?php // echo $form->field($model, 'Kd_Sumber') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
