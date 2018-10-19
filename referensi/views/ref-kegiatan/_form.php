<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefKegiatan */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
'@web/js/dropdown.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$Kd_Bidang_Prog=array();
$Kd_Prog=array();

?>

<div class="ref-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'Kd_Urusan')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'Kd_Urusan'])->label('Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($Kd_Bidang_Prog, ['prompt'=>'Pilih Bidang', 'id'=>'Kd_Bidang'])->label('Bidang') ?>

     <?= $form->field($model, 'Kd_Prog')->dropDownList($Kd_Prog, ['prompt'=>'Pilih Program', 'id'=>'Kd_Prog'])->label('Program') ?>

    <?= $form->field($model, 'Kd_Keg')->textInput() ?>

    <?= $form->field($model, 'Ket_Kegiatan')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
