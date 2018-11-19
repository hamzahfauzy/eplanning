<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAnalisa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-analisa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Analisa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Analisa')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
