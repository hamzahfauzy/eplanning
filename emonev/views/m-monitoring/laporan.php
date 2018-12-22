<?php
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\Modal;

$this->title = 'e-Monev '.$Nm_Pemda;
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/laporan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$triwulan = isset($_GET['triwulan']) ? $_GET['triwulan'] : 1;

$min_tahun = 2016;
$max_tahun = $Tahun;
$selisih = $max_tahun - $min_tahun;

?>
<div class="m-program-kegiatan">
    <div class="box box-success">
        <div class="box-body" style="overflow-x:scroll;">
            <h2>Laporan</h2>
            <button class="btn btn-warning" onclick="doPrint()"><i class="fa fa-print"></i> Cetak Laporan</button>
            <p></p>
            <div class="overflow:auto">
                <!-- print div -->
                <div class="print">
                    <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Sasaran</th>
                        <th>Kode</th>
                        <th>Urusan/Bidan Urusan Pemerintah Daerah dan Program Kegiatan</th>
                        <th>Indikator Kinerja Program (outcome)/Kegiatan (output)</th>
                        <th colspan="2">Target RPJMD Kabupaten pada Tahun 2021 (Akhir Periode RPJMD)</th>
                        <th colspan="2">Realisasi Capaian Kinerja RPJMD Kabupaten sampai dengan RKPD Kabupaten Tahun Lalu (n-<?=$selisih?>)</th>
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
                    <tr style="text-align:center;">
                        <td>1</td>
                        <td>2</td>
                        <td></td>
                        <td>3</td>
                        <td>4</td>
                        <td colspan="2">5</td>
                        <td colspan="2">6</td>
                        <td colspan="2">7</td>
                        <td colspan="2">8</td>
                        <td colspan="2">9</td>
                        <td colspan="2">10</td>
                        <td colspan="2">11</td>
                        <td colspan="2">12</td>
                        <td colspan="2">13</td>
                        <td colspan="2">14</td>
                        <td>15</td>
                    </tr>
                    <?php if(empty($Model)): ?>
                    <tr><td colspan="26" align="center"><i>Tidak ada data</i></td></tr>
                    <?php endif ?>

                    <?php
                        $old_prog = 0; 
                        $k_total = 0;
                        $rp_total = 0;
                        $num_of_kegiatan = 0;
                        foreach($Model as $rows): 
                            $odata = $old_data($rows->Kd_Urusan,$rows->Kd_Bidang,$rows->Kd_Unit,$rows->Kd_Sub,$rows->Kd_Prog,$rows->Kd_Keg);
                            $realisasi_old = $odata->K;
                            $uang_old = $odata->RP;
                            $new_prog = $rows->Kd_Prog;
                            $realisasi = $rows->Jumlah_Kinerja_1 + $rows->Jumlah_Kinerja_2 + $rows->Jumlah_Kinerja_3 + $rows->Jumlah_Kinerja_4;
                            $uang = $rows->Uang_Kinerja_1 + $rows->Uang_Kinerja_2 + $rows->Uang_Kinerja_3 + $rows->Uang_Kinerja_4;
                            $realisasi_rpjmd = $realisasi_old + $realisasi;
                            $uang_rpjmd = $uang+$uang_old;
                            $persen_realisasi = $realisasi_rpjmd == 0 || $rows->Target_RPJMD == 0 ? 0 : ($realisasi_rpjmd / $rows->Target_RPJMD) * 100;
                            $persen_uang = $realisasi_rpjmd == 0 || $rows->Target_RPJMD == 0 ? 0 : ($uang_rpjmd / $rows->Pagu_Target_RPJMD) * 100;
                            $k_total += $persen_realisasi;
                            $rp_total += $persen_uang;
                            $num_of_kegiatan++;
                    ?>
                    <?php if($new_prog != $old_prog):  ?>
                    <?php 
                    if($old_prog != 0): 
                        $rata_capaian = $k_total / $num_of_kegiatan;
                        $rata_capaian_uang = $rp_total / $num_of_kegiatan;
                        $predikat_k = "Sangat Rendah";
                        $predikat_rp = "Sangat Rendah";
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="7" align="right">Rata-rata Capaian Kinerja (%)</td>
                        <td colspan="12" style="background:#999;"></td>
                        <td><b><?= number_format($rata_capaian,2) ?></b></td>
                        <td><b><?= number_format($rata_capaian_uang,2) ?></b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="7" align="right">Predikat Kinerja</td>
                        <td colspan="12" style="background:#999;"></td>
                        <td><b><?= $predikat_k ?></b></td>
                        <td><b><?= $predikat_rp ?></b></td>
                        <td></td>
                    </tr>
                    <?php $rata_capaian = 0;$rata_capaian_uang=0;$k_total=0;$rp_total=0;$num_of_kegiatan=0; 
                        endif; $old_prog = $new_prog; ?>
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
                        <td><?= $rows->Target_RPJMD ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Pagu_Target_RPJMD) ?></td>
                        <td><?= $realisasi_old ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($uang_old) ?></td>
                        <td><?= $rows->Target ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Pagu_Target) ?></td>
                        <td><?= $rows->Jumlah_Kinerja_1 ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Uang_Kinerja_1) ?></td>
                        <td><?= $rows->Jumlah_Kinerja_2 ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Uang_Kinerja_2) ?></td>
                        <td><?= $rows->Jumlah_Kinerja_3 ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Uang_Kinerja_3) ?></td>
                        <td><?= $rows->Jumlah_Kinerja_4 ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Uang_Kinerja_4) ?></td>
                        <td><?= $realisasi ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($uang) ?></td>
                        <td><?= $realisasi_rpjmd ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($uang_rpjmd) ?></td>
                        <td><?= number_format($persen_realisasi,2) ?></td>
                        <td><?= number_format($persen_uang,2) ?></td>
                        <td><?= $rows->sub->Nm_Sub_Unit ?></td>
                    </tr>
                    <?php endforeach ?>
                    </table>
                </div> 
                <!-- print div -->
            </div>
        </div>
    </div>
</div>