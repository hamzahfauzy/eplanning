<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefPotSPMRek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-pot-spmrek-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Pot_Rek')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_1')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_2')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_3')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_4')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_5')->textInput() ?>

    <?= $form->field($model, 'Kd_Pot')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
