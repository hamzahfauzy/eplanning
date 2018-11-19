<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk2 */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    '@web/js/drepdrop-satuan.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$Kd_Hspk2=array();

?>
<div class="ref-hspk2-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Hspk1')->dropDownList($dataHspk, ['prompt'=>'Pilih HSPK', 'id'=>'Kd_Hspk1']) ?>

    <?= $form->field($model, 'Kd_Hspk2')->textInput([ 'id' => 'Kd_Hspk2']) ?>

    <?= $form->field($model, 'Nm_Hspk2')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>


<script type="text/javascript">

$('#Kd_Hspk1').change(function(){
    var Kd_Hspk1=$(this).val();

    $.post('index.php?r=ajax/get-nomor-hspk2&Kd_Hspk1='+Kd_Hspk1+'&Kode1=<?= $model->Kd_Hspk1 ?>'+'&Kode2=<?= $model->Kd_Hspk2 ?>', function(data){
        $('#Kd_Hspk2').val(data);
    })
})
</script>
