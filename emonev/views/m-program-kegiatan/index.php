<?php
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\Modal;

$this->title = 'e-Monev '.$Nm_Pemda.' '.$Tahun;
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJsFile(
//         '@web/js/dashboard_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );

?>
<div class="m-program-kegiatan">
    <div class="box box-success">
        <div class="box-body" style="overflow-x:scroll;">
            <div style="overflow:auto">
                <h2>Data Program Kegiatan</h2>
                <?php if(isset($_GET['error'])) : ?>
                <div class="alert alert-danger" role="alert">
                    Error! Import Gagal. Data Sebelumnya sudah pernah di import. Tidak dapat melakukan import lebih dari 1 kali
                </div>
                <?php endif ?>

                <?php if(isset($_GET['delete'])) : ?>
                <div class="alert alert-success" role="alert">
                    Hapus data berhasil!
                </div>
                <?php endif ?>

                <?php if(isset($_GET['edit'])) : ?>
                <div class="alert alert-success" role="alert">
                    Edit data berhasil!
                </div>
                <?php endif ?>
                <a href="index.php?r=m-program-kegiatan/import" class="btn btn-default"><span class="glyphicon glyphicon-download"></span> Import Data</a>
                <p></p>
                <table class="table table-bordered">
                <tr>
                    <th>Kode</th>
                    <th>Program</th>
                    <th>Kegiatan</th>
                    <th>Indikator</th>
                    <th>Satuan</th>
                    <th>Target RPJMD</th>
                    <th>Pagu Target RPJMD (Rp)</th>
                    <th>Target</th>
                    <th>Pagu Target (Rp)</th>
                    <th>Aksi</th>
                </tr>
                <?php if(empty($Model)): ?>
                <tr><td colspan="10" align="center"><i>Tidak ada data</i></td></tr>
                <?php endif ?>
                <?php foreach($Model as $rows): ?>
                <tr>
                    <td><?= $rows["Kd_Urusan"] ?>.<?= $rows["Kd_Bidang"] ?>.<?= $rows["Kd_Unit"] ?>.<?= $rows["Kd_Sub"] ?>.<?= $rows["Kd_Prog"] ?>.<?= $rows["Kd_Keg"] ?></td>
                    <td><?= $rows->program->Ket_Program ?></td>
                    <td><?= $rows["Ket_Keg"] ?></td>
                    <td><?= $rows["Indikator"] ?></td>
                    <td><?= isset($rows->Satuan) ? $rows->Satuan : "<i>Satuan belum di pilih</i>" ?></td>
                    <td><?= $rows["Target_RPJMD"] ?></td>
                    <td><?= number_format($rows["Pagu_Target_RPJMD"]) ?></td>
                    <td><?= $rows["Target"] ?></td>
                    <td><?= number_format($rows["Pagu_Target"]) ?></td>
                    <td>
                        <a href="index.php?r=m-program-kegiatan/edit&kd=<?= $rows["Kd_Urusan"] ?>.<?= $rows["Kd_Bidang"] ?>.<?= $rows["Kd_Unit"] ?>.<?= $rows["Kd_Sub"] ?>.<?= $rows["Kd_Prog"] ?>.<?= $rows["Kd_Keg"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="index.php?r=m-program-kegiatan/hapus&kd=<?= $rows["Kd_Urusan"] ?>.<?= $rows["Kd_Bidang"] ?>.<?= $rows["Kd_Unit"] ?>.<?= $rows["Kd_Sub"] ?>.<?= $rows["Kd_Prog"] ?>.<?= $rows["Kd_Keg"] ?>" class="btn btn-danger"><i class="fa fa-eraser"></i> Hapus</a>
                    </td>
                </tr>
                <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
</div>