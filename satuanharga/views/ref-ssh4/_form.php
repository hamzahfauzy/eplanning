<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh4 */
/* @var $form yii\widgets\ActiveForm */
// $this->registerJsFile(
//     '@web/js/drepdrop-satuan.js',
//     ['depends' => [\yii\web\JqueryAsset::className()]]
// );
$Kd_Ssh2=array();
$Kd_Ssh3=array();
?>

<div class="ref-ssh4-form">

    <?php $form = ActiveForm::begin(); ?>
     <?= $form->field($model, 'Kd_Ssh1')->dropDownList($dataSsh, ['prompt'=>'Pilih SSH1', 'id'=>'Kd_Ssh1']) ?>

    <?= $form->field($model, 'Kd_Ssh2')->dropDownList($model->isNewRecord ? $Kd_Ssh2 : $dataSsh2, ['prompt'=>'Pilih SSH2', 'id'=>'Kd_Ssh2']) ?>


    <?= $form->field($model, 'Kd_Ssh3')->dropDownList($model->isNewRecord ? $Kd_Ssh3 : $dataSsh3, ['prompt'=>'Pilih SSH3', 'id'=>'Kd_Ssh3']) ?>
    <?= $form->field($model, 'Kd_Ssh4')->textInput(['id'=>'Kd_Ssh4']) ?>

    <?= $form->field($model, 'Nm_Ssh4')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<script type="text/javascript">
$('#Kd_Ssh1').change(function(){
    var Kd_Ssh1=$(this).val();
    $.post('index.php?r=ajax/getssh2&Kd_Ssh1='+Kd_Ssh1, function(data){
       
        $('#Kd_Ssh2').html(data);
    })
})

$('#Kd_Ssh2').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$(this).val();
    $.post('index.php?r=ajax/getssh3&Kd_Ssh1='+Kd_Ssh1+'&Kd_Ssh2='+Kd_Ssh2, function(data){
        $('#Kd_Ssh3').html(data);
    })
})

$('#Kd_Ssh3').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$("#Kd_Ssh2").val();
    var Kd_Ssh3=$(this).val();

    $.post('index.php?r=ajax/max-ssh4&Kd_Ssh1='+Kd_Ssh1+
                                    '&Kd_Ssh2='+Kd_Ssh2+
                                    '&Kd_Ssh3='+Kd_Ssh3+
                                    '&Kode1=<?= $model->Kd_Ssh1.$model->Kd_Ssh2.$model->Kd_Ssh3 ?>'+'&Kode2=<?= $model->Kd_Ssh4 ?>', function(data){
        $('#Kd_Ssh4').val(data);
    })
})
</script>