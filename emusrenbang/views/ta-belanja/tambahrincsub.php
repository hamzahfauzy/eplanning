<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\RefStandardHarga1;
use app\models\RefStandardHarga2;
use app\models\RefStandardHarga3;
use app\models\Referensi;
use app\models\RefHonor;
use app\models\RefHonorJabatan;
use app\models\RefHonorStandard;
use app\models\RefHonorSub;
use app\models\RefHonorSubA;
use app\models\RefHonorSubJabatan;

use common\models\Ta;
$ta = new Ta();

if(!empty($model->No_ID)){
    $no=$model->No_ID;
}else{
    $no=$ta->getNoBelanjaRincSub($id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5, $norinc);
}

$ref=new Referensi();

$Tahun=date('Y');

$satuanData=$ref->getSatuanModel();

$meIdUrusan=Yii::$app->user->identity->id_urusan;
$meIdBidang=Yii::$app->user->identity->id_bidang;
$meIdSkpd=Yii::$app->user->identity->id_skpd;
$meIdSub=Yii::$app->user->identity->id_subunit;

$meDataUrusan=$ref->getUrusanOne($meIdUrusan);
$meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

$this->title = 'Obyek Rincian Sub';
$this->params['breadcrumbs'][] = ['label' => 'Belanja', 'url' => ['listbelanja', 'id'=>$id, 'idkeg'=>$idkeg]];
$this->params['breadcrumbs'][] = ['label' => 'Rincian Belanja', 'url' => ['listbelanjarinc', 'id'=>$id, 'idkeg'=>$idkeg,
    'rek1'=>$rek1, 'rek2'=>$rek2, 'rek3'=>$rek3, 'rek4'=>$rek4, 'rek5'=>$rek5]];
$this->params['breadcrumbs'][] = ['label' => 'Rincian Belanja Sub', 'url' => ['listbelanjarincsub', 'id'=>$id, 'idkeg'=>$idkeg,
    'rek1'=>$rek1, 'rek2'=>$rek2, 'rek3'=>$rek3, 'rek4'=>$rek4, 'rek5'=>$rek5, 'norinc'=>$norinc]];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Yii::$app->request->baseUrl.'/elephant/js/vendor.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/elephant/js/elephant.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/elephant/js/application.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);

