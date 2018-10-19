<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefCountry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Benua')->textInput() ?>

    <?= $form->field($model, 'Kd_Benua_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Benua_Sub_Negara')->textInput() ?>

    <?= $form->field($model, 'Nm_Negara')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
