<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaMisi */
/* @var $form yii\widgets\ActiveForm */
// $this->registerJsFile(
?>

<div class="ta-misi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->hiddenInput(['maxlength' => true, 'value'=>2017])->label(false) ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($dataUrusan, ['id'=>'Kd_Urusan']) ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($dataBidang, ['id'=>'Kd_Bidang']) ?>

    <?= $form->field($model, 'Kd_Unit')->dropDownList($dataUnit, ['id'=>'Kd_Unit']) ?>

    <?= $form->field($model, 'Kd_Sub')->dropDownList($dataSub, ['id'=>'Kd_Sub']) ?>

    <?= $form->field($model, 'No_Misi')->textInput() ?>

    <?= $form->field($model, 'Ur_Misi')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
