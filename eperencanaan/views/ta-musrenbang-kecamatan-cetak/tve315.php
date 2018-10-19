<?php
/* @var $this yii\web\View */
$this->title = 'Daftar Kegiatan yang Belum Disepakati';
$this->params['subtitle'] = 'Hasil';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Laporan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

$PC_Kelompok = Yii::$app->levelcomponent->getKelompok();

$this->registerJsFile(
    '@web/js/musrenbang/tve315.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<h1>Daftar Kegiatan yang Belum Disepakati</h1>
<h3>Tahun <?= $Tahun ?></h3>
<h3>Kecamatan : <?= $PC_Kelompok->kdKec->Nm_Kec ?></h3>
<h3>SKPD : </h3>
<form id="form_cari">
    <div class="row">
        <div class="form-group col-xs-4">
            <select class="form-control" name="skpd">
                <?php
                foreach ($skpd as $pil):
                    $val_skpd = $pil->Kd_Urusan."|".$pil->Kd_Bidang."|".$pil->Kd_Unit."|".$pil->Kd_Sub;
                    ?>
                    <option value="<?=$val_skpd?>"><?= $pil->Nm_Sub_Unit ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group col-xs-1">
            <button type="button" id="btn-lihat" class="btn btn-primary"> Lihat</button>
        </div>
    </div>
</form>

<hr>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <td>No.</td>
            <td>Kegiatan</td>
            <td>Lokasi Kelurahan</td>
            <td>Volume</td>
            <td>Alasan</td>
        </tr>
    </thead>
    <tbody id="isi-wrap">

    </tbody>
</table>