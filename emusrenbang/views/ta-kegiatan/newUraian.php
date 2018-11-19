<?php

use yii\helpers\Html;
use app\models\Referensi;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaKegiatan */
/* @var $form yii\widgets\ActiveForm */

$ref=new Referensi;

$cookies = Yii::$app->request->cookies;
if(!empty($cookies['skpd'])){
	$meIdUrusan=$cookies['urusan']->value;
	$meIdBidang=$cookies['bidang']->value;
	$meIdSkpd=$cookies['skpd']->value;
	$meIdSub=$cookies['subUnit']->value;
}else{
	$meIdUrusan=Yii::$app->user->identity->id_urusan;
	$meIdBidang=Yii::$app->user->identity->id_bidang;
	$meIdSkpd=Yii::$app->user->identity->id_skpd;
	$meIdSub=Yii::$app->user->identity->id_subunit;
}

$meDataUrusan=$ref->getUrusanOne($meIdUrusan);
$meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);
$sumber=$ref->dropRefSumberDana();

$meDataSub=null;
if($meIdSub!=0){
    $meDataSub=$ref->getSubUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub);
}

$this->title = 'Uraian Kegiatan';
$this->params['breadcrumbs'][] = "Rencana Kerja";
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['ta-belanja/list']];
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['ta-belanja/listbelanja','id'=>$KdProg, 'idkeg'=>$KdKeg]];
$this->params['breadcrumbs'][] = $this->title;

$status=array('1'=>'Baru', '2'=>'Lanjutan');
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


    v=$('#pagu').val();
    fn=currency(v);
    $('#pagu').val(fn);
    //console.log(fn);


$('#pagu').keyup(function(){
    v=$(this).val();
    fn=currency(v);
    $(this).val(fn);
})

";
$this->registerJs($js, 4, 'My');
?>

