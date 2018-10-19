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

    if(!kdprog){
        alert('Silakah Pilih Program Terlebih Dahulu');
        return false;
    }

    if(kdkeg==0){
        l='<a href=index.php?r=kegiatan-skpd/tambahref&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&kdurusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+' class=\'btn btn-primary\'>Tambah Kegiatan</a>';
        $('#tprog').html(l);
        $('#tomKegiatan, #tomIndikator, #tableKegiatan, #tableIndikator').html('');
    }else{
        $('#tprog').html('');
        $('#tTable').html('');
        $.post('index.php?r=kegiatan-skpd/tambah&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg,
            function(data, status)
            {
                if(status='success'){
                    $('#tomKegiatan').html('<a href=index.php?r=ta-kegiatan/create&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+kdurusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg+' class=\'btn btn-primary\'>Uraian Kegiatan</a>');
                    $('#tomIndikator').html('<a href=index.php?r=ta-indikator/create&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+kdurusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg+' class=\'btn btn-primary\'>Indikator Kegiatan</a>');

                    $.post('index.php?r=ta-kegiatan/listkegiatan&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+kdurusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg,
                        function(data, status)
                        {
                             $('#tableKegiatan').html(data);
                        }
                    )
                    $.post('index.php?r=ta-indikator/listindikator&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+kdurusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg,
                        function(data, status)
                        {
                            $('#tableIndikator').html(data);
                        }
                    )
                }
            }
        )
    }
});

$('#kdprog').change(function(){
    $('#prioritas,#nawacita,#urusan,#misi').html('');
    alert('tes');
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
if(Yii::$app->user->identity->id_level==1){
    $this->registerJs($js, 4, 'urusan');
    $bidang=array();
    $prioritas=$referensi->getPrioritas();
    $urusandaerah=$referensi->getUrusandaerah();
}else{
    $js="
    $('#kdprog').change(function(){
        $('#prioritas, #nawacita, #urusan, #misi, #tprog, #tTable, #tomKegiatan, #tomIndikator, #tableKegiatan, #tableIndikator').html('');
        $('#nawacita, #misi').val('');

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

$('#proses').click(function(){
    kdprog=$('#kdprog').val();
    prioritas=$('#prioritas').val();
    nawacita=$('#idnawacita').val();
    kdurusan=$('#kdurusan').val();
    kdbidang=$('#kdbidang').val();
    id_misi=$('#id_misi').val();
    kdkeg=$('#kdkeg').val();
    urusan=$('#urusan').val();
    if(!kdprog){
        alert('Silakah Pilih Program Terlebih Dahulu');
        return false;
    }

    if(kdkeg==0){
        l='<a href=index.php?r=kegiatan-skpd/tambahref&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+' class=\'btn btn-primary\'>Tambah Kegiatan</a>';
        $('#tprog').html(l);
        $('#tomKegiatan, #tomIndikator, #tableKegiatan, #tableIndikator').html('');
    }else{
        $('#tprog').html('');
        $('#tTable').html('');
        $.post('index.php?r=kegiatan-skpd/tambah&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+kdurusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg,
            function(data, status)
            {
                if(status='success'){
                    $('#tomKegiatan').html('<a href=index.php?r=ta-kegiatan/create&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg+' class=\'btn btn-primary\'>Uraian Kegiatan</a> ');
                    $('#uploadfile').html('<a href=index.php?r=ta-kegiatan-file/create&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&kdprog='+kdprog+'&kdkeg='+kdkeg+' class=\'btn btn-primary\'>Upload File Pendukung Kegiatan</a> ');
                    $('#tomIndikator').html('<a href=index.php?r=ta-indikator/create&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+urusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg+' class=\'btn btn-primary\'>Indikator Kegiatan</a>');

                    $.post('index.php?r=ta-kegiatan/listkegiatan&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+kdurusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg,
                        function(data, status)
                        {
                             $('#tableKegiatan').html(data);
                        }
                    )
                    $.post('index.php?r=ta-indikator/listindikator&kdurusan='+kdurusan+'&kdbidang='+kdbidang+'&urusan='+kdurusan+'&prioritas='+prioritas+'&nawacita='+nawacita+'&misi='+id_misi+'&kdprog='+kdprog+'&kdkeg='+kdkeg,
                        function(data, status)
                        {
                             $('#tableIndikator').html(data);
                        }
                    )
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
$keg=array();
//$kdurusan=$this->context->getKdurusan();
?>

<style type="text/css">
    .tom .pull-left{
        margin-left: 10px;
    }

    .tom .pull-left:first-child{
        margin-left: 0px;
    }
</style>
<div class="ref-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Kd_Program')->dropDownList($prog, ['prompt'=>'Pilih Program', 'id'=>'kdprog','class'=>'form-control select2'])->label('Program') ?>

    <?= $form->field($model, 'id_prioritas')->dropDownList($prioritas, ['prompt'=>'', 'id'=>'prioritas', 'readonly'=>true])->label('Prioritas Nasional') ?>

    <?= $form->field($model, 'nawacita')->textInput(['maxlength' => true, 'id'=>'nawacita', 'readonly'=>true]) ?>

    <?= $form->field($model, 'id_urusan')->dropDownList($urusandaerah, ['prompt'=>'', 'id'=>'urusan', 'readonly'=>true])->label('Urusan Provinsi') ?>

    <?= $form->field($model, 'misi')->textInput(['maxlength' => true, 'id'=>'misi', 'readonly'=>true])->label('Visi Misi Provinsi') ?>

    <?= $form->field($model, 'Kd_Kegiatan')->dropDownList($keg, ['prompt'=>'Pilih Kegiatan', 'id'=>'kdkeg','class'=>'form-control select2'])->label('Kegiatan') ?>

    <div class="form-group tom">
        <div class="pull-left">
        <?= Html::Button($model->isNewRecord ? 'Proses' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
        </div>
        <div class="pull-left" id="tprog"></div>
        <div class="pull-left" id="tomKegiatan"></div>
        <div class="pull-left" id="uploadfile"></div>
        <div class="pull-left" id="tomIndikator"></div>
        <div class="clearfix"></div>
    </div>
    <div style="display:none">
        <?= $form->field($model, 'Kd_Urusan')->hiddenInput(['id'=>'kdurusan', 'value'=>$kdurusan])->label(''); ?>
        <?= $form->field($model, 'id_nawacita')->hiddenInput(['maxlength' => true, 'id'=>'idnawacita'])->label(''); ?>
        <?= $form->field($model, 'id_misi')->hiddenInput(['maxlength' => true, 'id'=>'idmisi'])->label('') ?>
        <?= $form->field($model, 'Kd_Bidang')->hiddenInput(['id'=>'kdbidang', 'value'=>$kdbidang])->label(''); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<br>
<div id="tableKegiatan"></div>
<br>
<div id="tableIndikator"></div>
