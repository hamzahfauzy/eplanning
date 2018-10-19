<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefKegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$ref=new Referensi;
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

$meDataSub=null;
if($meIdSub!=0){
    $meDataSub=$ref->getSubUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub);
}


$this->title = 'Kegiatan';
$this->params['breadcrumbs'][] = "Rencana Kerja";
$this->params['breadcrumbs'][] = ['label' => 'Program', 'url' => ['list']];
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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.'
            ],
            [
                'attribute' =>'Ket_Kegiatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Cari Nama Kegiatan'
                ],
                'format' => 'raw',
                'value' => function($model){
                    $ref=new Referensi;
                    return Html::a($model->Kd_Keg.":".$model->Ket_Kegiatan, ['listbelanja','id'=>$model->Kd_Prog, 'idkeg'=>$model->Kd_Keg ], ['class' => 'btn btn-success  tunder']).
                    Html::a($ref->getListBelanjaCount($model->Kd_Prog,$model->Kd_Keg).' Belanja', ['listbelanja','id'=>$model->Kd_Prog, 'idkeg'=>$model->Kd_Keg ], ['class' => 'btn btn-warning']);
                }
            ],
            [
                'attribute' =>'Uraian Kegiatan',
                'format' => 'raw',
                'options' => ['class'=>'col-md-1 inCenter'],
                'value' => function($model){
                    $ref=new Referensi;
                    if($ref->getCountUrusan($model->Kd_Prog,$model->Kd_Keg)){
                        return Html::a('<i class="glyphicon glyphicon-ok" style="font-size:12px;"></i>', ['ta-kegiatan/uraian','kdprog'=>$model->Kd_Prog, 'kdkeg'=>$model->Kd_Keg], ['class' => 'btn btn-primary iconB']);
                    }else{
                        return "-";
                    }
                }
            ],
            [
                'attribute' =>'Indikator Kegiatan',
                'format' => 'raw',
                'options' => ['class'=>'col-md-1 inCenter'],
                'value' => function($model){
                    $ref=new Referensi;
                    $total=$ref->getCountIndikator($model->Kd_Prog,$model->Kd_Keg);
                    if($total>=3){
                        return Html::a('<i class="glyphicon glyphicon-ok" style="font-size:12px;"></i>', ['ta-indikator/indikator','kdprog'=>$model->Kd_Prog, 'kdkeg'=>$model->Kd_Keg], ['class' => 'btn btn-primary iconB']);
                    }else{
                        return "-";
                    }

                }
            ],
            [
                'attribute' =>'Pagu Anggaran',
                'format' => 'raw',
                'value' => function($model){
                    $ref=new Referensi;
                    $unit=Yii::$app->user->identity->id_skpd;
                    $sub = Yii::$app->user->identity->id_subunit;
                    return "<div class='text-right'>".$ref->getPaguKegiatan(
                        $model->Kd_Urusan,
                        $model->Kd_Bidang,
                        $unit,
                        $sub,
                        $model->Kd_Prog,
                        $model->Kd_Keg
                    )."</div>";
                }
            ],
        ],
    ]); ?>
</div>
