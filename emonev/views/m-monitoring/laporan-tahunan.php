<?php
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\Modal;

$this->title = 'E-Evaluasi RKPD '.$Nm_Pemda;
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/laporan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$triwulan = isset($_GET['triwulan']) ? $_GET['triwulan'] : 1;
$Tahun = isset($_GET['tahun']) ? $_GET['tahun'] : $Tahun;


?>
<div class="m-program-kegiatan">
    <div class="box box-success">
        <div class="box-body" style="overflow-x:scroll;">
            <h2>Laporan</h2>
            <div class="form-inline">
                <label for="">Pilih Tahun</label>
                    <select name="tahun" id="tahun" class="form-control" onchange="location=location+'&tahun='+this.value">
                    <option value="">Pilih Tahun</option>
                    <?php foreach($list_tahun as $thn): ?>
                    <option value="<?= $thn ?>" <?= $Tahun == $thn ? "selected=''" : "" ?>><?= $thn ?></option>
                    <?php endforeach ?>
                    </select>
                    <button class="btn btn-warning" onclick="doPrint()"><i class="fa fa-print"></i> Cetak Laporan</button>
            </div>
            <p></p>
            <div class="overflow:auto">
                <!-- print div -->
                <div class="print">
                    <table class="table table-bordered">
                    <tr>
                        <th style="text-align:center !important;">No</th>
                        <th style="text-align:center !important;">Sasaran</th>
                        <th style="text-align:center !important;">Kode</th>
                        <th style="text-align:center !important;">Urusan/Bidang Urusan Pemerintah Daerah dan Program Kegiatan</th>
                        <th style="text-align:center !important;">Indikator Kinerja Program (outcome)/Kegiatan (output)</th>
                        <th style="text-align:center !important;" colspan="2">Target Kinerja dan Anggaran RKPD Kabupaten Tahun <?= $Tahun ?></th>
                        <th style="text-align:center !important;" colspan="8">Realisasi Kinerja Pada Triwulan</th>
                        <th style="text-align:center !important;" colspan="2">Realisasi Capaian Kinerja dan Anggaran RKPD Kabupaten Tahun <?= $Tahun ?></th>
                        <th style="text-align:center !important;" colspan="2">Tingkat Capaian Kinerja dan Realisasi Anggaran RPJMD Kabupaten Tahun <?= $Tahun ?> (%)</th>
                        <th style="text-align:center !important;">Unit Perangkat Daerah Penanggung Jawab</th>
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
                        <td>12</td>
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
                            $new_prog = $rows->Kd_Prog;
                            $realisasi = $rows->Jumlah_Kinerja_1 + $rows->Jumlah_Kinerja_2 + $rows->Jumlah_Kinerja_3 + $rows->Jumlah_Kinerja_4;
                            $uang = $rows->Uang_Kinerja_1 + $rows->Uang_Kinerja_2 + $rows->Uang_Kinerja_3 + $rows->Uang_Kinerja_4;
                            $persen_realisasi = $rows->Target == 0 ? 0 : ($realisasi / $rows->Target) * 100;
                            $persen_uang = $rows->Target == 0 ? 0 : ($uang / $rows->Pagu_Target) * 100;
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
                        <td colspan="3" align="right">Rata-rata Capaian Kinerja (%)</td>
                        <td colspan="10" style="background:#999;"></td>
                        <td><b><?= number_format($rata_capaian,2,',','.') ?></b></td>
                        <td><b><?= number_format($rata_capaian_uang,2,',','.') ?></b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3" align="right">Predikat Kinerja</td>
                        <td colspan="10" style="background:#999;"></td>
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
                        <td colspan="8"></td>
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
                        <td><?= $rows->Target ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Pagu_Target,0,',','.') ?></td>
                        <td><?= $rows->Jumlah_Kinerja_1 ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Uang_Kinerja_1,0,',','.') ?></td>
                        <td><?= $rows->Jumlah_Kinerja_2 ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Uang_Kinerja_2,0,',','.') ?></td>
                        <td><?= $rows->Jumlah_Kinerja_3 ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Uang_Kinerja_3,0,',','.') ?></td>
                        <td><?= $rows->Jumlah_Kinerja_4 ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($rows->Uang_Kinerja_4,0,',','.') ?></td>
                        <td><?= $realisasi ?> <?= @$rows->Satuan ?></td>
                        <td><?= number_format($uang,0,',','.') ?></td>
                        <td><?= number_format($persen_realisasi,2,',','.') ?></td>
                        <td><?= number_format($persen_uang,2,',','.') ?></td>
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