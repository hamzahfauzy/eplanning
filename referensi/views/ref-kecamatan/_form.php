<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefKecamatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kecamatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab')->textInput() ?> -->

     <?= $form->field($model, 'Kd_Prov')->hiddenInput(['value' => $model->Kd_Prov, 'id' => 'Kd_Prov_Id' ])->label(false) ?>

    <?= $form->field($model, 'Kd_Kab')->hiddenInput(['value' => $model->Kd_Kab, 'id' => 'Kd_Kab_Id' ])->label(false) ?>

    <?= $form->field($model, 'Kd_Kec')->textInput([/*'readonly' => true*/]) ?>

    <?= $form->field($model, 'Nm_Kec')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
