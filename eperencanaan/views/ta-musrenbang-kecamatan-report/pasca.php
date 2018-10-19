<?php
use yii\helpers\Html;

$this->title = 'Cetak Usulan Kecamatan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
        '@web/js/sistem/musrenbangkecpaska.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<!-- <div class="alert alert-info">
    <strong>Silahkan melakukan verifikasi usulan lingkungan, apakah usulan diterima atau ditolak.</strong><br>
        <i>Pastikan semua usulan lingkungan sudah diverifikasi seluruhnnya untuk melakukan kompilasi usulan.</i>          
        </div> -->


<div class="col-md-12">
    <div class="box-widget widget-module">
        <div class="widget-container">
            <div class=" widget-block">
                <div class="control-wrap">
                    <?php
                    $form = \yii\bootstrap\ActiveForm::begin(['id' => 'search-usulan',
                                'action' => ['ta-musrenbang-kecamatan-report/cetak'], 'options' => ['target' => '_blank']])
                    ?>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="col-sm-6 control-label">Kelurahan</label>
                            <?= $form->field($model, 'kelurahan')->dropDownList($NASKelurahan)->label(false); ?>
                        </div>
                        <div class="col-sm-4">
                            <label class="col-sm-6 control-label">Bidang Pembangungan</label>
                            <?= $form->field($model, 'bid_pem')->dropDownList($ZUL_bid_pem)->label(false); ?>
                        </div>

                        <div class="col-sm-2">

                    <br><br>
                <?= Html::button('&nbsp;Cari&nbsp;',['id' => 'cari-button-pasca', 'class' => 'btn btn-primary btn-lg']); ?>
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
                                Kegiatan Prioritas
                            </th>

                            <th>
                                Prioritas Kota
                            </th>

                            <th>
                                Kelurahan
                            </th>

                            <th>
                                Lingkungan
                            </th>

                            <th>
                                Jalan
                            </th>

                            <th>
                                Jumlah/vol
                            </th>
                            <!-- <th>
                                Biaya (Rp)
                            </th> -->

                            <th>
                                Pagu (Rp)
                            </th>

                            <th>
                                SKPD Penanggung Jawab
                            </th>

                            <th>
                                Status Penerimaan
                            </th>

                            <th>

                                Alasan
                            </th>



                        </tr>
                    </thead>
                    <tbody id="body-tabel"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>


