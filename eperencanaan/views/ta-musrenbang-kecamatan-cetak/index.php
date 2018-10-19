<?php

use yii\helpers\Html;

$this->registerJsFile(
        '@web/js/musrenbang/laporan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Hasil Skoring pada usulan Kelurahan & Lingkungan.';
$this->params['subtitle'] = 'Hasil Skoring';

$this->params['breadcrumbs'][] = ['label' => 'Laporan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- <div class="alert alert-info">
    <strong>Silahkan melakukan Skoring pada usulan Kelurahan.</strong><br>
    <i>Pastikan semua usulan Kelurahan sudah diskoring untuk menentukan prioritas.</i>          
</div> -->

<div class="col-md-12">
    <div class="row">
        <form id="form_cetak" method="post">
            <div class="col-md-2">
                <div class="form-group">
                    <label >Kelurahan</label>
                    <select class="form-control" name="Kd_Kel" id="kelurahan2">
                        <option value="">-Pilih Kelurahan-</option>
                        <?php
                        foreach ($kelurahan as $kel):
                            ?>
                            <option value="<?= $kel->Kd_Urut ?>"><?= $kel->Nm_Kel ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label >Lingkungan</label>
                    <select class="form-control" name="Kd_Lingkungan" id="lingkungan2">
                        <option value="">-Pilih Lingkungan-</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label >Bidang Pembangunan</label>
                    <select class="form-control" name="Kd_Prioritas_Pembangunan_Daerah">
                        <option value="">-Pilih Bidang-</option>
                        <?php
                        foreach ($bid_pem as $pem):
                            ?>
                            <option value="<?= $pem->Kd_Pem ?>"><?= $pem->Bidang_Pembangunan ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label >Prioritas Pembangunan</label>
                    <select class="form-control" name="Kd_Pem">
                        <option value="">-Pilih Prioritas -</option>
                        <?php
                        foreach ($rpjmd as $prioritas):
                            ?>
                            <option value="<?= $prioritas->Kd_Prioritas_Pembangunan_Kota ?>"><?= $prioritas->Nm_Prioritas_Pembangunan_Kota ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
        </form>

        <div class="col-md-1">
            <div class="form-group">
                <label >&nbsp;</label>
                <button type="button" class="form-control btn btn-primary" id="btn_cari">Lihat</button>
            </div>
        </div>
        <?php
            $form = \yii\bootstrap\ActiveForm::begin(['id' => 'search-usulan',
                        'action' => ['ta-musrenbang-kecamatan-cetak/cetak'], 'options' => ['target' => '_blank']])
            ?>
        <div class="col-md-1">
            <div class="form-group">
                <label >&nbsp;</label>
                <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'form-control btn btn-primary']); ?>
            </div>
        </div>
        <?php \yii\bootstrap\ActiveForm::end() ?>
                    
    </div>
</div>

<div class="col-md-12">
  <div class="box-widget widget-module">
    <div class="widget-container">
      <div class=" widget-block">
        <div class="control-wrap">

        <table class="table table-bordered data-table tabel-data">
          <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Prioritas </th>
                <th>Prioritas Kota </th>
                <th>Kelurahan </th>
                <th>Lingkungan </th>
                <th>Jalan </th>
                <th>Jumlah/Vol </th>
                <th>Pagu(Rp)</th>
                <th>SKPD Penanggung Jawab</th>
                <th>Status Penerimaan Kelurahan & Alasan</th>
                <th>Status Penerimaan Kecamatan & Alasan</th>
                <th>Skor</th>
                <th>Kd_Pem</th>
                <!-- <th>Rincian Skor</th> -->
            </tr>
          </thead>
          <tbody id="isi-cetak">
             
          </tbody>
        </table>
      </div>
</div>