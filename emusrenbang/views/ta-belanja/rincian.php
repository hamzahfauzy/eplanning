<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Referensi;

$ref=new Referensi();
$kdApPub=$ref->getRefApPub();
$sumberDana=$ref->dropRefSumberDana();

$meIdUrusan = Yii::$app->user->identity->id_urusan;
$meIdBidang = Yii::$app->user->identity->id_bidang;
$meIdSkpd   = Yii::$app->user->identity->id_skpd;
$meIdSub    = Yii::$app->user->identity->id_subunit;

$meDataUrusan = $ref->getUrusanOne($meIdUrusan);
$meDataBidang = $ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit   = $ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

$this->title = 'Pemilihan Kode Rekening';
$this->params['breadcrumbs'][] = ['label' => 'Rincian Usulan Kegiatan', 'url' => ['listbelanja', 'id'=>$KdProg, 'idkeg'=>$idkeg]];
$this->params['breadcrumbs'][] = $this->title;

$js="
    // $('#akun').change(function(){
    //     $('#kelompok,#jenis,#obyek,#rincian').empty();
    //     $('#kelompok,#jenis,#obyek,#rincian').select2('val', '');
    //     id=$('#akun').val();
    //     $.post('index.php?r=ref-rek-2/getdata&rek1='+id, function(data, status){
    //         $('#kelompok').html(data);
    //     })
    // });

    $('#kelompok').change(function(){
        $('#jenis,#obyek,#rincian').empty();
        $('#jenis,#obyek,#rincian').select2('val', '');
        id=$('#kelompok').val();
        akun=$('#akun').val();
        $.post('index.php?r=ref-rek-3/getdata&rek1=5&rek2='+id, function(data, status){
            $('#jenis').html(data);
        })
    });

    $('#jenis').change(function(){
        $('#obyek,#rincian').empty();
        $('#obyek,#rincian').select2('val', '');
        rek1=$('#akun').val();
        rek2=$('#kelompok').val();
        rek3=$('#jenis').val();
        $.post('index.php?r=ref-rek-4/getdata&rek1=5&rek2='+rek2+'&rek3='+rek3, function(data, status){
            $('#obyek').html(data);
        })
    });


    $('#obyek').change(function(){
        $('#rincian').empty();
        $('#rincian').select2('val', '');
        rek1=$('#akun').val();
        rek2=$('#kelompok').val();
        rek3=$('#jenis').val();
        rek4=$('#obyek').val();
        $.post('index.php?r=ref-rek-5/getdata&rek1=5&rek2='+rek2+'&rek3='+rek3+'&rek4='+rek4, function(data, status){
            $('#rincian').html(data);
        })
    });
";

$this->registerJs($js, 4, 'urusan');

?>
<div class="ta-belanja-index">
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
        </tbody>
    </table>

    <!-- <div>
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
    </div> -->
    <div class="clearfix"></div>
    <br>
    <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-6">
            <?= $form->field($model, 'Kd_Rek_1')->textInput(['disabled'=>true,'value'=>isset($modelRek1[0]) ? $modelRek1[0]->Nm_Rek_1 : null ])->label('Akun') ?>
            <?= $form->field($model, 'Kd_Rek_2')->dropDownList($rek2A, ['prompt'=>'Pilih Kelompok','class'=>'form-control select2','id'=>'kelompok'])->label('Kelompok') ?>
            <?= $form->field($model, 'Kd_Rek_3')->dropDownList($rek3A, ['prompt'=>'Pilih Jenis','class'=>'form-control select2','id'=>'jenis'])->label('Jenis') ?>
            <?= $form->field($model, 'Kd_Rek_4')->dropDownList($rek4A, ['prompt'=>'Pilih Obyek','class'=>'form-control select2','id'=>'obyek'])->label('Obyek') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'Kd_Rek_5')->dropDownList($rek5A, ['prompt'=>'Pilih Rincian Obyek','class'=>'form-control select2','id'=>'rincian'])->label('Rincian Obyek') ?>
            <?= $form->field($model, 'Kd_Ap_Pub')->dropDownList($kdApPub, ['prompt' => 'Pilih Kode Ap Pub','class'=>'form-control select2'])->label('Jenis Belanja') ?>
            <?= $form->field($model, 'Kd_Sumber')->dropDownList($sumberDana, ['prompt'=>'Pilih Sumber Dana','class'=>'form-control select2'])->label('Sumber Dana') ?>
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="form-group">
            <?= Html::a('Kembali', ['listbelanja','id'=>$KdProg, 'idkeg'=>$idkeg], ['class' => 'btn btn-default']) ?>
            &nbsp;&nbsp;&nbsp;
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>