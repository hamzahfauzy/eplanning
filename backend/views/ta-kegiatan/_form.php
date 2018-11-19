<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaKegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput() ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Prog')->textInput() ?>

    <?= $form->field($model, 'ID_Prog')->textInput() ?>

    <?= $form->field($model, 'Kd_Keg')->textInput() ?>

    <?= $form->field($model, 'Ket_Kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Lokasi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kelompok_Sasaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Status_Kegiatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Pagu_Anggaran')->textInput() ?>

    <?= $form->field($model, 'Waktu_Pelaksanaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Sumber')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'Keterangan')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
