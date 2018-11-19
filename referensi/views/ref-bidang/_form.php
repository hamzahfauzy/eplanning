<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefBidang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-bidang-form">

    <?php $form = ActiveForm::begin(); ?>

   <!--  <?= $form->field($model, 'Kd_Urusan')->textInput() ?>

    <?= $form->field($model, 'Kd_Bidang')->textInput() ?>

    

    <?= $form->field($model, 'Kd_Fungsi')->textInput() ?> -->

  <?= $form->field($model, 'Kd_Urusan')->dropdownlist(Yii::$app->runAction('ajax/urusan'))->label('Urusan') ?>
  <?= $form->field($model, 'Kd_Bidang')->hiddenInput(['value' => $model->Kd_Bidang])->label(false) ?>
  <?= $form->field($model, 'Nm_Bidang')->textInput(['maxlength' => true]) ?>
  <?= $form->field($model, 'Kd_Fungsi')->dropdownlist(Yii::$app->runAction('ajax/fungsi'))->label('Fungsi') ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
