<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\yii\helpers\Url;
use yii\kartik\export\ExportMenu;

$this->title = 'Cetak Usulan Lingkungan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/sistem/kecamatancetakkel.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="alert alert-info">
    <strong>Silahkan melakukan Skoring pada usulan Kelurahan.</strong><br>
        <i>Pastikan semua usulan Kelurahan sudah diskoring untuk menentukan prioritas.</i>          
        </div>


<div class="col-md-12">
  <div class="box-widget widget-module">
    <div class="widget-container">
      <div class=" widget-block">
        <div class="control-wrap">
            <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'search-usulan',
                'action'=>['ta-musrenbang-kecamatan-report/cetak'], 'options' => ['target' => '_blank']])?>
            <div class="form-group">
              <div class="col-sm-2">
                <label class="col-sm-6 control-label">Kelurahan</label>
                <?= $form->field($model, 'kelurahan')->dropDownList($NASKelurahan)->label(false); ?>
              </div>
              <div class="col-sm-4">
                <label class="col-sm-6 control-label">Bidang Pembangungan</label>
                <?= $form->field($model, 'bid_pem')->dropDownList($ZUL_bid_pem)->label(false); ?>
              </div>
                <div class="col-sm-4">
                <label class="col-sm-6 control-label">Kata Kunci</label>
                <?= $form->field($model, 'kata_kunci')->textInput(['id' => 'kata-kunci'])->label(false); ?>
                
              </div>
                <div class="col-sm-2">
                
                <br>
                <?= Html::button('&nbsp;Cari&nbsp;',['id' => 'cari-button', 'class' => 'btn btn-primary btn-lg']); ?>
                <?= Html::submitButton('&nbsp;Unduh&nbsp;',['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>

              </div>
            </div>
            <?php  \yii\bootstrap\ActiveForm::end() ?>
        </div>
        <table class="table table-bordered data-table tabel-data">
          <thead>
            <tr>
                <th>
                    No
                </th>

                <th>
                    Kegiatan Prioritas
                </th>

                <th>
                    Kriteria 1
                </th>

                <th>
                    Kriteria 2
                </th>

                <th>
                    Kegiatan 3
                </th>

                <th>
                    Kegiatan 4
                </th>

                <th>
                    Kegiatan 5
                </th>

                <th>
                    Kegiatan 6
                </th>
                <th>
                    Kegiatan 7
                </th>

                <th>
                   Kegiatan 8
                </th>

                <th>
                    Total SKOR
                </th>


               
            </tr>
          </thead>
          <tbody id="body-tabel"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>


