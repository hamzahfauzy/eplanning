<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefRekAset3 */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/drepdrop-satuan.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Aset2=array();
?>

<div class="ref-rek-aset3-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Aset1')->dropDownList($dataAset, ['prompt'=>'Pilih Aset 1', 'id'=>'Kd_Aset1']) ?>

    <?= $form->field($model, 'Kd_Aset2')->dropDownList($Kd_Aset2, ['prompt'=>'Pilih Aset2', 'id'=>'Kd_Aset2']) ?>

    <?= $form->field($model, 'Kd_Aset3')->textInput() ?>

    <?= $form->field($model, 'Nm_Aset3')->textInput(['maxlength' => true]) ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>
