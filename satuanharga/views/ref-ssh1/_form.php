<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh1 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-ssh1-form">

    <?php $form = ActiveForm::begin(); ?>

     <div style="display: none">
    <? //echo  $form->field($model, 'Kd_Ssh1')->textInput(['readonly' => false]) ?>
    </div>
    <?= $form->field($model, 'Kd_Ssh1')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Nm_Ssh1')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
