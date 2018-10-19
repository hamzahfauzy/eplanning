<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaTujuan */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
'@web/js/dropdown.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="ta-tujuan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->hiddenInput(['maxlength' => true, 'value'=>2017])->label(false) ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($dataUrusan, ['id'=>'Kd_Urusan']) ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($dataBidang, ['id'=>'Kd_Bidang']) ?>

    <?= $form->field($model, 'Kd_Unit')->dropDownList($dataUnit, ['id'=>'Kd_Unit']) ?>

    <?= $form->field($model, 'Kd_Sub')->dropDownList($dataSub, ['id'=>'Kd_Sub']) ?>

    <?= $form->field($model, 'No_Misi')->dropDownList($dataMisi, ['prompt' =>'Pilih Misi' ,'id'=>'No_Misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->textInput() ?>

    <?= $form->field($model, 'Ur_Tujuan')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
