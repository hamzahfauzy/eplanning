<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\LevelUnit;

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguUnit */

$this->title = 'Pagu Indikatif SKPD';
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
<?php $form = ActiveForm::begin(); ?>
<table class="table">
<thead>
    <tr>
        <th>No</th>
        <th>Urusan</th>
        <th>Sektor</th>
        <th>SKPD</th>
        <th>Pagu Indikatif SKPD</th>
    </tr>
</thead>
<tbody>
<?php
$idLevel=Yii::$app->user->identity->id_level;
$username=Yii::$app->user->identity->username;

$i=1;
foreach($modelUnit as $d){
    $Kd_Urusan=$d['Kd_Urusan'];
    $Kd_Bidang=$d['Kd_Bidang'];
    $Kd_Unit=$d['Kd_Unit'];
    if($idLevel==8){
        $levelUnit=LevelUnit::find()->where(['username'=>$username, 'Kd_Urusan'=>$Kd_Urusan,
            'Kd_Bidang'=>$Kd_Bidang, 'Kd_Unit'=>$Kd_Unit])->one();
        if(!empty($levelUnit['id'])){
        ?>
         <tr>
        <td><?= $i; ?></td>
        <td><?= $d['Kd_Urusan'].":".$d['Nm_Urusan']; ?></td>
        <td><?= $d['Kd_Bidang'].":".$d['Nm_Bidang']; ?></td>
        <td><?= $d['Kd_Unit'].":".$d['Nm_Unit']; ?></td>
        <td><?php echo "<input type=\"text\" name=pagu[$Kd_Urusan][$Kd_Bidang][$Kd_Unit] id=\"data_$i\" value=\"$d[pagu]\" class=\"rg\">"; ?>   </td>
    </tr>
        <?php
        }
    }else{
?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $d['Kd_Urusan'].":".$d['Nm_Urusan']; ?></td>
        <td><?= $d['Kd_Bidang'].":".$d['Nm_Bidang']; ?></td>
        <td><?= $d['Kd_Unit'].":".$d['Nm_Unit']; ?></td>
        <td><?php echo "<input type=\"text\" name=pagu[$Kd_Urusan][$Kd_Bidang][$Kd_Unit] id=\"data_$i\" value=\"$d[pagu]\" class=\"rg\">"; ?>   </td>
    </tr>
<?php
    }
$i=$i+1;
}
?>
</tbody>
</table>
<div id="n" style="display:none"><?= $i; ?></div>
 <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Proses' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>
