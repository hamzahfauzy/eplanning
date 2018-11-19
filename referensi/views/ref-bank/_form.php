<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefBank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-bank-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Bank')->textInput() ?>

    <?= $form->field($model, 'Nm_Bank')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'No_Rekening')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Rek_1')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_2')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_3')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_4')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_5')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
