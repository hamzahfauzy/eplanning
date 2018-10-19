<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguProgram */

$this->title = "Pagu Indikatif Program";
$this->params['breadcrumbs'][] = "Pagu Indikatif";
$this->params['breadcrumbs'][] = $this->title;
$js="
function currency(v){
    value=v.replace(/\./g,'');
    length=value.length;
    if(length>12){
        if(length==13){
            f1=value.substr(0,1);
            f2=value.substr(1,3);
            f3=value.substr(4,3);
            f4=value.substr(7,3);
            f5=value.substr(10,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4 + '.' + f5;
        }else if(length==14){
            f1=value.substr(0,2);
            f2=value.substr(2,3);
            f3=value.substr(5,3);
            f4=value.substr(8,3);
            f5=value.substr(11,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4 + '.' + f5;
        }else if(length==15){
            f1=value.substr(0,3);
            f2=value.substr(3,3);
            f3=value.substr(6,3);
            f4=value.substr(9,3);
            f5=value.substr(12,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4 + '.' + f5;
        }
    }else if(length>9){
        if(length==10){
            f1=value.substr(0,1);
            f2=value.substr(1,3);
            f3=value.substr(4,3);
            f4=value.substr(7,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4;
        }else if(length==11){
            f1=value.substr(0,2);
            f2=value.substr(2,3);
            f3=value.substr(5,3);
            f4=value.substr(8,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4;
        }else if(length==12){
            f1=value.substr(0,3);
            f2=value.substr(3,3);
            f3=value.substr(6,3);
            f4=value.substr(9,3);
            fn= f1 + '.' + f2 + '.' + f3 + '.' + f4;
        }
    }else if(length>6){
        if(length==7){
            f1=value.substr(0,1);
            f2=value.substr(1,3);
            f3=value.substr(4,3);
            fn= f1 + '.' + f2 + '.' + f3;
        }else if(length==8){
            f1=value.substr(0,2);
            f2=value.substr(2,3);
            f3=value.substr(5,3);
            fn= f1 + '.' + f2 + '.' + f3;
        }else if(length==9){
            f1=value.substr(0,3);
            f2=value.substr(3,3);
            f3=value.substr(6,3);
            fn= f1 + '.' + f2 + '.' + f3;
        }
    }else if(length>3){
        if(length==4){
            f1=value.substr(0,1);
            f2=value.substr(1,3);
            fn= f1 + '.' + f2;
        }else if(length==5){
            f1=value.substr(0,2);
            f2=value.substr(2,3);
            fn= f1 + '.' + f2;
        }else if(length==6){
            f1=value.substr(0,3);
            f2=value.substr(3,3);
            fn= f1 + '.' + f2;
        }
    }else{
        fn=value;
    }
    return fn;
}

function loopdata()
{
j=$('#n').text();
n=0;
for(i=1;i<j;i++){
    v=$('#data_'+i).val();
    value=v.replace(/\./g,'');

    n=n+parseFloat(value);
    fn=currency(v);
    $('#data_'+i).val(fn);
    $('#total').val(n);
    //console.log(fn);
}
    t=$('#total').val();
    s=$('#unit').val();
    sisa=s.replace(/\./g,'');
    v1=sisa-t;
    //console.log(v1);
    fn1=currency(String(v1));
    $('#sisa').val(fn1);
}

loopdata();

$('[id^=\"data_\"]').keyup(function(){
    v=$(this).val();
    fn=currency(v);
    $(this).val(fn);
});

$('[id^=\"data_\"]').blur(function(){
    loopdata();
    t=$('#total').val();
    s=$('#unit').val();
    sisa=s.replace(/\./g,'');
    v=sisa-t;
    if(v<0){
        $('#msg').text('Alokasi Pagu Indikatif Sudah Habis');
        $('#tmbl').prop('disabled', true);
    }else{
        fn=currency(String(v));
        $('#sisa').val(fn);
        $('#tmbl').prop('disabled', false);
    }
});


";
$this->registerJs($js, 4, 'My');
?>
<div class="ta-pagu-program-view">
<?php $form = ActiveForm::begin(); ?>
<style type="text/css">
    .pagu{
        font-size: 20px;
        font-weight: 700;
        margin-right: 10px;
        position: relative;
        top: 10px;
    }
    .pagu td{
        padding-bottom: 7px;
    }

    .pagu .dot{
        padding-left:10px;
        padding-right:10px;
    }

    .pagu .vPagu{
        text-align: right;
    }
</style>

<h3 id='msg' style='color:red'></div>
<table class="pagu">
    <tr>
        <td>Pagu Indikatif SKPD</td>
        <td class="dot">:</td>
        <td class="vPagu"><input type='text' id='unit' value='<?=number_format($pagu,0,',','.')?>' readonly=true style="text-align:right"></td>
    </tr>
    <tr>
        <td>Sisa Pagu Indikatif SKPD</td>
        <td class="dot">:</td>
        <td class="vPagu"><input type='text' id='sisa'  value='<?=number_format($pagu,0,',','.')?>' readonly=true style="text-align:right"></td>
    </tr>
</table>
<table class='table'>
    <thead>
        <tr>
            <th>No</th>
            <th>Program</th>
            <th>Pagu Indikatif Program</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i=1;
            foreach($modelProgram as $d){
                if(empty($d['pagu']) and $d['pagu']==0){
                    $p=0;
                }else{
                    $p=$d['pagu'];
                }
        ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$d['Ket_Program'];?></td>
                <td><input type="text" name="pagu[<?=$d['Kd_Prog']?>]" id="data_<?=$i?>" value="<?= $p ?>"></td>
            </tr>
        <?php
            $i=$i+1;
        }?>
    </tbody>
</table>
<div id='n' style='display:none'><?=$i;?></div>
<input type='hidden' id='total'>
<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Create', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'tmbl']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>