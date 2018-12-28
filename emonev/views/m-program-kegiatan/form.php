<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

$this->title = 'E-Evaluasi RKPD '.$Nm_Pemda;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="m-program-kegiatan">
    <div class="box box-success">
        <div class="box-body">
            <?php
            if(empty($model))
            {
                echo "<h2>Tidak ada data</h2>";
                echo '<a href="index.php?r=m-program-kegiatan/index&tahun='.$Tahun.'" class="btn btn-warning" type="button"><i class="fa fa-reply"></i> Kembali</a>';
            }else{
            ?>
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
            <label for="">Satuan</label>
            <input type="text" value="<?= $model->Satuan?>" readonly class="form-control">
            <label for="">Target (K)</label>
            <input type="text" name="target" class="form-control" required value="<?=$model->Target?>">
            <label for="">Target (Rp)</label>
            <input type="text" name="pagu_target" class="form-control" required value="<?=$model->Pagu_Target?>">
            <p></p>
            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            <a href="index.php?r=m-program-kegiatan/index&tahun=<?=$Tahun?>" class="btn btn-warning" type="button"><i class="fa fa-reply"></i> Kembali</a>
            <?php ActiveForm::end(); ?>
            <?php } ?>
        </div>
    </div>
</div>