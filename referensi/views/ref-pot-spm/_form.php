<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefPotSPM */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-pot-spm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Pot')->textInput() ?>

    <?= $form->field($model, 'Nm_Pot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_MAP')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
