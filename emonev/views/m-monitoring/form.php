<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

$this->title = 'e-Monev '.$Nm_Pemda;
$this->params['breadcrumbs'][] = $this->title;

$triwulan = isset($_GET['triwulan']) ? $_GET['triwulan'] : 1;
$jumlah_kinerja = "Jumlah_Kinerja_".$triwulan;
$uang_kinerja = "Uang_Kinerja_".$triwulan;
$jumlah = $model->{$jumlah_kinerja};
$uang = $model->{$uang_kinerja};

?>
<div class="m-program-kegiatan">
    <div class="box box-success">
        <div class="box-body">
            <h2>Edit Program Kegiatan</h2>
            <?php $form = ActiveForm::begin(); ?>
            <label for="">Urusan</label>
            <input type="text" value="<?= $model->urusan->Nm_Urusan?>" readonly class="form-control">
            <label for="">Bidang</label>
            <input type="text" value="<?= $model->bidang->Nm_Bidang?>" readonly class="form-control">
            <label for="">Unit</label>
            <input type="text" value="<?= $model->unit->Nm_Unit?>" readonly class="form-control">
            <label for="">Sub Unit</label>
            <input type="text" value="<?= $model->sub->Nm_Sub_Unit?>" readonly class="form-control">
            <label for="">Program</label>
            <input type="text" value="<?= $model->program->Ket_Program?>" readonly class="form-control">
            <label for="">Kegiatan</label>
            <input type="text" value="<?= $model->kegiatan->Ket_Kegiatan?>" readonly class="form-control">
            <label for="">Jumlah (<?= $model->satuan->Uraian ?>)</label>
            <input type="text" name="jumlah" class="form-control" required value="<?=$jumlah?>">
            <label for="">Pagu</label>
            <input type="text" name="pagu" class="form-control" required value="<?=$uang?>">
            <p></p>
            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            <a href="index.php?r=m-monitoring/index" class="btn btn-warning" type="button"><i class="fa fa-reply"></i> Kembali</a>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>