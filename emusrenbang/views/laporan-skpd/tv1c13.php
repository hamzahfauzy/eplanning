<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Kajian Usulan Program dan Kegiatan";
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['laporan-skpd/sub-unit']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <h3 class="box-tilte" style="text-align: center;">
            Kajian Usulan Program dan Kegiatan dari <?= $kelompok['Kab'] ?> Tahun <?= $tahun ?><br> Provinsi <?= $kelompok['Prov'] ?>
        </h3>
        <label>Nama OPD : <?= $subunit->Nm_Sub_Unit ?></label>
    </div>
    <div class="box-body">
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
