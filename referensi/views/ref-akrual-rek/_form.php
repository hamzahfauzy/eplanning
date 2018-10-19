<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAkrualRek */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-akrual-rek-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Rek_1')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_2')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_3')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_4')->textInput() ?>

    <?= $form->field($model, 'Kd_Rek_5')->textInput() ?>

    <?= $form->field($model, 'Kd_Akrual_1')->textInput() ?>

    <?= $form->field($model, 'Kd_Akrual_2')->textInput() ?>

    <?= $form->field($model, 'Kd_Akrual_3')->textInput() ?>

    <?= $form->field($model, 'Kd_Akrual_4')->textInput() ?>

    <?= $form->field($model, 'Kd_Akrual_5')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualD_1')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualD_2')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualD_3')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualD_4')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualD_5')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualK_1')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualK_2')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualK_3')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualK_4')->textInput() ?>

    <?= $form->field($model, 'Kd_AkrualK_5')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
