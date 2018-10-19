<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$dataSkpd=$this->context->getSkpd();
$dataLevel=$this->context->getLevel();
$dataJabatan=$this->context->getJabatan();
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_jabatan')->dropDownList($dataJabatan, ['prompt'=>'']) ?>

    <?= $form->field($model, 'id_skpd')->dropDownList($dataSkpd, ['prompt' =>'']) ?>

    <?= $form->field($model, 'id_level')->dropDownList($dataLevel, ['prompt' => '']) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
