<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Referensi;

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

    if(kdprog==0){
        l='<a href=index.php?r=ref-program/tambah&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+' class=\'btn btn-primary\'>Tambah Program</a>';
        $('#tprog').html('');
    }else{

        $.post('index.php?r=ref-program/programnas&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog,
            function(data, status)
            {
                if(status='success'){
                    l='<a href=index.php?r=ta-capaian-program/create&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+' class=\'btn btn-primary\'>Capaian Program</a>';
                    $('#tprog').html(l);
                }
            }
        )
    }
});
";
if(Yii::$app->user->identity->id_level==1){
    $this->registerJs($js, 4, 'urusan');
    $prioritas=$referensi->getPrioritas();
    $urusandaerah=$referensi->getUrusandaerah();
}else{
    $js="
    $('#kdprog').change(function(){
        kdprog=$('#kdprog').val();
        kdurusan=$('#kdurusan').val();
        kdbidang=$('#kdbidang').val();
        $.post('index.php?r=ajax/getprioritas&kdprog='+kdprog+'&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
            $('#prioritas').html(data);
        });
        $.post('index.php?r=ajax/getnawacita&kdprog='+kdprog+'&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
            $('#nawacita').val(data);
        });
        $.post('index.php?r=ajax/getidnawacita&kdprog='+kdprog+'&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
            $('#idnawacita').val(data);
        });
        $.post('index.php?r=ajax/geturusan&kdprog='+kdprog+'&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
            $('#urusan').html(data);
        });
        $.post('index.php?r=ajax/getmisi&kdprog='+kdprog+'&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
            $('#misi').val(data);
        });
        $.post('index.php?r=ajax/getidmisi&kdprog='+kdprog+'&kdurusan='+kdurusan+'&kdbidang='+kdbidang, function(data, success){
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

    if(kdprog==0){
        l='<a href=index.php?r=ref-program/tambah&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+' class=\'btn btn-primary\'>Tambah Program</a>';
        $('#tprog').html('');
    }else{

        $.post('index.php?r=ref-program/programnas&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog,
            function(data, status)
            {
                if(status='success'){
                    l='<a href=index.php?r=ta-capaian-program/create&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+kdurusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+' class=\'btn btn-primary\'>Capaian Program</a>';
                    $('#tprog').html(l);
                }
            }
        )
    }
});
    ";
    $this->registerJs($js, 4, 'My');
    $prioritas=array();
    $urusandaerah=array();
    $kdurusan=Yii::$app->user->identity->id_urusan;
    $kdbidang=Yii::$app->user->identity->id_bidang;
    $prog=$referensi->getProgramBidangUrusan($kdurusan, $kdbidang);

}
$bidang=array();

//$kdurusan=$this->context->getKdurusan();
?>

<div class="ref-program-form">

    <?php $form = ActiveForm::begin(); ?>

       <?= $form->field($model, 'id_nawacita')->hiddenInput(['maxlength' => true, 'id'=>'idnawacita', 'readonly'=>true])->label(''); ?>
    <?= $form->field($model, 'id_prioritas')->dropDownList($prioritas, ['prompt'=>'Pilih Prioritas', 'id'=>'prioritas'])->label('Prioritas Nasional') ?>

    <?= $form->field($model, 'nawacita')->textInput(['maxlength' => true, 'id'=>'nawacita', 'readonly'=>true]) ?>

     <?= $form->field($model, 'id_urusan')->dropDownList($urusandaerah, ['prompt'=>'Pilih Urusan', 'id'=>'urusan'])->label('Urusan Provinsi') ?>

    <?= $form->field($model, 'misi')->textInput(['maxlength' => true, 'id'=>'misi', 'readonly'=>true])->label('Visi Misi Provinsi') ?>


    <?= $form->field($model, 'Kd_Prog')->dropDownList($prog, ['prompt'=>'Pilih Program', 'id'=>'kdprog'])->label('Program'); ?>

    <?php //$form->field($model, 'Ket_Program')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::Button($model->isNewRecord ? 'Proses' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
    </div>
 <?= $form->field($model, 'Kd_Urusan')->hiddenInput(['id'=>'kdurusan', 'value'=>$kdurusan])->label(''); ?>
     <?= $form->field($model, 'id_misi')->hiddenInput(['maxlength' => true, 'id'=>'id_misi'])->label('') ?>
    <?= $form->field($model, 'Kd_Bidang')->hiddenInput(['id'=>'kdbidang', 'value'=>$kdbidang])->label(''); ?>


    <?php ActiveForm::end(); ?>

</div>
<table class="table" style="background-color:#ccc">
<tr>
    <td>
        <div id="tprog"></div>
    </td>
</tr>
</table>
<div style="margin-bottom:100px"></div>
