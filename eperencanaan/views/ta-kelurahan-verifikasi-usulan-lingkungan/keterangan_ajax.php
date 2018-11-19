<?php
$request = Yii::$app->request;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefStandardSatuan; 
use common\models\RefJalan; 
use kartik\money\MaskMoney;




$this->registerJs('$("#takelurahanverifikasiusulanlingkungan-harga_satuan-disp").keyup(function(){
    var jumlah = $("#jumlah").val();
    var harga = $("#takelurahanverifikasiusulanlingkungan-harga_satuan-disp").val();
    harga = harga.replace(/\./g, "");
    harga = harga.replace(/,/g, ".");
    var total = jumlah*harga*100;
    //alert(total);
    $("#takelurahanverifikasiusulanlingkungan-harga_total").val(total/100);
    $("#takelurahanverifikasiusulanlingkungan-harga_total-disp").val(total).trigger("mask.maskMoney");
    $("#takelurahanverifikasiusulanlingkungan-harga_satuan").val(harga);
    
    });$("#jumlah").keyup(function(){
    var jumlah = $("#jumlah").val();
    var harga = $("#takelurahanverifikasiusulanlingkungan-harga_satuan-disp").val();
    harga = harga.replace(/\./g, "");
    harga = harga.replace(/,/g, ".");
    var total = jumlah*harga*100;
    //alert(total);
     $("#takelurahanverifikasiusulanlingkungan-harga_total").val(total/100);
    $("#takelurahanverifikasiusulanlingkungan-harga_total-disp").val(total).trigger("mask.maskMoney");
    $("#takelurahanverifikasiusulanlingkungan-harga_satuan").val(harga);
   
    });');


?>

<table>
    <tr>
        <td><b>Nama Permasalahan</b></td>
        <td> : </td>
        <td><?= $model->Nm_Permasalahan ?></td>
    </tr>
    <tr>
        <td><b>Jenis usulan</b></td>
        <td> : </td>
        <td><?= $model->Jenis_Usulan ?></td>
    </tr>
    <tr>
        <td><b>Bidang Pembangunan</b></td>
        <td> : </td>
        <td><?= $model->kdPem->Bidang_Pembangunan ?></td>
    </tr>
    <tr>
        <td><b>Jumlah</b></td>
        <td> : </td>
        <td><?php echo ($model->Jumlah.' '.$model->kdSatuan->Uraian) ?></td>
    </tr>
    <tr>
        <td><b>Harga</b></td>
        <td> : </td>
        <td><?= $model->Harga_Total ?></td>
    </tr>
    <tr>
        <td><b>Bidang Pembangunan</b></td>
        <td> : </td>
        <td><?= $model->kdPem->Bidang_Pembangunan ?></td>
    </tr>
    <tr>
        <td><b>Jalan</b></td>
        <td> : </td>
        <td><?= $model->kdJalan->Nm_Jalan ?></td>
    </tr>
    <tr>
        <td><b>Detail Lokasi</b></td>
        <td> : </td>
        <td><?= $model->Detail_Lokasi ?></td>
    </tr>

</table>
<hr/>