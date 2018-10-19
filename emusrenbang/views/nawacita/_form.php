<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nawacita-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nawacita')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
