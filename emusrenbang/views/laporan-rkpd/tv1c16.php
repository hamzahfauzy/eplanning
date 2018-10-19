<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Kajian Usulan Program dan Kegiatan";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <div class="control-wrap">
          <?php $form = \yii\bootstrap\ActiveForm::begin([
                      'id' => 'search-usulan',
                      'action' => ['laporan-rkpd/cetak-tv1c16'], 
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
     	<div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Kajian Usulan Program dan Kegiatan dari Masyarakat Tahun ……. <br>Kabupaten/Kota ……… </h3></div><div class="col-md-1"></div>
    	<br>
    	<div class="col-xs-12"><h3>Nama OPD : .........</h3></div>
    	<div class="col-xs-12">
    		<table class="table table-bordered">
    			<thead>
    				<tr>
    					<th style="text-align:center;vertical-align:center;">No</th>
    					<th style="text-align:center;vertical-align:center;">Program/ Kegiatan</th>
    					<th style="text-align:center;vertical-align:center;">Lokasi</th>
    					<th style="text-align:center;vertical-align:center;">Indikator Kinerja</th>
                        <th style="text-align:center;vertical-align:center;">Besaran/ Volume</th>
                        <th style="text-align:center;vertical-align:center;">Pagu</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<?php for($i=1;$i<=6;$i++): ?>
    					<td style="text-align:center;">(<?=$i?>)</td>
    					<?php endfor; ?>
    				</tr>
    				<tr>
    					<?php for($i=1;$i<=6;$i++): ?>
    					<td></td>
    					<?php endfor; ?>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
