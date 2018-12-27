<?php
use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use yii\bootstrap\Modal;

$this->title = 'E-Evaluasi RKPD '.$Nm_Pemda;
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/dashboard_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$triwulan = isset($_GET['triwulan']) ? $_GET['triwulan'] : 1;

?>
<div class="m-program-kegiatan">
    <div class="box box-success">
        <div class="box-body">
            <h2>Realisasi Triwulan</h2>
            <?php if(isset($_GET['edit'])) : ?>
            <div class="alert alert-success" role="alert">
                Edit data berhasil!
            </div>
            <?php endif ?>
            <?php if(isset($_GET['hapus'])) : ?>
            <div class="alert alert-success" role="alert">
                Hapus data berhasil!
            </div>
            <?php endif ?>
            <div class="form-group form-inline">
            <label for="">Triwulan</label>
            <select class="form-control" onchange="if(this.value > 0) location='index.php?r=m-monitoring/index&tahun=<?=$Tahun?>&triwulan='+this.value">
                <option value="0">- Pilih Triwulan -</option>
                <option <?= isset($_GET['triwulan']) && $_GET['triwulan'] == 1 ? "selected=''" : "" ?>>1</option>
                <option <?= isset($_GET['triwulan']) && $_GET['triwulan'] == 2 ? "selected=''" : "" ?>>2</option>
                <option <?= isset($_GET['triwulan']) && $_GET['triwulan'] == 3 ? "selected=''" : "" ?>>3</option>
                <option <?= isset($_GET['triwulan']) && $_GET['triwulan'] == 4 ? "selected=''" : "" ?>>4</option>
            </select>
            <label for="">Pilih Tahun</label>
                <select name="tahun" id="tahun" class="form-control" onchange="showData(1,this.value,<?=$triwulan?>)">
                <option value="">Pilih Tahun</option>
                <?php foreach($list_tahun as $thn): ?>
                <option value="<?= $thn ?>" <?= $Tahun == $thn ? "selected=''" : "" ?>><?= $thn ?></option>
                <?php endforeach ?>
                </select>
            </div>
            </div>
            <table class="table table-bordered">
            <tr>
                <th>Kode</th>
                <th>Program</th>
                <th>Kegiatan</th>
                <th>Jumlah (K)</th>
                <th>Pagu (Rp)</th>
                <th>Aksi</th>
            </tr>
            <?php if(empty($Model)): ?>
            <tr><td colspan="6" align="center"><i>Tidak ada data</i></td></tr>
            <?php endif ?>

            <?php 
                foreach($Model as $rows): 
                    $jumlah_kinerja = "Jumlah_Kinerja_".$triwulan;
                    $uang_kinerja = "Uang_Kinerja_".$triwulan;
                    $jumlah = $rows->{$jumlah_kinerja};
                    $uang = $rows->{$uang_kinerja};
            ?>
            <tr>
                <td><?= $rows["Kd_Urusan"] ?>.<?= $rows["Kd_Bidang"] ?>.<?= $rows["Kd_Unit"] ?>.<?= $rows["Kd_Sub"] ?>.<?= $rows["Kd_Prog"] ?>.<?= $rows["Kd_Keg"] ?></td>
                <td><?= $rows->program->Ket_Program ?></td>
                <td><?= $rows->kegiatan->Ket_Kegiatan ?></td>
                <td><?= $jumlah ?> <?= @$rows->Satuan ?></td>
                <td><?= number_format($uang,0,",",".") ?></td>
                <td>
                <?php if($rows->Pagu_Target == 0 || $rows->Target == 0): ?>
                <i>Target dan Pagu Target belum di isi</i>
                <?php else: ?>
                <a href="index.php?r=m-monitoring/edit&tahun=<?=$Tahun?>&kd=<?= $rows["Kd_Urusan"] ?>.<?= $rows["Kd_Bidang"] ?>.<?= $rows["Kd_Unit"] ?>.<?= $rows["Kd_Sub"] ?>.<?= $rows["Kd_Prog"] ?>.<?= $rows["Kd_Keg"] ?>&triwulan=<?=$triwulan?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a href="index.php?r=m-monitoring/hapus&tahun=<?=$Tahun?>&kd=<?= $rows["Kd_Urusan"] ?>.<?= $rows["Kd_Bidang"] ?>.<?= $rows["Kd_Unit"] ?>.<?= $rows["Kd_Sub"] ?>.<?= $rows["Kd_Prog"] ?>.<?= $rows["Kd_Keg"] ?>&triwulan=<?=$triwulan?>" class="btn btn-danger"><i class="fa fa-eraser"></i> Hapus</a>
                <?php endif ?>
                </td>
            </tr>
            <?php endforeach ?>
            </table>
        </div>
    </div>
</div>