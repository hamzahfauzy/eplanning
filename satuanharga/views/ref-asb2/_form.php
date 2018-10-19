<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-asb2-form">

    <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'Kd_Asb1')->dropDownList($dataAsb, ['prompt'=>'Pilih ASB1', 'id'=>'Kd_Asb1']) ?>

    <?= $form->field($model, 'Kd_Asb2')->textInput(['id' => 'Kd_Asb2']) ?>

    <?= $form->field($model, 'Nm_Asb2')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script type= "text/javascript">

$('#Kd_Asb1').change(function(){
    var Kd_Asb1=$(this).val();

    $.post('index.php?r=ajax/max-asb2&Kd_Asb1='+Kd_Asb1+
                                    '&Kode1=<?= $model->Kd_Asb1 ?>'+'&Kode2=<?= $model->Kd_Asb2 ?>', function(data){
        $('#Kd_Asb2').val(data);
    })
})
</script>