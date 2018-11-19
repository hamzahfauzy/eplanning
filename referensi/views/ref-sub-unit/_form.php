<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;

/* @var $this yii\web\View */
/* @var $model common\models\RefSubUnit */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(
'@web/js/dropdown.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$Kd_Bidang=array();
$Kd_Unit=array();

?>



<div class="ref-sub-unit-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'Kd_Urusan')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'Kd_Urusan'])->label('Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($Kd_Bidang, ['prompt'=>'Pilih Bidang', 'id'=>'Kd_Bidang'])->label('Bidang') ?>

    <?= $form->field($model, 'Kd_Unit')->dropDownList($Kd_Unit, ['prompt'=>'Pilih Unit', 'id'=>'Kd_Unit'])->label('Unit') ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Nm_Sub_Unit')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
