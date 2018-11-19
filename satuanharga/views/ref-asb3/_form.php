<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb3 */
/* @var $form yii\widgets\ActiveForm */
// $this->registerJsFile(
//     '@web/js/drepdrop-satuan.js',
//     ['depends' => [\yii\web\JqueryAsset::className()]]
// );
$Kd_Asb2=array();
$Kd_Asb3=array();
?>

<div class="ref-asb3-form">

    <?php $form = ActiveForm::begin(); ?>

    
     <?= $form->field($model, 'Kd_Asb1')->dropDownList($dataAsb, ['prompt'=>'Pilih ASB1', 'id'=>'Kd_Asb1']) ?>

    <?= $form->field($model, 'Kd_Asb2')->dropDownList($model->isNewRecord ? $Kd_Asb2 : $dataAsb2, ['prompt'=>'Pilih ASB2', 'id'=>'Kd_Asb2']) ?>

    <?= $form->field($model, 'Kd_Asb3')->textInput(['id' => 'Kd_Asb3']) ?>

    <?= $form->field($model, 'Nm_Asb3')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
$('#Kd_Asb1').change(function(){
    var Kd_Asb1=$(this).val();
    $('#kdasb1').val(Kd_Asb1);
    //alert(Kd_Urusan);
    $.post('index.php?r=ajax/getasb2&Kd_Asb1='+Kd_Asb1, function(data){
        //alert(data);
        $('#Kd_Asb2').html(data);
    })
})

$('#Kd_Asb2').change(function(){
    var Kd_Asb1=$('#Kd_Asb1').val();
    var Kd_Asb2=$(this).val();

    $.post('index.php?r=ajax/max-asb3&Kd_Asb1='+Kd_Asb1+
                                    '&Kd_Asb2='+Kd_Asb2+
                                    '&Kode1=<?= $model->Kd_Asb1.$model->Kd_Asb2 ?>'+'&Kode2=<?= $model->Kd_Asb3 ?>', function(data){
        $('#Kd_Asb3').val(data);
    })
})
</script>
