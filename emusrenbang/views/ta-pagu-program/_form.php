<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use emusrenbang\models\Referensi;

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

    $.post('index.php?r=ref-program/listunit&urusan='+urusan+'&bidang='+id, function(data, status){
        $('#kdunit').html(data);
    })
});

$('#kdunit').change(function(){
    bidang=$('#kdbidang').val();
    unit=$('#kdunit').val();
    urusan=$('#kdurusan').val();
    $.post('index.php?r=ref-program/listprogram&urusan='+urusan+'&bidang='+bidang, function(data, status){
        $('#kdprog').html(data);
    })
	
	$.post('index.php?r=ref-program/listsub&urusan='+urusan+'&bidang='+bidang+'&unit='+unit, function(data, status){
        $('#kdsub').html(data);
    })
});

";
$this->registerJs($js, 4, 'urusan');
$model->pagu=(int) $model->pagu;

?>

<div class="box box-success">
    <div class="box-body">
        <div class="ref-program-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan,['prompt'=>'Pilih Urusan', 'id'=>'kdurusan'])->label('Urusan') ?>

            <?= $form->field($model, 'Kd_Bidang')->dropDownList($bidang, ['prompt'=>'Pilih Sektor', 'id'=>'kdbidang'])->label('Sektor') ?>

             <?= $form->field($model, 'Kd_Unit')->dropDownList($unit, ['prompt'=>'Pilih Unit', 'id'=>'kdunit'])->label('Unit'); ?>
			 
             <?= $form->field($model, 'Kd_Sub')->dropDownList($sub, ['prompt'=>'Pilih Sub Unit', 'id'=>'kdsub'])->label('Sub Unit'); ?>

            <?= $form->field($model, 'Kd_Prog')->dropDownList($prog, ['prompt'=>'Pilih Program', 'id'=>'kdprog'])->label('Program Pembangunan'); ?>

            <?= $form->field($model, 'pagu')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Proses' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
