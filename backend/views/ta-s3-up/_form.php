<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaS3UP */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-s3-up-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput() ?>

    <?= $form->field($model, 'No_Bukti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Tgl_Bukti')->textInput() ?>

    <?= $form->field($model, 'No_BKU')->textInput() ?>

    <?= $form->field($model, 'Kd_Bank')->textInput() ?>

    <?= $form->field($model, 'Kd_Pembayaran')->textInput() ?>

    <?= $form->field($model, 'Nilai')->textInput() ?>

    <?= $form->field($model, 'D_K')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
