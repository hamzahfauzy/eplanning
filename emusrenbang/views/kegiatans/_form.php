<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kegiatans */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="kegiatans-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'kode_kegiatan')->textInput(['maxlength' => true, 'value'=>Yii::$app->user->getKode_skpd()."."]) ?>

    <?= $form->field($model, 'kode_program')->dropDownList($dataProgram, ['prompt' => '']) ?>

    <?= $form->field($model, 'nama_kegiatan')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'indikator')->textInput(['maxlength' => true]) ?>

    <?php  //$form->field($model, 'status')->dropDownList([ 'Fisik' => 'Fisik', 'Non Fisik' => 'Non Fisik', ], ['prompt' => '']) ?>

    <?php //$form->field($model, 'aktif')->dropDownList([ '0', '1', ], ['prompt' => '']) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <?php //$form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
