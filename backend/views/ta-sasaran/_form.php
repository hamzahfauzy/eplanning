<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaSasaran */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(
'@web/js/dropdown.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$Kd_Bidang=array();
$Kd_Unit=array();
$Kd_Sub=array();
$No_Misi=array();
$No_Tujuan=array();
?>

<div class="ta-sasaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->textInput() ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'Kd_Urusan']) ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($Kd_Bidang, ['prompt'=>'Pilih Bidang', 'id'=>'Kd_Bidang']) ?>

    <?= $form->field($model, 'Kd_Unit')->dropDownList($Kd_Unit, ['prompt'=>'Pilih Unit', 'id'=>'Kd_Unit']) ?>

    <?= $form->field($model, 'Kd_Sub')->dropDownList($Kd_Sub, ['prompt'=>'Pilih Sub Unit', 'id'=>'Kd_Sub']) ?>

    <?= $form->field($model, 'No_Misi')->dropDownList($No_Misi, ['prompt'=>'Pilih Misi', 'id'=>'No_Misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->dropDownList($No_Tujuan, ['prompt'=>'Pilih Misi', 'id'=>'No_Tujuan']) ?>

    <?= $form->field($model, 'No_Sasaran')->textInput() ?>

    <?= $form->field($model, 'Ur_Sasaran')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
