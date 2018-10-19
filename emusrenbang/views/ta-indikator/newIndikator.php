<?php

use yii\helpers\Html;
use app\models\Referensi;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanSkpd */
/* @var $form yii\widgets\ActiveForm */

$idLevel=Yii::$app->user->identity->id_level;

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

$meDataSub=null;
if($meIdSub!=0){
    $meDataSub=$ref->getSubUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub);
}

$satuanData=$ref->getSatuan();


$this->title = 'Indikator Kegiatan';
$this->params['breadcrumbs'][] = "Rencana Kerja";
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['ta-belanja/list']];
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['ta-belanja/listbelanja','id'=>$KdProg, 'idkeg'=>$KdKeg]];
$this->params['breadcrumbs'][] = $this->title;


$indikator=$ref->getIndikator();
?>
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
    <style type="text/css">
        .targetAngka{
            width: 10%;
        }

        .targetUraian{
            width: 60%;
        }

        .targetAngka,
        .targetUraian{
            float: left;
        }
    </style>
    <table class="pagu pull-right">
        <tr>
            <td>Pagu Indikatif Program</td>
            <td class="dot">:</td>
            <td class="vPagu"><?= $ref->getPaguProgram($KdProg) ?></td>
        </tr>
    </table>
    <div class="ref-program-form">

        <?php $form = ActiveForm::begin(); ?>

            <?php foreach ($jenisInd as $key => $value) { ?>
                <div>
                    <legend><?= $value->Nm_Indikator ?></legend>
                    <div style="margin-left:20px;">
                        <?= $form->field($model, 'Tolak_Ukur')->textInput(['maxlength' => true,'name'=>'tolakUkur['.$value->Kd_Indikator.']',
                            'value'=>$formData[$value->Kd_Indikator]['tolakUkur']
                        ])->label('Tolok Ukur') ?>

                        <div>
                            <div class="form-group ">
                                <label>Target Angka ( Hanya Angka )</label>
                                <div class="clearfix"></div>
                                <input type="text" class='form-control targetAngka' value="<?= $formData[$value->Kd_Indikator]['targetAngka'] ?>" name="targetAngka[<?= $value->Kd_Indikator ?>]" >
                                <select name="targetUraian[<?= $value->Kd_Indikator ?>]" class="form-control targetUraian">
                                    <option>Pilih Target Uraian</option>
                                    <?php foreach ($satuanData as $sa) { ?>
                                        <option <?php
                                            if ($formData[$value->Kd_Indikator]['targetUraian']==$sa->id) echo "selected"
                                        ?>  value="<?= $sa->id ?>"><?= $sa->satuan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php } ?>
            <br><br>
            <?php
            if($idLevel!=8){
            ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
                        <th>Indikator</th>
                        <th>Tolak Ukur</th>
                        <th>Target Angka</th>
                        <th>Target Uraian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($rowData)) { ?>
                        <?php foreach ($rowData as $key => $value) {
                            $ur=$ref->getSatuan($value->Target_Uraian);
                            $ur=isset( $ur ) ? $ur->satuan : '' ;
                        ?>
                        <tr>
                            <td><?= $ref->getIndikatorByOne($value->Kd_Indikator)->Nm_Indikator ?></td>
                            <td><?= $value->Tolak_Ukur ?></td>
                            <td><?= $value->Target_Angka ?></td>
                            <td><?= $ur ?></td>
                        </tr>
                        <?php } ?>
                    <?php }else{ ?>
                        <tr>
                            <td colspan="4">Data tidak ditemukan</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
