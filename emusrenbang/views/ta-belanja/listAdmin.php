<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;

$meIdUrusan=$urusan;
$meIdBidang=$bidang;
$meIdSkpd=$unit;

$meDataUrusan=$ref->getUrusanOne($meIdUrusan);
$meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);


$this->title = 'Program Tahun '.(date('Y')+1);
$this->params['breadcrumbs'][] = ['label' => "Program SKPD", 'url' => ['ref-kegiatan-skpd/programskpd']];
$this->params['breadcrumbs'][] = 'Data Program';

?>
<div class="ref-kegiatan-index">
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
        </tbody>
    </table>
    <table class="pagu pull-right">
        <tr>
            <td>Pagu Indikatif SKPD</td>
            <td class="dot">:</td>
            <td class="vPagu"><?= number_format($paguUnit,0,',','.') ?></td>
        </tr>
        <tr>
            <td>Sisa Pagu Indikatif SKPD</td>
            <td class="dot">:</td>
            <td class="vPagu"><?= number_format($paguSisa,0,',','.') ?></td>
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
                'attribute' =>'Ket_Program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Cari Nama Program'
                ],
                'format' => 'raw',
                'value' => function($model,$meIdSkpd){
                    $ref=new Referensi;
                    return Html::a($model->Kd_Prog.":".$model->Ket_Program, ['listkegiatan', 'id'=>$model->Kd_Prog], ['class' => 'btn btn-success  tunder']).
                    Html::a($ref->getKegiatanByCount($model->Kd_Urusan,$model->Kd_Bidang,$meIdSkpd,$model->Kd_Prog).' Kegiatan', ['kegiatan', 'id'=>$model->Kd_Prog], ['class' => 'btn btn-warning']);
                }
            ],
            [
                'attribute' =>'Pagu Indikatif',
                'format' => 'raw',
                'value' => function($model,$meIdSkpd){
                    $ref=new Referensi;
                    return "<div class='text-right'>".$ref->getPaguProgramAdmin(
                        $model->Kd_Urusan,
                        $model->Kd_Bidang,
                        $meIdSkpd,
                        $model->Kd_Prog
                    )."</div>";
                }
            ]
        ],
    ]); ?>
</div>