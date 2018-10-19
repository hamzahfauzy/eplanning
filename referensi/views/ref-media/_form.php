<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefMedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-media-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Media')->textInput() ?>

    <?= $form->field($model, 'Jenis_Media')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Type_Media')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Judul_Media')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nm_Media')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Created_At')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
