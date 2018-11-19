<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use eperencanaan\assets\MapAsset;

$request = Yii::$app->request;
MapAsset::register($this);


/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->registerJsFile(
        '@web/js/sistem/jquery.number.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/rekapitulasi.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/css/sistem/lingkungan_style.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/lingkungan_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/map_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

//maps.googleapis.com/maps/api/js?key=AIzaSyBnUKCKkjBBz0BGHF0PPlmBdSxKAhP93qc&callback=initMap

$this->title = 'Usulkan ke Kecamatan';
$this->params['subtitle'] = 'Usulan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['tambah']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
if ($request->get('pesan') == 'berhasil') {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Berhasil!</strong> Ubah Data Berhasil
    </div>
    <?php
}
if ($request->get('pesan') == 'gagal') {
    ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Gagal!</strong> Gagal
    </div>
    <?php
}
?>

<div class="alert alert-danger">
          
        </div>
<div class="row">
    <div class="col-md-12">
        <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                    <div class="data_rekap">
                        <div class="control-wrap">
                          <?= Html::a('Cetak Usulan', ['ta-musrenbang-kelurahan/cetak-usulan'], ['class' => 'btn btn-primary ', 'target' => '_blank', 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Silahkan klik untuk mencetak usulan']) ?>
                        </div>
                        <div class="table-data-wrap">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Usulan
                                        </th>
                                        <th>
                                            Usulan Lingkungan
                                        </th>
                                        <th>
                                            Jumlah/vol
                                        </th>
                                        <th>
                                            Biaya (Rp)
                                        </th>
                                        <th>
                                            Tanggal
                                        </th>
                                        <th>
                                            Aksi
                                        </th>
                                        <th>
                                            Pilihan
                                        </th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Usulan
                                        </th>
                                        <th>
                                            Usulan Lingkungan
                                        </th>
                                        <th>
                                            Jumlah/Vol
                                        </th>
                                        <th>
                                            Biaya (Rp)
                                        </th>
                                        <th>
                                            Tanggal
                                        </th>
                                        <th>
                                            Aksi
                                        </th>
                                        
                                        <th>
                                            Pilihan
                                        </th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div> 
                                  
            </div>
        </div>
    </div>
</div>


<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_kirim_usulan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Peringatan</h4>
            </div>
            <div class="modal-body">
                <h2>Apakah anda yakin ingin mengirim usulan?</h2>
                *) Apabila Usulan telah dikirim, anda tidak dapat melakukan perubahan lagi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
<?= Html::a('Kirim', ['ta-musrenbang-kelurahan/selesai'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
<!-- /.modal form -->


<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_dokumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Dokumen</h4>
            </div>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="modal-body">
                <form>
                    <div class="form-group">

                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                       
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
<?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<!-- /.modal form -->



<!--
<script src="https:" async defer></script>
-->

<!-- Modal -->
<div class="modal fade" id="modal_cek_cokumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Status Survey</h4>
            </div>
            <div class="modal-body">
                <h3>Status Kelengkapan data</h3>
                <table>
                    <tr>
                        <td width="100">Foto</td>
                        <td>:</td>
                        <td id="stat_foto"></td>
                    </tr>
                    <tr>
                        <td>Video</td>
                        <td>:</td>
                        <td id="stat_video"></td>
                    </tr>
                </table>
                <h4 id="pesan_survey"></h4>
                <h5>*) INGAT! Kelengkapan data sangat mempengaruhi kekuatan usulan</h5>
                <input type="hidden" id="kode_usulan" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" id='survey_selesai'>Survey Selesai</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_lihat_dokumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>

<div class="modal fade" id="modal_lihat_riwayat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div> 