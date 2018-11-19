<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\RefRek2;


/* @var $this yii\web\View */
/* @var $model common\models\RefRek3 */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/dropdown.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Rek_2=array();

?>

<div class="ref-rek3-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'Kd_Rek_1')->dropDownList( $dataRek, ['prompt' => '-Pilih Rek 1-', 'id' => 'Kd_Rek_1'])->label('Rek 1');?>

    <?= $form->field($model, 'Kd_Rek_2')->dropDownList($Kd_Rek_2, ['prompt'=>'-Pilih Rek 2-', 'id'=>'Kd_Rek_2']) ?>

  
    <?= $form->field($model, 'Kd_Rek_3')->textInput() ?>


    <?= $form->field($model, 'Nm_Rek_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SaldoNorm')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
