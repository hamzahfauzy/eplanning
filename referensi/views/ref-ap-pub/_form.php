<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefApPub */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-ap-pub-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Ap_Pub')->textInput() ?>

    <?= $form->field($model, 'Nm_Ap_Pub')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
