<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaSubUnit */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(
'@web/js/dropdown.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$Kd_Bidang=array();
$Kd_Unit=array();
?>

<div class="ta-sub-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'Kd_Urusan']) ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($Kd_Bidang, ['prompt'=>'Pilih Bidang', 'id'=>'Kd_Bidang']) ?>

    <?= $form->field($model, 'Kd_Unit')->dropDownList($Kd_Unit, ['prompt'=>'Pilih Unit', 'id'=>'Kd_Unit']) ?>

    <?= $form->field($model, 'Kd_Sub')->textInput() ?>

    <?= $form->field($model, 'Nm_Pimpinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nip_Pimpinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Jbt_Pimpinan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ur_Visi')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
