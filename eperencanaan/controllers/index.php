<?php
use yii\helpers\Html;

$this->title = 'Cetak Usulan Lingkungan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/sistem/musrenbang_report.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="alert alert-info">
    <strong>Silahkan melakukan verifikasi usulan lingkungan, apakah usulan diterima atau ditolak.</strong><br>
        <i>Pastikan semua usulan lingkungan sudah diverifikasi seluruhnnya untuk melakukan kompilasi usulan.</i>          
        </div>


<div class="col-md-12">
  <div class="box-widget widget-module">
    <div class="widget-container">
      <div class=" widget-block">
        <div class="control-wrap">
            <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'search-usulan',
                'action'=>['ta-musrenbang-kelurahan-report/cetak'], 'options' => ['target' => '_blank']])?>
            <div class="form-group">
              <div class="col-sm-2">
                <label class="col-sm-6 control-label">Lingkungan</label>
                <?= $form->field($model, 'lingkungan')->dropDownList($ZUL_lingkungan)->label(false); ?>
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
                <?= Html::submitButton('&nbsp;Cetak&nbsp;',['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>
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
                    Lingkungan
                </th>
                <th>
                    Usulan
                </th>
                <th>
                    Jumlah/vol
                </th>
                <th>
                    Biaya (Rp)
                </th>
                <th>
                    Lokasi
                </th>
                
            </tr>
          </thead>
          <tbody id="body-tabel"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>


