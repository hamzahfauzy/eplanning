<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaKelurahanPaguIndikatif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kelurahan-pagu-indikatif-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab')->textInput() ?>

    <?= $form->field($model, 'Kd_Kec')->textInput() ?>

    <?= $form->field($model, 'Kd_Kel')->textInput() ?>

    <?= $form->field($model, 'Kd_Urut')->textInput() ?>

    <?= $form->field($model, 'Pagu_Indikatif')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
