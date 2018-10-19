<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefProgram;
use common\models\RefStandardSatuan;
use common\models\RefSubUnit;
use common\models\RefUnit;
use emusrenbang\models\TaKegiatan1;
/* @var $this yii\web\View */
/* @var $model app\models\RefKegiatan */
/* @var $form yii\widgets\ActiveForm */


if ($model->Kd_Keg=="") {
	//echo "tes ajjah";
	$js = '$("#urusan").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-bidang",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val()},
    success: function(data){
        $("#bidang").html(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});
    $("#bidang").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-unit",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val(), Kd_Bidang: $("#bidang").val()},
    success: function(data){
        $("#unit").html(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});

    $("#unit").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-sub",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val(), Kd_Bidang: $("#bidang").val(), Kd_Unit: $("#unit").val()},
    success: function(data){
        $("#sub_unit").html(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});

    $("#sub_unit").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-program",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val(), Kd_Bidang: $("#bidang").val(),Kd_Unit: $("#unit").val(),Kd_Sub: $("#sub_unit").val()},
    success: function(data){
        $("#program").html(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});


    $("#program").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-kode",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val(), Kd_Bidang: $("#bidang").val(), Kd_Prog: $("#program").val()},
    success: function(data){
        $("#kegiatan").val(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});

$(".selects").select2({
  allowClear: true
});
';
}
else
{
	
	$js = '$("#urusan").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-bidang",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val()},
    success: function(data){
        $("#bidang").html(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});
    $("#bidang").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-unit",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val(), Kd_Bidang: $("#bidang").val()},
    success: function(data){
        $("#unit").html(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});

    $("#unit").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-sub",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val(), Kd_Bidang: $("#bidang").val(), Kd_Unit: $("#unit").val()},
    success: function(data){
        $("#sub_unit").html(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});

    $("#sub_unit").change(function(){
    $.ajax({
    url: "index.php?r=ref-kegiatan/get-program",
    type: "GET",
    data: {Kd_Urusan: $("#urusan").val(), Kd_Bidang: $("#bidang").val(),Kd_Unit: $("#unit").val(),Kd_Sub: $("#sub_unit").val()},
    success: function(data){
        $("#program").html(data);
    },
    error: function(xhr, stat, err){
        alert(xhr.responseText);
    }
});});



$(".selects").select2({
  allowClear: true
});
';
}


    

$this->registerJs($js);

$this->registerCssFile(
        '@web/plugins/select2/select2.css'
);

$this->registerCssFile(
        '@web/plugins/select2/select2-bootstrap.css'
);

$this->registerJsFile(
        '@web/plugins/select2/select2.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="ref-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'Kd_Urusan')->dropdownList (
        ArrayHelper::map(RefUrusan::find()->all(),'Kd_Urusan','Nm_Urusan'),
        ['prompt' => 'Pilih Urusan', 'id' => 'urusan']
    ) ?>

    <?= $form->field($model, 'Kd_Bidang')->dropdownList (
        ArrayHelper::map(RefBidang::find()->all(),'Kd_Bidang','Nm_Bidang'),
        ['prompt' => 'Pilih Bidang', 'id' => 'bidang']
    ) ?>

		
     <?= $form->field($model, 'Kd_Unit')->dropDownList($model->isNewRecord ? [] : [], ['prompt'=>'Pilih Unit', 'id'=>'unit','class'=>'form-control'])->label('Unit') ?>

    <?= $form->field($model, 'Kd_Sub_Unit')->dropDownList($model->isNewRecord ? [] : [], ['prompt'=>'Pilih Sub Unit', 'id'=>'sub_unit','class'=>'form-control'])->label('Sub Unit') ?>
	
    <?= $form->field($model, 'Kd_Prog')->dropdownList (
        ArrayHelper::map(RefProgram::find()->all(),'Kd_Prog','Ket_Program'),
        ['prompt' => 'Pilih Program', 'id' => 'program', 'class'=>'form-control selects' ]
    ) ?> 
<?php 
if ($model->Kd_Keg=="") 
{ 
	echo $form->field($model, 'Kd_Keg')->textInput(['id' => 'kegiatan', 'readonly'=>true]); 
}
else
{ 
echo $form->field($model, 'Kd_Keg')->textInput(['id' => 'kegiatan']);
}
?>

    <?= $form->field($model, 'Ket_Kegiatan')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'Indikator')->textInput(['maxlength' => true]) ?>


<?= $form->field($model, 'Satuan0')->dropdownList (
        ArrayHelper::map(RefStandardSatuan::find()->all(),'Uraian','Uraian'),
        ['prompt' => 'Pilih Satuan', 'id' => 'satuan', 'class'=>'form-control selects' ]) ?>

 <?= $form->field($model, 'Target0')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Pagu_Indikatif')->textInput(['maxlength' => true]) ?>

 <?= $form->field($model, 'Target1')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Tahun_Pertama')->textInput(['maxlength' => true]) ?>

 <?= $form->field($model, 'Target2')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Tahun_Kedua')->textInput(['maxlength' => true]) ?>

 <?= $form->field($model, 'Target3')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Tahun_Ketiga')->textInput(['maxlength' => true]) ?>

 <?= $form->field($model, 'Target4')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Tahun_Keempat')->textInput(['maxlength' => true]) ?>

 <?= $form->field($model, 'Target5')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Tahun_Kelima')->textInput(['maxlength' => true]) ?>

 <?= $form->field($model, 'Target6')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Tahun_Akhir')->textInput(['maxlength' => true]) ?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
  
    <?php ActiveForm::end(); ?>

</div>
