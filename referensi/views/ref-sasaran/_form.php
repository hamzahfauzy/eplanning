<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefSasaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-sasaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Sasaran')->textInput() ?>

    <?= $form->field($model, 'Nm_Sasaran')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