$js="
function currency(v){
    v=String(v);
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

function hitung(){
    n1=$('#Nilai_1').val();
    n2=$('#Nilai_2').val();
    n3=$('#Nilai_3').val();

    if(n1=='' || n1==null || n1==0){
        n1=1;
        $('#Nilai_1').val(1);
    }

    per2=n2;
    if(per2=='' || per2==null || per2==0){
        per2=n1;
    }else{
        per2=n1*n2;
    }

    per3=n3;
    if(per3=='' || per3==null || per3==0){
        per3=per2;
    }else{
        per3=per2*n3;
    }

    nt=$('#Nilai_Rp').val()*per3;
    $('#Jml_Satuan').val(per3);
    $('#Total').val(nt);
    $('#Total_1').val(currency(nt));
}

function satuanp(){
    s1=$('#Sat_1').val();
    s2=$('#Sat_2').val();
    s3=$('#Sat_3').val();
    $('#Satuan123').val(s1+'/'+s2+'/'+s3);
}

$('#Nilai_1,#Nilai_2,#Nilai_3').blur(function(){
    hitung();
});

$('#Sat_1').change(function(){
    satuanp();
});

$('#Sat_2').change(function(){
    satuanp();
});

$('#Sat_3').change(function(){
    satuanp();
});

$('#ssh').click(function(){
    $.post('index.php?r=ajax/modalssh', function(data, status){
        $('#data-ssh').html(data);
    })
});

$(document).on('click', '[id^=\"ssh3_\"]', function(){
    v=$(this).val();
    s=v.split('_');
    $('#Ket').val(s[1]);
    $('#Nilai_Rp').val(s[0]);
    $('#Nilai_Rp_1').val(currency(s[0]));
    // $('#Sat_1').val(s[2]);
    $('#Sat_1 option[value='+s[2]+']').prop('selected', true);
    $('#Satuan123').val(s[2]);
    $('[id^=\"responsive-\"]').modal('hide');
});

$('#Nilai_Rp_1').keyup(function(){
    v=$(this).val();
    fn=currency(v);
    $(this).val(fn);

    var nilai=$(this).val();
    $('#Nilai_Rp').val(nilai.replace(/\./g,''));
});

$('#Total_1').val(currency( $('#Total').val() ));
$('#Nilai_Rp_1').val( currency( $('#Nilai_Rp').val() ) );


";
$this->registerJs($js, 4, 'My');
?>

<div class="ta-belanja-index">
<style type="text/css">
    .modal-overflow.modal.fade.in {
        top: 1%;
        margin-left: calc(50vw - 400px) !important;
    }
</style>
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
                    <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd ?>
                </td>
                <td>
                    <?= $meDataUnit->Nm_Unit ?>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Program</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$KdProg ?>
                </td>
                <td>
                    <?= $ketProgram ?>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Kegiatan</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$KdProg.".".$idkeg ?>
                </td>
                <td>
                    <?=$ketKegiatan?>
                </td>
            </tr>

            <tr>
                <td class="col-md-2">Rekening</td>
                <td class="col-md-0 padding-edge">:</td>
                <td>
                    <?=$modelBelanja['Kd_Rek_1'].'.'.$modelBelanja['Kd_Rek_2'].'.'.$modelBelanja['Kd_Rek_3'].'.'.$modelBelanja['Kd_Rek_4'].'.'.$modelBelanja['Kd_Rek_5']?>
                </td>
                <td>
                    <?= $modelBelanja['Nm_Rek_5'] ?>
                </td>
            </tr>

            <tr>
                <td class="col-md-2">Rincian</td>
                <td class="col-md-0 padding-edge">:</td>
                <td>
                    <?=$modelBelanja['Kd_Rek_1'].'.'.$modelBelanja['Kd_Rek_2'].'.'.$modelBelanja['Kd_Rek_3'].'.'.$modelBelanja['Kd_Rek_4'].'.'.$modelBelanja['Kd_Rek_5'].'.'.$modelBelanja['No_Rinc']?>
                </td>
                <td>
                    <?= $modelBelanja['Keterangan'] ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div>
        <table class="pagu pull-right">
            <tr>
                <td>Anggaran Kegiatan</td>
                <td class="dot">:</td>
                <td class="vPagu"><?= $ref->getPaguKegiatan($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub,$KdProg,$idkeg); ?></td>
            </tr>
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
    </div>
    <div class="clearfix"></div>
    <br>

    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(); ?>
                <div class="form-body">
                    <div class="col-md-3">
                        <?= $form->field($model, 'No_ID')->textInput(['value'=>$no, 'readonly'=>true])->label('No Urut') ?>
                        <div class="form-group">
                            <a class="btn btn-primary" data-toggle="modal" href="#responsive-" id='ssh'>SSH</a>
                             <a class="btn btn-primary" data-toggle="modal" href="#responsive-1" id='asb'>ASB</a>
                        </div>
                        <?= $form->field($model, 'Keterangan')->textArea(['id'=>'Ket','readonly'=>false])->label("Uraian") ?>

                        <div class="form-group">
                            <label>Harga Satuan (Rp)</label>
                            <input type="text" class="form-control text-right" id='Nilai_Rp_1'>
                        </div>
                        <?= $form->field($model, 'Nilai_Rp')->hiddenInput(['id'=>'Nilai_Rp'])->label("") ?>
                    </div>
                    <div class="col-md-5">
                        <legend>Rincian</legend>
                        <div class="form-group-khusus">
                            <div class="col-md-6">
                                <?= $form->field($model, 'Nilai_1')->textInput(['id'=>'Nilai_1','placeholder'=>'Isikan Angka Saja']) ?>
                            </div>
                            <div class="col-md-6 satuan-custome-rinc">
                                <?= $form->field($model, 'Sat_1')->dropDownList($satuanData, ['prompt'=>'Pilih Satuan', 'id'=>'Sat_1'])->label("") ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group-khusus">
                            <div class="col-md-6">
                                <?= $form->field($model, 'Nilai_2')->textInput(['id'=>'Nilai_2','placeholder'=>'Isikan Angka Saja']) ?>
                            </div>
                            <div class="col-md-6 satuan-custome-rinc">
                                <?= $form->field($model, 'Sat_2')->dropDownList($satuanData, ['prompt'=>'Pilih Satuan', 'id'=>'Sat_2'])->label("") ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group-khusus">
                            <div class="col-md-6">
                                <?= $form->field($model, 'Nilai_3')->textInput(['id'=>'Nilai_3','placeholder'=>'Isikan Angka Saja']) ?>
                            </div>
                            <div class="col-md-6 satuan-custome-rinc">
                                <?= $form->field($model, 'Sat_3')->dropDownList($satuanData, ['prompt'=>'Pilih Satuan', 'id'=>'Sat_3'])->label("") ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <legend>Jumlah</legend>

                            <?= $form->field($model, 'Jml_Satuan')->textInput(['id'=>'Jml_Satuan','readonly'=>true])->label('Volume') ?>
                            <?= $form->field($model, 'Satuan123')->textInput(['id'=>'Satuan123','readonly'=>true,'placeholder'=>'/../../'])->label('Satuan') ?>
                            <div class="form-group">
                                <label>Total (Rp)</label>
                                <input type="text" class="form-control text-right" id='Total_1' readonly>
                            </div>
                            <?= $form->field($model, 'Total')->hiddenInput(['id'=>'Total'])->label('') ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<div id="responsive-1" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Analisa Standar Biaya</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
            <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Data Analisa Standar Biaya</span>
                            </div>

                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover display">
                            <thead>
                            <tr>
                                <th>Kelompok</th>
                                <th>Rincian</th>
                                <th>Uraian</th>
                                <th>Jabatan</th>
                                <th>Nilai</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $model3=RefHonorStandard::find()
                                ->select('Ref_Honor_Standard.Nilai, Ref_Honor_Sub_A.Nm_Honor_Sub_A,
                                    Ref_Honor_Sub.Nm_Honor_Sub, Ref_Honor_Jabatan.Nm_Jabatan, Ref_Honor.Nm_Honor')
                                ->leftJoin('Ref_Honor_Sub_Jabatan', 'Ref_Honor_Sub_Jabatan.Kd_Honor_Sub_Jabatan=Ref_Honor_Standard.Kd_Honor_Sub_Jabatan')
                                ->leftJoin('Ref_Honor_Sub_A', 'Ref_Honor_Sub_A.Kd_Honor_Sub_A=Ref_Honor_Sub_Jabatan.Kd_Honor_Sub_A')
                                ->leftJoin('Ref_Honor_Jabatan', 'Ref_Honor_Jabatan.Kd_Jabatan_Honor=Ref_Honor_Sub_Jabatan.Kd_Jabatan_Honor')
                                ->leftJoin('Ref_Honor_Sub', 'Ref_Honor_Sub.Kd_Honor_Sub=Ref_Honor_Sub_A.Kd_Honor_Sub')
                                ->leftJoin('Ref_Honor', 'Ref_Honor_Sub.Kd_Honor=Ref_Honor.Kd_Honor')
                                ->where(['Ref_Honor_Standard.Tahun'=>$Tahun])->all();

                            foreach($model3 as $d3){
                            ?>
                            <tr class="odd gradeX">
                                <td><?= $d3['Nm_Honor']; ?></td>
                                <td><?= $d3['Nm_Honor_Sub'];?></td>
                                <td><?= $d3['Nm_Honor_Sub_A']; ?></td>
                                <td><?= $d3['Nm_Jabatan']; ?></td>
                                <td>
                                    <?= "<button class='btn btn-primary' id='ssh3_".$d3['Kd_Standard']
                                ."' value='".$d3['Nilai']."_".$d3['Nm_Honor']." ".$d3['Nm_Honor_Sub']." ".$d3['Nm_Honor_Sub_A']." ".$d3['Nm_Jabatan']."_Orang'>"
                                .number_format($d3['Nilai'])."</button>"; ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    </div>
</div>


<div id="responsive-" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Satuan Standar Harga</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
            <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Data Satuan Standar Harga</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover display">
                            <thead>
                            <tr>
                                <th>Kelompok</th>
                                <th>Rincian</th>
                                <th>Uraian</th>
                                <th>Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $model3=RefStandardHarga3::find()
                                ->select('Ref_Standard_Harga_1.Uraian as Kelompok, Ref_Standard_Harga_2.Uraian as Rincian,
                                    Ref_Standard_Harga_3.*')
                                ->leftJoin('Ref_Standard_Harga_1', 'Ref_Standard_Harga_1.Kd_1=Ref_Standard_Harga_3.Kd_1')
                                ->leftJoin('Ref_Standard_Harga_2', 'Ref_Standard_Harga_2.Kd_1=Ref_Standard_Harga_3.Kd_1
                                    and Ref_Standard_Harga_2.Kd_2=Ref_Standard_Harga_3.Kd_2')
                                ->where(['Ref_Standard_Harga_3.Tahun'=>$Tahun])->all();

                            foreach($model3 as $d3){
                            ?>
                            <tr class="odd gradeX">
                                <td><?= $d3['Kd_1']." : ".$d3['Kelompok']; ?></td>
                                <td><?= $d3['Kd_2']." : ".$d3['Rincian']; ?></td>
                                <td><?= $d3['Kd_3']." : ".$d3['Uraian']." ".$d3['Keterangan']; ?></td>
                                <td>
                                    <?= "<button class='btn btn-primary' id='ssh3_".$d3['Kd_3']
                                ."' value='".$d3['Harga']."_".$d3['Rincian']." ".$d3['Uraian']." ".$d3['Keterangan']."_".$d3['Satuan']."'>"
                                .number_format($d3['Harga'])."</button>"; ?>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    </div>
</div>