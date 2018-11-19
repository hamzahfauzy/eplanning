<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TaBelanjaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$ref=new Referensi;
$idLevel=Yii::$app->user->identity->id_level;
$cookies = Yii::$app->request->cookies;

if(!empty($cookies['skpd'])){
	$meIdUrusan=$cookies['urusan']->value;
	$meIdBidang=$cookies['bidang']->value;
	$meIdSkpd=$cookies['skpd']->value;
	$meIdSub=$cookies['skpd']->value;
}else{
	$meIdUrusan=Yii::$app->user->identity->id_urusan;
	$meIdBidang=Yii::$app->user->identity->id_bidang;
	$meIdSkpd=Yii::$app->user->identity->id_skpd;
	$meIdSub=Yii::$app->user->identity->id_subunit;
}

$meDataUrusan=$ref->getUrusanOne($meIdUrusan);
$meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

$this->title = 'Belanja Langsung Sub Rincian';
$this->params['breadcrumbs'][] = "Rencana Kerja";
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => 'Kegiatan', 'url' => ['listkegiatan', 'id'=>$id]];
$this->params['breadcrumbs'][] = ['label' => 'Belanja Langsung', 'url' => ['listbelanja','id'=>$KdProg, 'idkeg'=>$idkeg]];
$this->params['breadcrumbs'][] = ['label' => 'Belanja Langsung Rincian',
'url' => ['listbelanjarinc', 'id'=>$KdProg, 'idkeg'=>$idkeg,
                            'rek1' => $rek1, 'rek2' => $rek2,
                            'rek3' => $rek3, 'rek4' => $rek4,
                            'rek5' => $rek5]];
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


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    if($idLevel!=8){
    ?>
<p>
<?= Html::a('Tambah', ['tambahrincsub', 'id'=>$id, 'idkeg'=>$idkeg, 'rek1'=>$rek1,
	'rek2'=>$rek2, 'rek3'=>$rek3, 'rek4'=>$rek4, 'rek5'=>$rek5, 'norinc'=>$norinc], ['class' => 'btn btn-success']) ?>
</p>
<?php
}
?>
    <table class='table table-bordered table-striped'>
    	<thead>
    		<tr>
    			<th>No Rekening</th>
    			<th colspan="3">Uraian</th>
    		</tr>
    	</thead>
    	<?php
    	$i=1;
    	foreach($model as $d){
    	?>
    	<tbody>
    		<tr>
    			<td class="col-md-2">
                    <?php echo $modelBelanja['Kd_Rek_1'].'.'.$modelBelanja['Kd_Rek_2'].'.'.$modelBelanja['Kd_Rek_3'].'.'.$modelBelanja['Kd_Rek_4'].'.'.$modelBelanja['Kd_Rek_5'].'.'.$modelBelanja['No_Rinc']; ?>
                </td>
    			<td>
    				<?= Html::a($d['Keterangan'],
    					['updaterincsub', 'id'=>$d['Kd_Prog'], 'idkeg'=>$d['Kd_Keg'],
    						'rek1' => $d['Kd_Rek_1'], 'rek2' => $d['Kd_Rek_2'],
    						'rek3' => $d['Kd_Rek_3'], 'rek4' => $d['Kd_Rek_4'],
    						'rek5' => $d['Kd_Rek_5'],
                            'norinc' => $d['No_Rinc'],
                            'noid'=>$d['No_ID']],
                        ['class' => 'btn btn-success tunder'])
                    ?>
    			</td>
                <td class="col-md-1">
                    <?= Html::a("<i class='glyphicon glyphicon-pencil'></i>",
                        ['updaterincsub',
                            'id'=>$d['Kd_Prog'],
                            'idkeg'=>$d['Kd_Keg'],
                            'rek1' => $d['Kd_Rek_1'],
                            'rek2' => $d['Kd_Rek_2'],
                            'rek3' => $d['Kd_Rek_3'],
                            'rek4' => $d['Kd_Rek_4'],
                            'rek5' => $d['Kd_Rek_5'],
                            'norinc'=>$d['No_Rinc'],
                            'noid'=>$d['No_ID']
                        ])
                    ?>
                </td>
                <td class="col-md-1">
                    <?= Html::a("<i class='glyphicon glyphicon-trash'></i>",
                        ['deleterincsub',
                            'Tahun'     => $d['Tahun'],
                            'rek1'      => $d['Kd_Rek_1'],
                            'rek2'      => $d['Kd_Rek_2'],
                            'rek3'      => $d['Kd_Rek_3'],
                            'rek4'      => $d['Kd_Rek_4'],
                            'rek5'      => $d['Kd_Rek_5'],
                            'Kd_Prog'   => $d['Kd_Prog'],
                            'Kd_Keg'    => $d['Kd_Keg'],
                            'norinc'    => $d['No_Rinc'],
                            'norinc'    => $d['No_Rinc'],
                            'noid'      => $d['No_ID']
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
