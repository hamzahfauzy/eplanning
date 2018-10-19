<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Laporan RKPD";
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/laporan-rkpd.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="row">
            <div class="form col-md-4">
                <?php if(isset($data)): ?>
                <div class="form-group">
                    <label>Sub Unit &emsp;: &emsp;</label>
                    <select class="form-control" name="Kd_sub" id="Kd_Sub" required>
                        <option value="" disabled selected>Pilih Sub Unit</option>
                        <?php foreach ($data as $value): ?>
                            <option value="<?=$value->Kd_Urusan.' '.$value->Kd_Bidang.' '.$value->Kd_Unit.' '.$value->Kd_Sub?>"><?= $value->Nm_Sub_Unit ?></option>
                        <?php endforeach; ?> 
						 
                    </select>
                </div>
                <button type="button" class="btn btn-info" id="btn_tampil">Tampilkan</button>
                <?php endif ;?>
                <!--<button type="button" class="btn btn-primary" id="btn_cetak" disabled>Cetak</button> --> 
				
                               <?= Html::a('Cetak', ['/laporan-rkpd/cetak-lampiran3'], ['class'=>'btn btn-bg btn-primary', 'target'=>'_blank']) ?>
           </div>
            <div class="col-md-8"></div>
        </div>
        <div class="row" id="laporan_rencana_program_daerah<?= isset($data) ? '' : '1' ?>">
        </div>   
    </div>
</div>
