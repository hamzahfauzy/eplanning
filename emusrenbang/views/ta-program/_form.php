<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\TaProgram */
/* @var $form yii\widgets\ActiveForm */
$dataBidang = [];
$dataUnit = [];
$dataSub = [];
$dataProg = [];
$dataUrusan1 = [];
$dataBidang1 = [];

$this->registerJsFile(
        '@web/js/tambah_ta_program.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

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
<div class="ta-program-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Tahun')->hiddenInput(['value' => date('Y')])->label(false) ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'dataUrusan']) ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($dataBidang, ['prompt'=>'Pilih Bidang', 'id'=>'Kd_Bidang']) ?>

    <?php // $form->field($model, 'Kd_Urusan1')->dropDownList($dataUrusan, ['prompt'=>'Pilih Urusan', 'id'=>'dataUrusan1']) ?>

    <?php // $form->field($model, 'Kd_Bidang1')->dropDownList($dataBidang1, ['prompt'=>'Pilih Bidang', 'id'=>'Kd_Bidang1']) ?>

    <?= $form->field($model, 'Kd_Unit')->dropDownList($dataUnit, ['prompt'=>'Pilih Unit', 'id'=>'Kd_Unit']) ?>
    
    <?= $form->field($model, 'Kd_Sub')->dropDownList($dataSub, ['prompt'=>'Pilih Sub Unit', 'id'=>'Kd_Sub']) ?>
	

    <?= $form->field($model, 'ID_Prog')->hiddenInput()->label(false) ?>


    <?= $form->field($model, 'Kd_Prog')->dropDownList($dataProg, ['prompt'=>'Pilih Program', 'id'=>'Ket_Prog', 'class'=>'form-control selects']) ?>

    <?= $form->field($model, 'Ket_Prog')->textInput(['maxlength' => true, 'id' => 'ket_prg', 'readonly'=>true]) ?>

    <?= $form->field($model, 'Tolak_Ukur')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'Target_Angka')->hiddenInput(['label'=>false])->label(false) ?>

    <?= $form->field($model, 'Target_Uraian')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?php // $form->field($model, 'Kd_Urusan1')->hiddenInput()->label(false) ?>

    <?php // $form->field($model, 'Kd_Bidang1')->hiddenInput()->label(false) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">
$('#dataUrusan').change(function(){
    var dataUrusan=$(this).val();

    $.post('index.php?r=ajax/getbidangprog&Kd_Urusan='+dataUrusan, function(data){

        $('#Kd_Bidang').html(data);
    })
})



$('#Kd_Bidang').change(function(){
    var dataUrusan=$("#dataUrusan").val();
    var Kd_Bidang=$(this).val();


     $.post('index.php?r=ajax/getunitprog&Kd_Urusan='+dataUrusan+'&Kd_Bidang='+Kd_Bidang, function(data){

         $('#Kd_Unit').html(data);
     })
 })



$('#Kd_Unit').change(function(){
    var dataUrusan=$("#dataUrusan").val();
    var Kd_Bidang=$("#Kd_Bidang").val();
    var Kd_Unit=$(this).val();


    $.post('index.php?r=ajax/getsubprog&Kd_Urusan='+dataUrusan+'&Kd_Bidang='+Kd_Bidang+'&Kd_Unit='+Kd_Unit, function(data){

        $('#Kd_Sub').html(data);
    })
})

$('#Kd_Sub').change(function(){
    var dataUrusan=$("#dataUrusan").val();
    var Kd_Bidang=$("#Kd_Bidang").val();
	var Kd_Unit=$("#Kd_Unit").val();
    var Kd_Sub=$(this).val();


    $.post('index.php?r=ajax/getrefprog1&Kd_Urusan='+dataUrusan+'&Kd_Bidang='+Kd_Bidang+'&Kd_Unit='+Kd_Unit+'&Kd_Sub_Unit='+Kd_Sub, function(data){

        $('#Ket_Prog').html(data);
    })
})

$('#Ket_Prog').change(function(){

    var ket=$("#Ket_Prog option:selected").text();
    //$('#ket_prg').val("");
     $('#ket_prg').val(ket);


})

$(".selects").select2({
  allowClear: true
});


</script>

