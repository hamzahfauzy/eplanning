<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\jui\DatePicker;
use kartik\date\DatePicker;
//use yii\widgets\ActiveField;


$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ta-kalender-form">
		<?php $form = ActiveForm::begin() ?>
		<?= $form->field($model, 'Nm_Lengkap')->textInput(); ?>
		<?php 
			echo $form->field($model, 'Tgl_Lahir')
			->widget(DatePicker::className(),
			['pluginOptions'=> 
				['format' => 'yyyy-m-dd' ,'options'=>['class'=>'form-control']
			]
			]); 
		?>
		<?= $form->field($model, 'Alamat')->textInput(); ?>
		<?= $form->field($model, 'Telp')->textInput(); ?>
		<?= $form->field($model, 'Mobile')->textInput(); ?>
		

    <!-- /.box-body -->
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-right' : 'btn btn-primary pull-right']) ?>
    </div>
</div>
<!-- /.box -->
<?php ActiveForm::end(); ?>