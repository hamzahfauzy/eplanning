<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-entry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput() ?>

    <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    <?= $form->field($model, 'Kd_Unit')->textInput() ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Kd_Penandatangan')->textInput() ?>

    <?= $form->field($model, 'Nm_Penandatangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Penandatangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Penandatangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jns_Dokumen')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
