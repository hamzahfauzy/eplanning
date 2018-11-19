<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrioritasNasional */
/* @var $form yii\widgets\ActiveForm */
$nawacita=$this->context->getAllNawacita();
?>

<div class="prioritas-nasional-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_nawacita')->dropDownList($nawacita, ['prompt'=>'Pilih Nawacita']) ?>

    <?= $form->field($model, 'prioritas_nasional')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
