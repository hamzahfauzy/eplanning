<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh2 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-ssh2-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Ssh1')->dropDownList($dataSsh, ['prompt'=>'Pilih SSH1', 'id'=>'Kd_Ssh1']) ?>


    <?= $form->field($model, 'Kd_Ssh2')->textInput([ 'id'=>'Kd_Ssh2']) ?>

    <?= $form->field($model, 'Nm_Ssh2')->textInput(['maxlength' => true]) ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>

<script type= "text/javascript">

$('#Kd_Ssh1').change(function(){
    var Kd_Ssh1=$(this).val();

    $.post('index.php?r=ajax/max-ssh2&Kd_Ssh1='+Kd_Ssh1+'&Kode1=<?= $model->Kd_Ssh1 ?>'+'&Kode2=<?= $model->Kd_Ssh2 ?>', function(data){
        $('#Kd_Ssh2').val(data);
    })
})
</script>