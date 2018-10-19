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
                      'action' => ['laporan-rkpd/cetak-tv1c6-hal23'], 
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
      <div class="col-md-1"></div><div class="col-md-10"  style="text-align:center;"><h3>Rekapitulasi Hasil Evaluasi Pelaksanaan Renja  OPD sampai dengan Tahun Berjalan <br> Kabupaten/Kota *) ………………  </h3></div><div class="col-md-1"></div>
      <br>
      <div class="col-xs-12">Nama OPD : .....</div>
      <div class="col-xs-12">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
                <th style="text-align:center;vertical-align:middle;" rowspan="2">Kode</th>
                <th style="text-align:center;vertical-align:middle;" rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan </th>
                <th style="text-align:center;vertical-align:middle;" rowspan="2">Indikator  Kinerja Program (outcome)/ Kegiatan (output)</th>
                <th style="text-align:center;vertical-align:middle;" rowspan="2">target capaian kinerja Renstra OPD Tahun ........ (akhir periode Renstra OPD)</th>
                <th style="text-align:center;vertical-align:middle;" rowspan="2">Realisasi target kinerja hasil program dan keluaran kegiatan s/d tahun ......  (tahun n-3) </th>
                <th style="text-align:center;vertical-align:middle;" colspan="3">Target dan realisasi kinerja program dan keluaran kegiatan OPD tahun ....... (tahun lalu /n-2) </th>
                <th style="text-align:center;vertical-align:middle;" rowspan="2">Target program / kegiatan  Renja  SKPD tahun berjalan (tahun n-1) </th>
                <th style="text-align:center;vertical-align:middle;" colspan="2">Perkiraan realisasi capaian target program/kegiatan Renstra OPD s/d dengan tahun ..... ... (tahun berjalan/n-1)</th>
                <th style="text-align:center;vertical-align:middle;" rowspan="2">Catatan</th>
            </tr>
            <tr>
                <td style="text-align:center;vertical-align:middle;">Target</td>
                <td style="text-align:center;vertical-align:middle;">Realisasi</td>
                <td style="text-align:center;vertical-align:middle;">Tingkat Realisasi (%)</td>
                <td style="text-align:center;vertical-align:middle;">Realisasi Capaian</td>
                <td style="text-align:center;vertical-align:middle;">Tingkat capaian (%)</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php for($i=1;$i<=12;$i++): ?>
              <td style="text-align:center;"><?= $i==8 ? $i.'(7/6)' : ($i==10 ? $i.'(5+7+9)*' : ($i==11 ? $i.'*' : $i)) ?></td>
              <?php endfor; ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
