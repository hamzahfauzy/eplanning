<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Referensi;

$referensi=new Referensi();

/* @var $this yii\web\View */
/* @var $model app\models\RefPenilaianKegiatan */
/* @var $form yii\widgets\ActiveForm */

$urusan=$referensi->getUrusan();
$penilaian=$referensi->getRefPenilaian();
$js="
$('#kdurusan').change(function(){
    id=$('#kdurusan').val();
    $.post('index.php?r=ref-program/listbidang&urusan='+id, function(data, status){
        $('#kdbidang').html(data);
       // alert(data);
    })
});

$('#kdbidang').change(function(){
    urusan=$('#kdurusan').val();
	bidang=$('#kdbidang').val();
    $.post('index.php?r=ajax/listprogram&urusan='+urusan+'&bidang='+bidang, function(data, status){
        $('#kdprog').html(data);
    })
});

$('#kdprog').change(function(){
	urusan=$('#kdurusan').val();
	bidang=$('#kdbidang').val();
	prog=$('#kdprog').val();
    $.post('index.php?r=ajax/listkegiatan&urusan='+urusan+'&bidang='+bidang+'&kdprog='+prog, function(data, status){
        $('#kdkeg').html(data);
    })
});

";
$this->registerJs($js, 4, 'urusan');
$prog=array();
$bidang=array();
$keg=array();
?>

<div class="ref-penilaian-kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan,['prompt'=>'Pilih Urusan', 'id'=>'kdurusan'])->label('Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($bidang, ['prompt'=>'Pilih Sektor', 'id'=>'kdbidang', 'class'=>'form-control select2'])->label('Sektor') ?>

    <?= $form->field($model, 'Kd_Program')->dropDownList($prog, ['prompt'=>'Pilih Program', 'id'=>'kdprog', 'class'=>'form-control select2'])->label('Program Pembangunan'); ?>

    <?= $form->field($model, 'Kd_Kegiatan')->dropDownList($keg, ['prompt'=>'Pilih Kegiatan', 'id'=>'kdkeg', 'class'=>'form-control select2'])->label('Kegiatan Pembangunan') ?>

    <?= $form->field($model, 'ID_Penilaian')->textInput()->dropDownList($penilaian,['prompt'=>'Pilih Parameter Penilaian', 'id'=>'penilaian'])->label('Parameter Penilaian') ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <?php //$form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
