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
                      'action' => ['laporan-rkpd/cetak-tv1c2-hal17'], 
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
     	<div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Angka Partisipasi Murni (APM) <br> Provinsi/Kabupaten/Kota.....*) <br> Tahun .....***) </h3></div><div class="col-md-1"></div>
    	<br>
    	<div class="col-xs-12">
    		<table class="table table-bordered table-striped">
    			<thead>
    				<tr>
                        <th style="text-align:center;vertical-align:middle;" rowspan="2">NO</th>
                        <th style="text-align:center;vertical-align:middle;" rowspan="2">Kabupaten/Kota/Kecamatan</th>
                        <th style="text-align:center;vertical-align:middle;" colspan="3">SD/MI </th>
                        <th style="text-align:center;vertical-align:middle;" colspan="3">SMP/MTs </th>
                        <th style="text-align:center;vertical-align:middle;" colspan="3">SMA/MA/SMK </th>
    				</tr>
                    <tr>
                        <td style="text-align:center;vertical-align:middle;font-size:12px;">Jumlah siswa usia 7-12 th bersekolah di SD/MI </td>
                        <td style="text-align:center;vertical-align:middle;font-size:12px;">Jumlah pendudu k usia 712 th </td>
                        <td style="text-align:center;vertical-align:middle;">APM</td>
                        <td style="text-align:center;vertical-align:middle;font-size:12px;">Jumlah siswa usia 1315 th bersekol ah di SMP/MTs</td>
                        <td style="text-align:center;vertical-align:middle;font-size:12px;">Jumlah pendudu k usia 13-15 th</td>
                        <td style="text-align:center;vertical-align:middle;">APM</td>
                        <td style="text-align:center;vertical-align:middle;font-size:12px;">Jumlah siswa usia 16-18 th bersekola h di SMA/MA/ SMK </td>
                        <td style="text-align:center;vertical-align:middle;font-size:12px;">Jumlah penduduk usia 1618th </td>
                        <td style="text-align:center;vertical-align:middle;">APM</td>
                    </tr>
    			</thead>
    			<tbody>
    				<tr>
    					<?php for($i=1;$i<=11;$i++): ?>
    					<td><p class="text-center">(<?=$i?>)</p></td>
    					<?php endfor; ?>
    				</tr>
    				<tr>
    					<?php for($i=1;$i<=11;$i++): ?>
    					<td><p class="text-center"></p></td>
    					<?php endfor; ?>
    				</tr>
    				<tr>
    					<?php for($i=1;$i<=11;$i++): ?>
    					<td><p class="text-center"></p></td>
    					<?php endfor; ?>
    				</tr>
    				<tr>
    					<?php for($i=1;$i<=11;$i++): ?>
    					<td><p class="text-center"></p></td>
    					<?php endfor; ?>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
