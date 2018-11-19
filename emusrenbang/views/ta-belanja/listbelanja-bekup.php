<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaBelanjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$idLevel=Yii::$app->user->identity->id_level;
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

$ref=new Referensi;

$meDataUrusan = $ref->getUrusanOne($meIdUrusan);
$meDataBidang = $ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit   = $ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

$meDataSub=null;
if($meIdSub!=0){
    $meDataSub=$ref->getSubUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub);
}

$this->title = 'Rincian Usulan Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Program Usulan', 'url' => ['ref-kegiatan-skpd/index']];
$this->params['breadcrumbs'][] = ['label' => 'Usulan Kegiatan', 'url' => ['ref-kegiatan-skpd/kegiatan', 'id'=>$KdProg]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$meIdSub.".".$KdProg.".".$idkeg ?>
                    <?php }else{ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$KdProg.".".$idkeg ?>
                    <?php } ?>
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

<style type="text/css">
    .iconB{
        position: relative;
    }
    .iconB .badge{
        position: absolute;
        top:-10px;
        right: -5px;
        background: #F3565D;
        color: #fff;
        font-weight: 700;
    }
</style>
<p>
<?php
    if($ref->getCountUrusan($KdProg,$idkeg)){
        $icon = "<i class='glyphicon glyphicon-ok' style='font-size:8px; position:relative; top:-1px'></i>";
    }else{
        $icon ="";
    }

    $jumlahIndikator=$ref->getCountIndikator($KdProg,$idkeg);
    $enabled=true;
    $onclick='return false';
?>
<?php if($icon != "" and $jumlahIndikator ==3 ) {  $enabled=false; $onclick='return true'; } ?>
<?= Html::a('Tambah Kode Rekening', ['tambah-rek', 'id'=>$id, 'idkeg'=>$idkeg], ['class' => 'btn btn-primary','disabled' => $enabled,'onClick' => $onclick  ]) ?>
&nbsp;&nbsp;&nbsp;
<?= Html::a('Uraian Usulan Kegiatan<span class="badge">'.$icon.'</span>', ['ta-kegiatan/uraian','kdprog'=>$KdProg, 'kdkeg'=>$idkeg], ['class' => 'btn btn-primary iconB']) ?>
&nbsp;&nbsp;&nbsp;
<?= Html::a('Indikator Usulan Kegiatan<span class="badge">'.$jumlahIndikator.'</span>', ['ta-indikator/indikator','kdprog'=>$KdProg, 'kdkeg'=>$idkeg], ['class' => 'btn btn-primary iconB']) ?>
</p>
    <table class='table table-bordered table-striped'>
    	<thead>
    		<tr>
    			<th>No Rekening</th>
    			<th colspan="3">Nama Rekening</th>
    		</tr>
    	</thead>
    	<?php
    	$i=1;
    	foreach($model as $d){
    	?>
    	<tbody>
    		<tr>
    			<td><?php echo $d['Kd_Rek_1'].'.'.$d['Kd_Rek_2'].'.'.$d['Kd_Rek_3'].'.'.$d['Kd_Rek_4'].'.'.$d['Kd_Rek_5']; ?></td>
    			<td>
    				<?= Html::a($d['Kd_Keg'].":".$d['Nm_Rek_5'],
    					['listbelanjarinc', 'id'=>$d['Kd_Prog'], 'idkeg'=>$d['Kd_Keg'], 'rek1' => $d['Kd_Rek_1'], 'rek2' => $d['Kd_Rek_2'], 'rek3' => $d['Kd_Rek_3'], 'rek4' => $d['Kd_Rek_4'], 'rek5' => $d['Kd_Rek_5']],
    					['class' => 'btn btn-success']) ?>
    			</td>
                <td class="col-md-1">
                    <?= Html::a("<i class='glyphicon glyphicon-pencil'></i>",
                        ['update-rek',
                        'Tahun'=>$d['Tahun'],
                        'id'=>$d['Kd_Prog'],
                        'idkeg'=>$d['Kd_Keg'],
                        'rek1' => $d['Kd_Rek_1'],
                        'rek2' => $d['Kd_Rek_2'],
                        'rek3' => $d['Kd_Rek_3'],
                        'rek4' => $d['Kd_Rek_4'],
                        'rek5' => $d['Kd_Rek_5']
                        ])
                    ?>
                </td>
                <td class="col-md-1">
                    <?= Html::a("<i class='glyphicon glyphicon-trash'></i>",
                        ['deletebelanja',
                        'Tahun'=>$d['Tahun'],
                        'id'=>$d['Kd_Prog'],
                        'idkeg'=>$d['Kd_Keg'],
                        'rek1' => $d['Kd_Rek_1'],
                        'rek2' => $d['Kd_Rek_2'],
                        'rek3' => $d['Kd_Rek_3'],
                        'rek4' => $d['Kd_Rek_4'],
                        'rek5' => $d['Kd_Rek_5']
                        ],['class' => 'alertHapus'])
                    ?>
                </td>
    		</tr>
    	</tbody>
    	<?php
    		$i=$i+1;
    	}
    	?>
    </table>
</div>