<div id="responsive" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Map</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div id='data'>
                    <?= $this->render('_map', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    </div>
</div>

<div class="ref-kegiatan-create">

    <table class="table table-striped rkaTable">
        <tbody>
            <tr>
                <td class="col-md-2">Urusan Pemerintahan</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?= $meIdUrusan.".".$meIdBidang ?>
                </td>
                <td>
                    <?= $meDataUrusan->Nm_Urusan." ".$meDataBidang->Nm_Bidang ?>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Organisasi</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                   <?php if($meDataSub){ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$meIdSub ?>
                    <?php }else{ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd ?>
                    <?php } ?>
                </td>
                <td>
                    <?php if($meDataSub){ ?>
                        <?= $meDataSub->Nm_Sub_Unit ?>
                    <?php }else{ ?>
                        <?= $meDataUnit->Nm_Unit ?>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Program</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?php if($meDataSub){ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$meIdSub.".".$KdProg ?>
                    <?php }else{ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$KdProg ?>
                    <?php } ?>
                </td>
                <td>
                    <?= $ketProgram ?>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Kegiatan</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?php if($meDataSub){ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$meIdSub.".".$KdProg.".".$KdKeg ?>
                    <?php }else{ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$KdProg.".".$KdKeg ?>
                    <?php } ?>
                </td>
                <td>
                    <?=$ketKegiatan?>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="pagu pull-right">
        <tr>
            <td>Pagu Indikatif Program</td>
            <td class="dot">:</td>
            <td class="vPagu"><?= $ref->getPaguProgram($KdProg) ?></td>
        </tr>
        <tr>
            <td>Anggaran Kegiatan Terpakai</td>
            <td class="dot">:</td>
            <td class="vPagu"><?= $ref->getPaguKegiatanAll($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub,$KdProg) ?></td>
        </tr>
        <tr>
            <td>Sisa Pagu Indikatif Program</td>
            <td class="dot">:</td>
            <td class="vPagu"><?= number_format($ref->getPaguSisaKeg($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub,$KdProg),0,',','.') ?></td>
        </tr>
    </table>
    <div class="clearfix"></div>


    <div class="ref-program-form">
        <?php
            $rLokasi           = isset($rowData->Lokasi) ? $rowData->Lokasi : null;
            $rKelompokSasaran  = isset($rowData->Kelompok_Sasaran) ? $rowData->Kelompok_Sasaran : null;
            $rStatusKegiatan   = isset($rowData->Status_Kegiatan) ? $rowData->Status_Kegiatan : null;
            $rPagu             = isset($rowData->Pagu_Anggaran) ? $rowData->Pagu_Anggaran : null;
            $rWaktuPela        = isset($rowData->Waktu_Pelaksanaan) ? $rowData->Waktu_Pelaksanaan : null;
            $rSumber           = isset($rowData->Kd_Sumber) ? $rowData->Kd_Sumber : null;
            $rKeterangan       = isset($rowData->Keterangan) ? $rowData->Keterangan : null;

        ?>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?php
$idLevel=Yii::$app->user->identity->id_level;
if($idLevel!=8){
?>
        <?= $form->field($model, 'Lokasi')->textInput([
            'maxlength' => true, 'id'=>'lokasi','value'=>$rLokasi
        ])->label("Lokasi ( contoh : medan )") ?>
        <!-- <a class="btn default" data-toggle="modal" href="#responsive">Map</a> -->

        <?= $form->field($model, 'Kelompok_Sasaran')->textInput(['maxlength' => true,'value'=>$rKelompokSasaran ]) ?>

        <div class="form-group">
            <label>Status  Kegiatan</label>
            <select id="takegiatan-status_kegiatan" class="form-control" name="TaKegiatan[Status_Kegiatan]">
                <option value="">Pilih Status Kegiatan</option>
                <?php foreach ($status as $keySt => $sta) { ?>
                    <option <?php if($rStatusKegiatan==$keySt) echo "selected";  ?> value="<?= $keySt ?>"><?= $sta ?></option>
                <?php } ?>
            </select>
        </div>

        <?= $form->field($model, 'Pagu_Anggaran')->textInput(['id'=>'pagu','value'=>$rPagu ])->label("Pagu Anggaran ( contoh : 10000000 )") ?>

        <?= $form->field($model, 'Waktu_Pelaksanaan')->textInput(['maxlength' => true,'value'=>$rWaktuPela ]) ?>

        <div class="form-group">
            <label>Sumber Dana</label>
            <select id="takegiatan-kd_sumber" class="form-control" name="TaKegiatan[Kd_Sumber]">
                <option value="">Pilih Sumber Dana</option>
                <?php foreach ($sumber as $keyS => $sum) { ?>
                    <option <?php if($rSumber==$keyS) echo "selected";  ?> value="<?= $keyS ?>"><?= $sum ?></option>
                <?php } ?>
            </select>
        </div>

        <?= $form->field($model, 'File')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
<?php
}else{
?>
<?= $form->field($model, 'Lokasi')->textInput([
            'maxlength' => true, 'id'=>'lokasi','value'=>$rLokasi, 'readonly'=>true
        ])->label("Lokasi ( contoh : medan )") ?>
        <!-- <a class="btn default" data-toggle="modal" href="#responsive">Map</a> -->

        <?= $form->field($model, 'Kelompok_Sasaran')->textInput(['maxlength' => true,'value'=>$rKelompokSasaran, 'readonly'=>true ]) ?>

        <div class="form-group">
            <label>Status  Kegiatan</label>
            <select id="takegiatan-status_kegiatan" class="form-control" name="TaKegiatan[Status_Kegiatan]" disabled>
                <option value="">Pilih Status Kegiatan</option>
                <?php foreach ($status as $keySt => $sta) { ?>
                    <option <?php if($rStatusKegiatan==$keySt) echo "selected";  ?> value="<?= $keySt ?>"><?= $sta ?></option>
                <?php } ?>
            </select>
        </div>

        <?= $form->field($model, 'Pagu_Anggaran')->textInput(['id'=>'pagu','value'=>$rPagu, 'readonly'=>true ])->label("Pagu Anggaran ( contoh : 10000000 )") ?>

        <?= $form->field($model, 'Waktu_Pelaksanaan')->textInput(['maxlength' => true,'value'=>$rWaktuPela, 'readonly'=>true ]) ?>

        <div class="form-group">
            <label>Sumber Dana</label>
            <select id="takegiatan-kd_sumber" class="form-control" name="TaKegiatan[Kd_Sumber]" disabled>
                <option value="">Pilih Sumber Dana</option>
                <?php foreach ($sumber as $keyS => $sum) { ?>
                    <option <?php if($rSumber==$keyS) echo "selected";  ?> value="<?= $keyS ?>"><?= $sum ?></option>
                <?php } ?>
            </select>
        </div>

        <?= $form->field($model, 'File')->fileInput(['disabled'=>true]) ?>
<div class="form-group">
            <?= $form->field($model, 'Keterangan')->textInput(['maxlength' => true, 'value'=>$rKeterangan ]) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
<?php
}
?>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                Data Indikator
            </div>
        </div>

        <div class="portlet-body flip-scroll">
            <table class="table table-bordered table-striped table-condensed flip-content">
                <thead class="flip-content">
                    <tr>
                        <th>Lokasi</th>
                        <th>Kelompok Sasaran</th>
                        <th>Status Kegiatan</th>
                        <th>Waktu Pelaksanaan</th>
                        <th>Sumber</th>
                        <th>Pagu Kegiatan</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($rowData)) { ?>
                        <tr>
                            <td><?= $rowData->Lokasi ?></td>
                            <td><?= $rowData->Kelompok_Sasaran?></td>
                            <td><?= $status[$rowData->Status_Kegiatan] ?></td>
                            <td><?= $rowData->Waktu_Pelaksanaan ?></td>
                            <td><?php
                            if(!empty($rowData->Kd_Sumber)){
                            echo $ref->getSumberDanaByOne($rowData->Kd_Sumber)->Nm_Sumber;
                            } ?></td>
                            <td><?= $rowData->Pagu_Anggaran ?></td>
                            <td><a href="<?php echo Yii::getAlias('@web'); ?>/uploads/<?= $rowData->File ?>" target="_blank">File</a></td>
                        </tr>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="6">Data tidak ditemukan</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>