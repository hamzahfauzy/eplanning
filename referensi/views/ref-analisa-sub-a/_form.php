<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAnalisaSubA */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/dropdown.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Analisa_Sub=array();
?>

<div class="ref-analisa-sub-a-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Analisa')->dropDownList($dataAnalisa, ['prompt'=>'Pilih Analisa', 'id'=>'Kd_Analisa']) ?>

    <?= $form->field($model, 'Kd_Analisa_Sub')->dropDownList($Kd_Analisa_Sub, ['prompt'=>'Pilih Sub Analisa', 'id'=>'Kd_Analisa_Sub']) ?>

    <?= $form->field($model, 'Kd_Analisa_Sub_A')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'Nm_Analisa_Sub_A')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
