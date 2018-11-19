<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAnalisaSub */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="ref-analisa-sub-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Analisa')->dropDownList($dataAnalisa, ['prompt'=>'Pilih Analisa', 'id'=>'Kd_Analisa']) ?>

    <?= $form->field($model, 'Kd_Analisa_Sub')->textInput(['readonly'=> true]) ?>

    <?= $form->field($model, 'Nm_Analisa_Sub')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
