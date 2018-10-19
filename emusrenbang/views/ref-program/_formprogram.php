<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use emusrenbang\models\Referensi;

$referensi=new Referensi();

/* @var $this yii\web\View */
/* @var $model app\models\RefProgram */
/* @var $form yii\widgets\ActiveForm */
$urusan=$this->context->getUrusan();
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
    $.post('index.php?r=ajax/listkamusprogrampilihan', function(data, status){
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
// $('#proses').click(function(){
//     kdprog=$('#kdprog').val();
//     prioritas=$('#prioritas').val();
//     nawacita=$('#idnawacita').val();
//     kdurusan=$('#kdurusan').val();
//     kdbidang=$('#kdbidang').val();
//     id_misi=$('#id_misi').val();

//     if(kdprog==0){
//         l='<a href=index.php?r=ref-program/tambah&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+' class=\'btn btn-primary\'>Tambah Program</a>';
//         $('#tprog').html(l);
//     }else{

//         $.post('index.php?r=ref-program/programnas&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog,
//             function(data, status)
//             {
//                 if(status='success'){
//                     l='<a href=index.php?r=ref-program/capaianprogram&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+' class=\'btn btn-primary\'>Capaian Program</a>';
//                     $('#tprog').html('');
//                 }
//             }
//         )
//     }
// });

 $('#bttnPros').click(function(){
    if($('#kdprog').val()==0){
        alert('Silahkan Pilih Program Pembangunan');
        return false;
    }
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

    <?= $form->field($model, 'Kd_Urusan')->dropDownList($urusan,['prompt'=>'Pilih Urusan', 'id'=>'kdurusan'])->label('Urusan') ?>

    <?= $form->field($model, 'Kd_Bidang')->dropDownList($model->isNewRecord ? : $bidang, ['prompt'=>'Pilih Sektor', 'id'=>'kdbidang','class'=>'form-control select2'])->label('Sektor') ?>

    <?= $form->field($model, 'id_prioritas')->dropDownList($prioritas, ['prompt'=>'Pilih Prioritas', 'id'=>'prioritas','class'=>'form-control select2'])->label('Prioritas Nasional') ?>

    <?= $form->field($model, 'nawacita')->textInput(['id'=>'nawacita', 'readonly'=>true]) ?>

     <?= $form->field($model, 'id_urusan')->dropDownList($urusandaerah, ['prompt'=>'Pilih Urusan', 'id'=>'urusan','class'=>'form-control select2'])->label('Urusan Pembangunan Provsu') ?>

    <?= $form->field($model, 'misi')->textInput(['id'=>'misi','readonly'=>true])->label('Misi Pembangunan Provsu') ?>

    <?= $form->field($model, 'Kd_Prog')->dropDownList($prog, ['prompt'=>'Pilih Program', 'id'=>'kdprog','class'=>'form-control select2'])->label('Program Pembangunan'); ?>

    <?php //$form->field($model, 'Ket_Program')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'bttnPros']) ?>
    </div>

    <div style="display:none">
    <?= $form->field($model, 'id_nawacita')->hiddenInput(['maxlength' => true, 'id'=>'idnawacita'])->label(''); ?>
    <?= $form->field($model, 'id_misi')->hiddenInput(['maxlength' => true, 'id'=>'id_misi'])->label('') ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div style="margin-bottom:50px"></div>
<!-- <table class="table" style="background-color:#ccc">
<tr>
    <td>
        <div id="tprog"></div>
    </td>
</tr>
</table> -->
