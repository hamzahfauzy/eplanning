<?php
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\Modal;

$this->title = 'e-Monev '.$Nm_Pemda;
$this->params['breadcrumbs'][] = $this->title;

// $this->registerJsFile(
//         '@web/js/dashboard_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );

$triwulan = isset($_GET['triwulan']) ? $_GET['triwulan'] : 1;

?>
<div class="m-program-kegiatan">
    <div class="box box-success">
        <div class="box-body" style="overflow-x:scroll;">
            <h2>Laporan</h2>
            <div class="overflow:auto">
                <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Sasaran</th>
                    <th>Kode</th>
                    <th>Urusan/Bidan Urusan Pemerintah Daerah dan Program Kegiatan</th>
                    <th>Indikator Kinerja Program (outcome)/Kegiatan (output)</th>
                    <th colspan="2">Target RPJMD Kabupaten pada Tahun 2021 (Akhir Periode RPJMD)</th>
                    <th colspan="2">Realisasi Capaian Kinerja RPJMD Kabupaten sampai dengan RKPD Kabupaten Tahun Lalu (n-2)</th>
                    <th colspan="2">Target Kinerja dan Anggaran RKPD Kabupaten Tahun Berjalan (Tahun n-1 yang dievaluasi)</th>
                    <th colspan="8">Realisasi Kinerja Pada Triwulan</th>
                    <th colspan="2">Realisasi Capaian Kinerja dan Anggaran RKPD Kabupaten yang dievaluasi</th>
                    <th colspan="2">Realisasi Kinerja dan Anggaran RPJMD Kabupaten s/d Tahun 2018 (Akhir Tahun Pelaksanaan RKPD Tahun 2018)</th>
                    <th colspan="2">Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD Kabupaten s/d Tahun 2021 (%)</th>
                    <th>Unit Perangkat Daerah Penanggung Jawab</th>
                </tr>
                <tr>
                <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>K</td>
                    <td>Rp</td>
                    <td>K</td>
                    <td>RP</td>
                    <td>K</td>
                    <td>Rp</td>
                    <td>K</td>
                    <td>Rp</td>
                    <td>K</td>
                    <td>Rp</td>
                    <td>K</td>
                    <td>Rp</td>
                    <td>K</td>
                    <td>Rp</td>
                    <td>K</td>
                    <td>Rp</td>
                    <td>K</td>
                    <td>Rp</td>
                    <td>K</td>
                    <td>Rp</td>
                    <td></td>
                </tr>
                <?php if(empty($Model)): ?>
                <tr><td colspan="6" align="center"><i>Tidak ada data</i></td></tr>
                <?php endif ?>

                <?php
                    $old_prog = 0; 
                    foreach($Model as $rows): 
                        $realisasi_old = 0;
                        $uang_old = 0;
                        $new_prog = $rows->Kd_Prog;
                        $realisasi = $rows->Jumlah_Kinerja_1 + $rows->Jumlah_Kinerja_2 + $rows->Jumlah_Kinerja_3 + $rows->Jumlah_Kinerja_4;
                        $uang = $rows->Uang_Kinerja_1 + $rows->Uang_Kinerja_2 + $rows->Uang_Kinerja_3 + $rows->Uang_Kinerja_4;
                ?>
                <?php if($new_prog != $old_prog): $old_prog = $new_prog; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3"><b><?= $rows->program->Ket_Program ?></b></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="8"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td colspan="2"></td>
                    <td></td>
                </tr>
                <?php endif ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><?= $rows["Kd_Urusan"] ?>.<?= $rows["Kd_Bidang"] ?>.<?= $rows["Kd_Unit"] ?>.<?= $rows["Kd_Sub"] ?>.<?= $rows["Kd_Prog"] ?>.<?= $rows["Kd_Keg"] ?></td>
                    <td><?= $rows->kegiatan->Ket_Kegiatan ?></td>
                    <td><?= $rows->Indikator ?></td>
                    <td><?= $realisasi_old ?> <?= @$rows->satuan->Uraian ?></td>
                    <td><?= number_format($uang_old) ?></td>
                    <td>12 <?= @$rows->satuan->Uraian ?></td>
                    <td>0</td>
                    <td><?= $rows->Target ?> <?= @$rows->satuan->Uraian ?></td>
                    <td><?= $rows->Pagu_Target ?></td>
                    <td><?= $rows->Jumlah_Kinerja_1 ?> <?= @$rows->satuan->Uraian ?></td>
                    <td><?= number_format($rows->Uang_Kinerja_1) ?></td>
                    <td><?= $rows->Jumlah_Kinerja_2 ?> <?= @$rows->satuan->Uraian ?></td>
                    <td><?= number_format($rows->Uang_Kinerja_2) ?></td>
                    <td><?= $rows->Jumlah_Kinerja_3 ?> <?= @$rows->satuan->Uraian ?></td>
                    <td><?= number_format($rows->Uang_Kinerja_3) ?></td>
                    <td><?= $rows->Jumlah_Kinerja_4 ?> <?= @$rows->satuan->Uraian ?></td>
                    <td><?= number_format($rows->Uang_Kinerja_4) ?></td>
                    <td><?= $realisasi ?> <?= @$rows->satuan->Uraian ?></td>
                    <td><?= number_format($uang) ?></td>
                    <td><?= $realisasi_old + $realisasi ?> <?= @$rows->satuan->Uraian ?></td>
                    <td><?= number_format($uang+$uang_old) ?></td>
                    <td></td>
                    <td></td>
                    <td><?= $rows->sub->Nm_Sub_Unit ?></td>
                </tr>
                <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
</div>