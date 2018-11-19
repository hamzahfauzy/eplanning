<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\widgets\FileInput
/* @var $this yii\web\View */
/* @var $model common\models\TaProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-profile-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'Kd_User')->hiddenInput(['value'=>$id])->label(''); ?>

    <?= $form->field($model, 'Nm_Lengkap')->textInput(['maxlength' => true])->label('Nama Lengkap'); ?>

    <?= $form->field($model, 'Tgl_Lahir')->widget(DatePicker::className(), ['value' => date('y-m-d', strtotime('+2 days')),
    'options' => ['placeholder' => 'Tanggal Lahir'],
    'pluginOptions' => [
        'format' => 'yyyy-m-d',
        'todayHighlight' => true
    ]]) ?>

    <?= $form->field($model, 'Alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Mobile')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Nip')->textInput(['maxlength' => true]) ?>

	<?php
	if(isset($model->Foto)){	
	?>
		<img src="<?php echo "uploads/".$model->Foto; ?>" width="150">
	<?php
	}
	?>
    <?= $form->field($model, 'fileFoto')->widget(FileInput::classname(), [
    	'options' => ['accept' => 'image/*'],
	]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
