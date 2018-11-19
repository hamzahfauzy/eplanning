<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Referensi;
//use app\models\Referensi;
use common\models\Ta;
$ta = new Ta();

if(!empty($model->No_Rinc)){
    $no=$model->No_Rinc;
}else{
    $no=$ta->getNoBelanjaRinc($id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5);
}

//$ref=new Referensi();
//$kdApPub=$ref->getRefApPub();
//$sumberDana=$ref->dropRefSumberDana();

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaBelanjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$ref=new Referensi;
$meIdUrusan=Yii::$app->user->identity->id_urusan;
$meIdBidang=Yii::$app->user->identity->id_bidang;
$meIdSkpd=Yii::$app->user->identity->id_skpd;
$meIdSub=Yii::$app->user->identity->id_subunit;

$meDataUrusan=$ref->getUrusanOne($meIdUrusan);
$meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

$this->title = 'Pemilihan Kode Rekening';
$this->params['breadcrumbs'][] = ['label' => 'Belanja', 'url' => ['listbelanja', 'id'=>$id, 'idkeg'=>$idkeg]];
$this->params['breadcrumbs'][] = ['label' => 'Rincian Belanja', 'url' => ['listbelanjarinc', 'id'=>$id, 'idkeg'=>$idkeg,
	'rek1'=>$rek1, 'rek2'=>$rek2, 'rek3'=>$rek3, 'rek4'=>$rek4, 'rek5'=>$rek5]];
$this->params['breadcrumbs'][] = $this->title;

/*$rek5=array();
foreach($model as $d){
	$rek5[$d['Kd_Rek_5']]=$d['Nm_Rek_5'];
}*/
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

  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'No_Rinc')->textInput(['value'=>$no])->label('No Rincian') ?>

  <?= $form->field($model, 'Keterangan')->textInput() ?>

  <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

   <?php ActiveForm::end(); ?>

</div>
