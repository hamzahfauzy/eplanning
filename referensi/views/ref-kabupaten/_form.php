<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefKabupaten */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kabupaten-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Prov')->dropdownlist(Yii::$app->runAction('ajax/provinsi'))->label('Provinsi') ?>

    <?= $form->field($model, 'Kd_Kab')->hiddenInput(['value' => $model->Kd_Kab])->label(false) ?>

    <?= $form->field($model, 'Nm_Kab')->textInput(['maxlength' => true])->label('Nama Kabupaten') ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
