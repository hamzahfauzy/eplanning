<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefBenua */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-benua-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Benua')->textInput() ?>

    <?= $form->field($model, 'Nm_Benua')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
