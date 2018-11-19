<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Referensi;

$referensi=new Referensi();

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */
/* @var $form yii\widgets\ActiveForm */
$urusan=$referensi->getUrusan();
$js="
$('#kdurusan').change(function(){
    id=$('#kdurusan').val();
    $.post('index.php?r=ref-program/listbidang&urusan='+id, function(data, status){
        $('#kdbidang').html(data);
       // alert(data);
    })
});

$('#kdbidang').change(function(){
    id=$('#kdbidang').val();
    urusan=$('#kdurusan').val();
    $.post('index.php?r=ref-program/listprogram&urusan='+urusan+'&bidang='+id, function(data, status){
        $('#kdprog').html(data);
    })
});

$('#prioritas').change(function(){
        prioritas=$('#prioritas').val();
        $.post('index.php?r=programs/listnawacita&id='+prioritas,
    		    function(data, status){
        		    $('#nawacita').val(data);
    		    });

    	$.post('index.php?r=programs/idnawacita&id='+prioritas,
    		    function(data, status){
        		    $('#idnawacita').val(data);
        });
});
$('#urusan').change(function(){
        urusan=$('#urusan').val();
        $.post('index.php?r=program-nasional/listmisi&id='+urusan,
    		    function(data, status){
        		    $('#misi').val(data);
    		    });
    	$.post('index.php?r=program-nasional/idmisi&id='+urusan,
    		    function(data, status){
        		    $('#id_misi').val(data);
    		    });

    });

";
$this->registerJs($js, 4, 'urusan');
$prog=array();
$bidang=array();
$prioritas=$referensi->getPrioritas();
$urusandaerah=$referensi->getUrusandaerah();
//$kdurusan=$this->context->getKdurusan();
?>

<div class="ref-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'urusan')->dropDownList($urusan,['prompt'=>'Pilih Urusan', 'id'=>'kdurusan'])->label('Urusan') ?>

    <?= $form->field($model, 'bidang')->dropDownList($bidang, ['prompt'=>'Pilih Sektor', 'id'=>'kdbidang'])->label('Sektor') ?>

    <?= $form->field($model, 'id_prioritas')->dropDownList($prioritas, ['prompt'=>'Pilih Prioritas', 'id'=>'prioritas'])->label('Prioritas Nasional') ?>

    <?= $form->field($model, 'nawacita')->textInput(['maxlength' => true, 'id'=>'nawacita', 'readonly'=>true]) ?>
    <?= $form->field($model, 'id_nawacita')->hiddenInput(['maxlength' => true, 'id'=>'idnawacita', 'readonly'=>true])->label(''); ?>

     <?= $form->field($model, 'id_urusan')->dropDownList($urusandaerah, ['prompt'=>'Pilih Urusan', 'id'=>'urusan'])->label('Urusan Provinsi') ?>

    <?= $form->field($model, 'misi')->textInput(['maxlength' => true, 'id'=>'misi'])->label('Visi Misi Provinsi') ?>

    <?= $form->field($model, 'id_misi')->hiddenInput(['maxlength' => true, 'id'=>'id_misi'])->label('') ?>

    <?= $form->field($model, 'id_program')->dropDownList($prog, ['prompt'=>'Pilih Program', 'id'=>'kdprog'])->label('Program'); ?>

    <?php //$form->field($model, 'Ket_Program')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
         <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>