<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefGolonganRuang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-golongan-ruang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Golongan')->textInput() ?>

    <?= $form->field($model, 'Kd_Golongan_Ruang')->textInput() ?>

    <?= $form->field($model, 'Nm_Golongan_Ruang')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
