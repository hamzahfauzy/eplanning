<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\LingkunganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lingkungan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Kd_Benua') ?>

    <?= $form->field($model, 'Kd_Benua_Sub') ?>

    <?= $form->field($model, 'Kd_Benua_Sub_Negara') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?= $form->field($model, 'Kd_Kab') ?>

    <?php // echo $form->field($model, 'Kd_Kec') ?>

    <?php // echo $form->field($model, 'Kd_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Urut_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Lingkungan') ?>

    <?php // echo $form->field($model, 'Nm_Lingkungan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
