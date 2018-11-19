<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaCapaianProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-capaian-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tolak_Ukur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Target_Angka')->textInput() ?>

    <?= $form->field($model, 'Target_Uraian')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
