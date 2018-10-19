<?php

use yii\helpers\Html;
use app\models\Referensi;
use yii\widgets\ActiveForm;
$ref=new Referensi();
$level = Yii::$app->user->level;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanSkpd */

$this->title = 'Monitoring Kegiatan SKPD';
$this->params['breadcrumbs'][] = $this->title;
$unit=array();
foreach($modelUnit as $d){
    $unit[$d['Kd_Urusan'].'-'.$d['Kd_Bidang'].'-'.$d['Kd_Unit']]=$d['Nm_Unit'];
}

?>
<div class="kegiatan-skpd-create">
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'Kd_Unit')->dropDownList($unit, ['prompt'=>'Pilih Unit'])->label('SKPD')?>

<?= Html::submitButton($model->isNewRecord ? 'Tampilkan' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
 <?php ActiveForm::end(); ?>

</div>
<?php
if($modelTa!==0){
?>
<br />
<br />
<?php $form = ActiveForm::begin(); ?>
<table class="table">
<thead>
    <tr>
        <th>No</th>
        <th>Program</th>
        <th>Kegiatan</th>
        <th>Lokasi</th>
        <th>Sasaran</th>
        <th>Pagu</th>
        <th>Waktu</th>
        <th></th>
    </tr>
</thead>
<tbody>
<?php
$d=explode("-", $model->Kd_Unit);
            $urusan=$d[0];
            $bidang=$d[1];
            $unit=$d[2];
            $u=$urusan.'-'.$bidang.'-'.$unit;
            ?>
            <?= $form->field($model, 'Kd_Unit')->hiddenInput(['value'=>$u])->label('SKPD')?>
<?php
$i=1;

foreach($modelTa as $data){
    $model->verifikasi[$data['Kd_Prog']][$data['Kd_Keg']][]=$data['Status'];
?>
    <tr>
        <td><?=$i;?></td>
        <td><?= $data['Ket_Program']; ?></td>
        <td><?= $data['Ket_Kegiatan']; ?></td>
        <td><?= $data['Lokasi'] ?></td>
        <td><?= $data['Kelompok_Sasaran']; ?></td>
        <td><?= number_format($data['Pagu_Anggaran']); ?></td>
        <td><?= $data['Waktu_Pelaksanaan']; ?></td>
        <?php if($level=="Penyelia (Bappeda)"){ ?>
            <td><?= $form->field($model, 'verifikasi['.$data['Kd_Prog'].']['.$data['Kd_Keg'].']')->radioList(['1' => 'Setuju', '2' => 'Tidak']); ?></td>
        <?php } ?>
    </tr>
<?php
$i=$i+1;
}
?>
</tbody>
</table>
<?php if($level=="Penyelia (Bappeda)"){ ?>
    <?= Html::submitButton($model->isNewRecord ? 'Proses' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'proses']) ?>
<?php } ?>
 <?php ActiveForm::end(); ?>
<?php
}
?>
