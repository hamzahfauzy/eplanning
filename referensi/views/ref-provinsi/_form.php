<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefProvinsi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-provinsi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Prov')->textInput(['readonly' => true])->label('Kode Provinsi') ?>

    <?= $form->field($model, 'Nm_Prov')->textInput(['maxlength' => true])->label('Nama Provinsi') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
