<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefKabupaten */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kabupaten-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Benua')->textInput() ?>

    <?= $form->field($model, 'Kd_Benua_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Benua_Sub_Negara')->textInput() ?>

    <?= $form->field($model, 'Kd_Prov')->textInput() ?>

    <?= $form->field($model, 'Kd_Kab')->textInput() ?>

    <?= $form->field($model, 'Nm_Kab')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
