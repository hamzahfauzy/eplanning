<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;
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
$this->params['breadcrumbs'][] = ['label' => 'Akun', 'url' => ['tambah', 'id'=>$id, 'idkeg'=>$idkeg]];
$this->params['breadcrumbs'][] = ['label' => 'Kelompok', 'url' => ['kelompok', 'id'=>$id, 'idkeg'=>$idkeg, 'rek1' => $rek1]];
$this->params['breadcrumbs'][] = $this->title;
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

    <table class='table table-bordered table-striped'>
    	<thead>
    		<tr>
    			<th>No. Rekening</th>
    			<th>Uraian</th>
    		</tr>
    	</thead>
    	<?php
    	$i=1;
    	foreach($model as $d){
    	?>
    	<tbody>
    		<tr>
    			<td><?= $rek1.'.'.$rek2.'.'.$d['Kd_Rek_3']; ?></td>
    			<td>
    				<?= Html::a($d['Nm_Rek_3'],
    				['obyek', 'id'=>$id, 'idkeg' => $idkeg, 'rek1' => $d['Kd_Rek_1'], 'rek2' => $d['Kd_Rek_2'], 'rek3' => $d['Kd_Rek_3']],
    				['class' => 'btn btn-success']) ?>
    			</td>
    		</tr>
    	</tbody>
    	<?php
    		$i=$i+1;
    	}
    	?>
    </table>
</div>
