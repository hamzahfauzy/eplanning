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
$('#proses').click(function(){
    kdprog=$('#kdprog').val();
    prioritas=$('#prioritas').val();
    nawacita=$('#idnawacita').val();
    kdurusan=$('#kdurusan').val();
    kdbidang=$('#kdbidang').val();
    id_misi=$('#id_misi').val();
    kdkeg=$('#kdkeg').val();

    if(kdkeg==0){
        l='<a href=index.php?r=kegiatan-skpd/tambahref&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+' class=\'btn btn-primary\'>Tambah Program</a>';
        $('#tprog').html(l);
    }else{

        $.post('index.php?r=kegiatan-skpd/tambah&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg,
            function(data, status)
            {
                if(status='success'){
                    l='<a href=index.php?r=ta-kegiatan/create&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg+' class=\'btn btn-primary\'>Uraian Kegiatan</a>';
                    $('#tprog').html(l);
                }
            }
        )
    }
});

$('#kdprog').change(function(){
    kdurusan=$('#kdurusan').val();
    kdbidang=$('#kdbidang').val();
    kdprog=$('#kdprog').val();
    $.post('index.php?r=kegiatan-skpd/listkegiatan&urusan='+kdurusan+'&bidang='+kdbidang+'&prog='+kdprog,
    function(data, status)
    {
        $('#kdkeg').html(data);
    })
});
";
$this->registerJs($js, 4, 'urusan');
$prog=array();
$bidang=array();
$keg=array();
$prioritas=$referensi->getPrioritas();
$urusandaerah=$referensi->getUrusandaerah();
//$kdurusan=$this->context->getKdurusan();
?>

<div class="ref-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan,['prompt'=>'Pilih Urusan', 'id'=>'kdurusan'])->label('Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($bidang, ['prompt'=>'Pilih Sektor', 'id'=>'kdbidang'])->label('Sektor') ?>

    <?= $form->field($model, 'id_prioritas')->dropDownList($prioritas, ['prompt'=>'Pilih Prioritas', 'id'=>'prioritas'])->label('Prioritas Nasional') ?>

    <?= $form->field($model, 'nawacita')->textInput(['maxlength' => true, 'id'=>'nawacita', 'readonly'=>true]) ?>
    <?= $form->field($model, 'id_nawacita')->hiddenInput(['maxlength' => true, 'id'=>'idnawacita', 'readonly'=>true])->label(''); ?>

     <?= $form->field($model, 'id_urusan')->dropDownList($urusandaerah, ['prompt'=>'Pilih Urusan Pembangunan Provsu', 'id'=>'urusan'])->label('Urusan Pembangunan Provsu') ?>

    <?= $form->field($model, 'misi')->textInput(['maxlength' => true, 'id'=>'misi'])->label('Misi Pembangunan Provsu') ?>

    <?= $form->field($model, 'id_misi')->hiddenInput(['maxlength' => true, 'id'=>'id_misi'])->label('') ?>

    <?= $form->field($model, 'Kd_Program')->dropDownList($prog, ['prompt'=>'Pilih Program Pembangunan', 'id'=>'kdprog'])->label('Program Pembangunan') ?>

    <?= $form->field($model, 'Kd_Kegiatan')->dropDownList($keg, ['prompt'=>'Pilih Kegiatan Pembangunan', 'id'=>'kdkeg'])->label('Kegiatan Pembangunan') ?>

    <div class="form-group">
        <?= Html::Button($model->isNewRecord ? 'Proses' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div style="margin-bottom:50px"></div>
<table class="table" style="background-color:#ccc">
<tr>
    <td>
        <div id="tprog"></div>
    </td>
</tr>
</table>
<div style="margin-bottom:100px"></div>
