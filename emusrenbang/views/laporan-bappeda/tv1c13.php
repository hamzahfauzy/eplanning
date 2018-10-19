<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Kajian Usulan Program dan Kegiatan";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <?= Html::a('&nbsp;Cetak&nbsp;', ['cetak-tv1c13',
                    'urusan' => $skpd->Kd_Urusan,
                    'bidang' => $skpd->Kd_Bidang,
                    'unit' => $skpd->Kd_Unit,
                    'sub' => $skpd->Kd_Sub,
                ], 
                ['class' => 'btn btn-primary btn-lg', 'target' => '_blank']);
        ?>
    </div>
    <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Kajian Usulan Program dan Kegiatan dari <?= $kelompok['Kab'] ?> Tahun <?= date('Y') ?> <br> Provinsi <?= $kelompok['Prov'] ?></h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12"><h3>Nama OPD : <?= $skpd->Nm_Sub_Unit ?></h3></div>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Program/ Kegiatan</th>
                        <th style="text-align:center;">Lokasi</th>
                        <th style="text-align:center;">Indikator Kerja</th>
                          <th style="text-align:center;">Besaran/ Volume</th>
                        <th style="text-align:center;">Pagu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php for($i=1;$i<=6;$i++): ?>
                        <td style="text-align:center;">(<?=$i?>)</td>
                        <?php endfor; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
