<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk3 */
/* @var $form yii\widgets\ActiveForm */
/*
$this->registerJsFile(
    '@web/js/drepdrop-satuan.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
*/
$Kd_Hspk2=array();
?>

<div class="ref-hspk3-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Hspk1')->dropDownList($dataHspk, ['prompt'=>'Pilih HSPK', 'id'=>'Kd_Hspk1']) ?>

     <?= $form->field($model, 'Kd_Hspk2')->dropDownList($model->isNewRecord ? $Kd_Hspk2 : $dataHspk2, ['prompt'=>'Pilih HSPK 2', 'id'=>'Kd_Hspk2']) ?>

    <?= $form->field($model, 'Kd_Hspk3')->textInput(['readonly'=>false, 'id'=>'Kd_Hspk3']) ?>

    <?= $form->field($model, 'Nm_Hspk3')->textInput(['maxlength' => true]) ?>

  
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
    //alert(Kd_Urusan);
    $.post('index.php?r=ajax/gethspk2&Kd_Hspk1='+Kd_Hspk1, function(data){
        //alert(data);
        $('#Kd_Hspk2').html(data);
    })
})

$('#Kd_Hspk2').change(function(){
    var Kd_Hspk1=$("#Kd_Hspk1").val();
    var Kd_Hspk2=$(this).val();

    $.post('index.php?r=ajax/gethspk3&Kd_Hspk1='+Kd_Hspk1+'&Kd_Hspk2='+Kd_Hspk2, function(data){
        $('#Kd_Hspk3').html(data);
    })
})


$('#Kd_Hspk2').change(function(){
    var Kd_Hspk1=$("#Kd_Hspk1").val();
    var Kd_Hspk2=$(this).val();

    $.post('index.php?r=ajax/get-nomor-hspk3&Kd_Hspk1='+Kd_Hspk1+'&Kd_Hspk2='+Kd_Hspk2+'&Kode1=<?= $model->Kd_Hspk1.$model->Kd_Hspk2 ?>'+'&Kode2=<?= $model->Kd_Hspk3 ?>', function(data){
        $('#Kd_Hspk3').val(data);
    })
})
</script>