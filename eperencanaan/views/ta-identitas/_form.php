<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaIdentitas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-identitas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id')->textInput() ?>

    <?= $form->field($model, 'Hostname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ip_Public')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Instansi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Created_At')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
