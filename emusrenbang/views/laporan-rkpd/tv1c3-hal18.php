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
                      'action' => ['laporan-rkpd/cetak-tv1c3-hal18'], 
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
     	<div class="col-md-1"></div><div class="col-md-10"  style="text-align:center;"><h3>Pencapaian Kinerja Pelayanan OPD Dinas Kesehatan <br> Provinsi/Kabupaten/Kota …………**) </h3></div><div class="col-md-1"></div>
    	<br>
    	<div class="col-xs-12">
    		<table class="table table-bordered table-striped">
    			<thead>
    				<tr>
                        <th style="text-align:center;vertical-align:middle;" rowspan="2">NO</th>
                        <th style="text-align:center;vertical-align:middle;" rowspan="2">Indikator</th>
                        <th style="text-align:center;vertical-align:middle;" rowspan="2">SPM/ Standar Nasional</th>
                        <th style="text-align:center;vertical-align:middle;" rowspan="2">IKK (PP-6/'08)</th>
                        <th style="text-align:center;vertical-align:middle;" colspan="4">Target Renstra OPD </th>
                        <th style="text-align:center;vertical-align:middle;" colspan="2">Realisasi Capaian </th>
                        <th style="text-align:center;vertical-align:middle;" colspan="2">Proyeksi </th>
                        <th style="text-align:center;vertical-align:middle;" rowspan="2">Catatan Analisis</th>
    				</tr>
                    <tr>
                        <td style="text-align:center;vertical-align:middle;">Tahun ....... (tahun n-2)</td>
                        <td style="text-align:center;vertical-align:middle;">Tahun ....... (tahun n-1)</td>
                        <td style="text-align:center;vertical-align:middle;">Tahun ....... (tahun n)</td>
                        <td style="text-align:center;vertical-align:middle;">Tahun ....... (tahun n+1)</td>
                        <td style="text-align:center;vertical-align:middle;">Tahun ....... (tahun n-2)</td>
                        <td style="text-align:center;vertical-align:middle;">Tahun ....... (tahun n-1)</td>
                        <td style="text-align:center;vertical-align:middle;">Tahun ....... (tahun n)</td>
                        <td style="text-align:center;vertical-align:middle;">Tahun ....... (tahun n+1)</td>
                    </tr>
    			</thead>
    			<tbody>
    				<tr>
    					<?php for($i=1;$i<=13;$i++): ?>
    					<td style="text-align:center;">(<?=$i?>)</td>
    					<?php endfor; ?>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
