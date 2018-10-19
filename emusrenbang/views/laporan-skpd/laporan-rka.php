<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Laporan RKA";
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/laporan-skpd.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="box box-success">
    <div class="box-header">
        <div class="row">
        <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['laporan-skpd/laporan-rka-cetak'],
                'options' => ['target' => '_blank']
            ]);
        ?>
            <div class="form col-md-3">
                <div class="form-group">
                    <label>Program &emsp;: &emsp;</label>
                    <select class="form-control" name="Kd_Prog" id="Kd_Prog" required>
                        <option value="" disabled selected>Pilih Program</option>
                        <?php foreach ($data as $value): ?>
                            <option value="<?=$value->Kd_Urusan.' '.$value->Kd_Bidang.' '.$value->Kd_Unit.' '.$value->Kd_Sub.' '.$value->Kd_Prog?>"><?= $value->Ket_Prog ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form col-md-3">
                <div class="form-group">
                    <label>Kegiatan &emsp;: &emsp;</label>
                    <i id="loading"></i>
                    <select class="form-control" name="Kd_Keg" id="Kd_Keg" required>
                        <option value="" disabled selected>Pilih Kegiatan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-info" id="btn_tampil">Tampilkan</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="box-header with-border" id="laporan_rka_tampil">
    </div>
</div>
