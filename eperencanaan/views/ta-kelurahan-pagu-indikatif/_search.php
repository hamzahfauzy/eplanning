<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\search\TaKelurahanPaguIndikatifSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kelurahan-pagu-indikatif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Tahun') ?>

    <?= $form->field($model, 'Kd_Prov') ?>

    <?= $form->field($model, 'Kd_Kab') ?>

    <?= $form->field($model, 'Kd_Kec') ?>

    <?= $form->field($model, 'Kd_Kel') ?>

    <?php // echo $form->field($model, 'Kd_Urut') ?>

    <?php // echo $form->field($model, 'Pagu_Indikatif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
