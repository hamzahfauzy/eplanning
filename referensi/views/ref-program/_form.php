<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\RefUrusan;
use common\models\RefBidang;

/* @var $this yii\web\View */
/* @var $model common\models\RefProgram */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/dropdown.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Bidang=array();

?>

<div class="ref-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'Kd_Urusan'])->label('Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($Kd_Bidang, ['prompt'=>'Pilih Bidang', 'id'=>'Kd_Bidang'])->label('Bidang') ?>

    <?= $form->field($model, 'Kd_Prog')->textInput() ?>

    <?= $form->field($model, 'Ket_Program')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
