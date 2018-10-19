<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Laporan RKPD";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <div class="control-wrap">
          <?php $form = \yii\bootstrap\ActiveForm::begin([
                      'id' => 'search-usulan',
                      'action' => ['laporan-rkpd/tv1c1-cetak'], 
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
     	<div class="col-md-1"></div><div class="col-md-10" align="center"><h3>Penggabungan Prioritas Masukan Masyarakat dengan Rancangan Renja OPD <br> Kabupaten/kota ………….*</h3></div><div class="col-md-1"></div>
    	<br>
    	<div class="col-xs-12"><h4>Nama SKPD : </h4></div>
    	<div class="col-xs-12">
    		<table class="table table-bordered table-striped">
    			<thead>
    				<tr>
                        <th></th>
                        <th colspan="5"><p style="text-align:center;">Rancangan Renja </p></th>
                        <th colspan="5"><p style="text-align:center;">Hasil Prioritas Masukan Masyarakat </p></th>
                        <th rowspan="2"><p style="text-align:center;">Catatan Penting </p></th>
    				</tr>
                    <tr>
                        <th><p style="text-align:center;">No </p></th>
                        <th><p style="text-align:center;">Program/ Kegiatan </p></th>
                        <th><p style="text-align:center;">Lokasi </p></th>
                        <th><p style="text-align:center;">Indikator Kinerja </p></th>
                        <th><p style="text-align:center;">Target Capaian </p></th>
                        <th><p style="text-align:center;">Pagu Indikatif (Rp.000) </p></th>
                        <th><p style="text-align:center;">Program/ Kegiatan </p></th>
                        <th><p style="text-align:center;">Lokasi </p></th>
                        <th><p style="text-align:center;">Indikator Kinerja </p></th>
                        <th><p style="text-align:center;">Target Capaian </p></th>
                        <th><p style="text-align:center;">Kebutuhan Dana (Rp.000) </p></th>
                    </tr>
    			</thead>
    			<tbody>
    				<tr>
    					<?php for($i=1;$i<=12;$i++): ?>
    					<td><p class="text-center">(<?=$i?>)</p></td>
    					<?php endfor; ?>
    				</tr>
    				<tr>
    					<?php for($i=1;$i<=12;$i++): ?>
    					<td><p class="text-center"></p></td>
    					<?php endfor; ?>
    				</tr>
    				<tr>
    					<?php for($i=1;$i<=12;$i++): ?>
    					<td><p class="text-center"></p></td>
    					<?php endfor; ?>
    				</tr>
    				<tr>
    					<?php for($i=1;$i<=12;$i++): ?>
    					<td><p class="text-center"></p></td>
    					<?php endfor; ?>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
