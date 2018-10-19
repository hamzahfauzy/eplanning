<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Pemeringkatan Prioritas Program dan Kegiatan ";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <div class="control-wrap">
          <?php $form = \yii\bootstrap\ActiveForm::begin([
                      'id' => 'search-usulan',
                      'action' => ['laporan-rkpd/cetak-tv1c14'], 
                      'options' => ['target' => '_blank']
          ]) ?>
          <div class="form-group">
              <div class="col-sm-2">
                  <br>
                  <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>
              </div>
          </div>
          <?php \yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
    <div class="box-header with-border">
     	<div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Pemeringkatan Prioritas Program dan Kegiatan Usulan Masyarakat dari Hasil Musrenbang RKPD <br> Kabupaten/Kota dan/atau Forum OPD Kabupaten/Kota </h3></div><div class="col-md-1"></div>
    	<br>
    	<div class="col-xs-12"><h3>Nama OPD : <?=@$unit->kdUnit->Nm_Unit?></h3></div>
    	<div class="col-xs-12">
    		<table class="table table-bordered table-striped">
    			<thead>
    				<tr>
    					<th rowspan="2" style="vertical-align:middle;text-align:center;">No</th>
                        <th rowspan="2" style="vertical-align:middle;text-align:center;">Kegiatan</th>
    					<th colspan="5" style="vertical-align:middle;text-align:center;">Kriteria</th>
    					<th rowspan="2" style="vertical-align:middle;text-align:center;">Total Skor</th>
    					<th rowspan="2" style="vertical-align:middle;text-align:center;">Urutan Prioritas </th>
    				</tr>
    				<tr>
                        <th style="vertical-align:middle;text-align:center;">Kesesuaian dengan Rancangan awal RKPD Provinsi </th>
                        <th style="vertical-align:middle;text-align:center;">Mempercepat pencapaian SPM </th>
                        <th style="vertical-align:middle;text-align:center;">Dukungan pada pemenuhan hak dasar rakyat lintas kabupaten/kota </th>
                        <th style="vertical-align:middle;text-align:center;">Dukungan nilai tambah lintas kabupaten/ kota </th>
                        <th style="vertical-align:middle;text-align:center;">Lain-lain </th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<?php for($i=1;$i<=9;$i++): ?>
    					<td style="text-align:center;">(<?=$i?>)</td>
    					<?php endfor; ?>
    				</tr>
    				<tr>
    					<?php for($i=1;$i<=9;$i++): ?>
    					<td style="text-align:center;"></td>
    					<?php endfor; ?>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
