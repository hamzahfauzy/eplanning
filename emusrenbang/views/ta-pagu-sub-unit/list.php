<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use emusrenbang\models\LevelUnit;
use emusrenbang\models\Referensi;

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguUnit */

$this->title = 'Pagu Indikatif Sub Unit';
$this->params['breadcrumbs'][] = "Pagu Indikatif";
$this->params['breadcrumbs'][] = $this->title;
$ref = new Referensi;
$js = "
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

j=$('#n').text();
for(i=1;i<j;i++){
    v=$('#data_'+i).val();
    fn=currency(v);
    $('#data_'+i).val(fn);
    //console.log(fn);
}

$('[id^=\"data_\"]').keyup(function(){
    v=$(this).val();
    fn=currency(v);
    $(this).val(fn);
})

";
$this->registerJs($js, 4, 'My');
?>
<style>
    .rg{
        text-align:right;
    }
</style>
<div class="ta-pagu-unit-view">
    <div class="box box-success">
        <div class="box-body">
            <?php $form = ActiveForm::begin(); ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Bidang</th>
                        <th>Unit</th>
                        <th>Sub Unit</th>
                        <th>Pagu Indikatif Sub Unit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($model as $value):
                        ?>

                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $value->Kd_Urusan . "." . $value->Kd_Bidang . "." . $value->Kd_Unit . "." . $value->Kd_Sub ?></td>
                            <td><?= $value->bidang->Nm_Bidang ?></td>
                            <td><?= $value->unit->Nm_Unit ?></td>
                            <td><?= $value->sub_unit->Nm_Sub_Unit ?></td>
                            <td class="col-xs-3">
                                <input type="text" class="form-control rg" name="pagu[<?= $value->Kd_Urusan ?>][<?= $value->Kd_Bidang ?>][<?= $value->Kd_Unit ?>][<?= $value->Kd_Sub ?>]" id="data_<?= $no ?>" value="<?= number_format($value->pagu, 0, ",", ".") ?>" id="data_id">
                            </td>
                        </tr>
                        <?php
                        $no++;
                    endforeach;
                    ?>

                </tbody>
            </table>
            <div id="n" style="display:none"></div>
            <div class="form-group">
                <?= Html::submitButton('Proses', ['class' => 'btn btn-success' , 'id' => 'proses']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>