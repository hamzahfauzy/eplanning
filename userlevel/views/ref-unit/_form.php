<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use emusrenbang\models\Referensi;

$ref= new Referensi();
$urusan=$ref->getUrusan();

/* @var $this yii\web\View */
/* @var $model app\models\RefUnit */
/* @var $form yii\widgets\ActiveForm */
$js="
$('#kdurusan').change(function(){
    kdurusan=$('#kdurusan').val();
    $.post('index.php?r=ajax/getbidang&KdUrusan='+kdurusan, function(data, success){
        $('#kdbidang').html(data);
		
    });
});
$('#kdbidang').change(function(){
     kdurusan=$('#kdurusan').val();
     kdbidang=$('#kdbidang').val();
     /*$.post('index.php?r=ajax/getunit&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
        $('#kdunit').html(data);
    });*/
    $.post('index.php?r=ajax/getidunit&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
        $('#kdunit').val(data);
		
    });
});
";
if(!empty($model->Kd_Urusan)){
       $bidang=$ref->getBidangUrusan($model->Kd_Urusan);
       //$unit=$ref->getUnitBidangUrusan($model->Kd_Urusan, $model->Kd_Bidang);
}else{

        $bidang=array();
        //$unit=array();
}

$this->registerJs($js, 4, "My");
?>

<div class="ref-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan, [ 'prompt' =>'Pilih Urusan', 'id' => 'kdurusan']) ?>
	
	
    <?= $form->field($model, 'Kd_Bidang')->dropDownList($bidang, ['Prompt' => 'Pilih Sektor', 'id'=>  'kdbidang']) ?>

    <?= $form->field($model, 'Kd_Unit')->textInput(['id'=>'kdunit']) ?>

    <?= $form->field($model, 'Nm_Unit')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
