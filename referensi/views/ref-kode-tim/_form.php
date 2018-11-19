<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefKodeTim */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kode-tim-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Tim')->textInput() ?>

    <?= $form->field($model, 'Nm_Tim')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
