<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Programs */
/* @var $form yii\widgets\ActiveForm */
$prioritas=$this->context->getAllPrioritas();
?>

<div class="programs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id_prioritas')->dropDownList($prioritas, ['prompt'=>'Pilih Prioritas Nasional']) ?>

    <?= $form->field($model, 'nama_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indikator_program')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Fisik' => 'Fisik', 'Non Fisik' => 'Non Fisik', ], ['prompt' => '']) ?>

    <?php //$form->field($model, 'aktif')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <?php //$form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
