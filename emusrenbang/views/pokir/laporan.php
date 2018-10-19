<?php

use yii\helpers\Html;

$this->registerJsFile(
        '@web/js/musrenbang/laporan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Laporan';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- <div class="alert alert-info">
    <strong>Silahkan melakukan Skoring pada usulan Kelurahan.</strong><br>
    <i>Pastikan semua usulan Kelurahan sudah diskoring untuk menentukan prioritas.</i>          
</div> -->

<div class="col-md-12">
    <div class="row">
        <div class="col-md-1">
        </div>
                    
    </div>
</div>

<div class="col-md-12">
  <div class="control-wrap">
    <?php
        $form = \yii\bootstrap\ActiveForm::begin(['id' => 'search-usulan',
                    'action' => ['pokir/laporan-cetak'], 'options' => ['target' => '_blank']])
        ?>
    <div class="col-md-1">
        <div class="form-group">
            <label >&nbsp;</label>
            <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'form-control btn btn-primary']); ?>
        </div>
    </div>
    <?php \yii\bootstrap\ActiveForm::end() ?>
  </div>
  <div class="box-widget widget-module">
    <div class="widget-container">
      <div class=" widget-block">
        <div class="control-wrap">

        <table class="table table-bordered data-table tabel-data">
          <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Prioritas </th>
                <th>Prioritas Daerah </th>
                <th>Jumlah/Vol </th>
                <th>Pagu(Rp)</th>
                <th>OPD Penanggung Jawab</th>
                <th>Kode Pembangunan</th>
                <!-- <th>Rincian Skor</th> -->
            </tr>
          </thead>
          <tbody class="table table-bordered">
          <?php
             $no=0;
             $status = ['Belum Punya Status','Terima','Terima Dengan Perubahan','Ditolak'];
    foreach ($data as $value): 
        
        $no++;
    ?>

        <tr>
            <td><?= $no ?></td>
            <td><?= $value->Nm_Permasalahan ?></td>
            <td><?= $value->Jenis_Usulan ?></td>
            <td><?= $value->Jumlah ?></td>
            <td><?= number_format($value->Harga_Total,0,'.','.') ?></td>
            <td><?= ($value->Kd_Sub) ? $value->subUnit->kdSubUnit->Nm_Sub_Unit : '-' ?></td>
            <td><?= $value->Kd_Pem ?></td>
            <!-- <td><?php if($isi = $value->Rincian_Skor) print_r(unserialize($value->Rincian_Skor))  ?></td> -->
        </tr>
    <?php endforeach;
    
?>
          </tbody>
        </table>
      </div>
</div>