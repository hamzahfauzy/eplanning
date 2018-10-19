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
        '@web/js/sistem/rekapitulasi-usulan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/css/sistem/lingkungan_style.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/lingkungan_skrip.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);



//maps.googleapis.com/maps/api/js?key=AIzaSyBnUKCKkjBBz0BGHF0PPlmBdSxKAhP93qc&callback=initMap

$this->title = 'Rekapitulasi Usulan';
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
<div class="row">
    <div class="col-md-12">
        <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                    <div class="data_rekap">
                        <div class="control-wrap">
<?= Html::a('Cetak Usulan', ['lingkungan/cetak-usulan'], ['class' => 'btn btn-primary ', 'target' => '_blank']) ?>
                        </div>

                            <?php
                            $pesan = '<h4><span class="label label-warning">*. Lengkapi dan verifikasi data usulan dengan melakukan koreksi, melengkapi dokumen dan menentukan koordinat untuk memperkuat usulan dusun/lingkungan </span></h4>';

                            if ($acara->Waktu_Selesai != 0) {

                                echo $pesan;
                            } else {

                                '';
                            }
                            ?>


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
                                            Jumlah/vol
                                        </th>
                                        <th>
                                            Biaya (Rp)
                                        </th>
                                        <th>
                                            Lokasi
                                        </th>
                                        <th>
                                            Tanggal
                                        </th>
                                        <th>
                                            Aksi
                                        </th>
                                        <th>
                                            Status Survey
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
                                            Jumlah/Vol
                                        </th>
                                        <th>
                                            Biaya (Rp)
                                        </th>
                                        <th>
                                            Lokasi
                                        </th>

                                        <th>
                                            Tanggal
                                        </th>
                                        <th>
                                            Aksi
                                        </th>
                                        <th>
                                            Status Survey
                                        </th>
                                    </tr>
                                </tfoot>
                                <tbody>
<?php
$no = 1;
if ($data == null) {
    echo '<tr><td colspan="8" style="text-align: center;"><i><h2>NIHIL</h2></i></td></tr>';
} else {
    foreach ($data as $key => $value) {
        $ubah = Html::a('Ubah', ['lingkungan/ubah',
                    'Kd_Ta_Forum_Lingkungan' => $value['Kd_Ta_Forum_Lingkungan']
                        ], [
                    'class' => 'btn btn-default btn-sm m-user-edit',
        ]);

        $hapus = Html::a('Hapus', ['lingkungan/hapus',
                    'Kd_Ta_Forum_Lingkungan' => $value['Kd_Ta_Forum_Lingkungan']
                        ], [
                    'class' => 'btn btn-default btn-sm m-user-delete',
                    'data' => [
                        'confirm' => 'Anda yakin ingin menghapus usulan?',
                        'method' => 'post',
                    ],
        ]);

        $survey_stat = '';
        $koreksi = '';
        $dokumen = '';
        $koordinat = '';
        $kode_usulan = $value['Kd_Ta_Forum_Lingkungan'];
        $lihatriwayat = '';
        $lihatdokumen = '';
        $btn_survey = '';

        if ($acara->Waktu_Selesai != 0) {
            $ubah = '';
            $hapus = '';



            $survey_stat = $value["Status_Survey"];
            if ($survey_stat == 4) {
                $btn_survey = '
                              <button class="btn btn-success" >Sudah<br/>Survey</button>
                          '
                ;
            } else {
                $btn_survey = '
                              <button id="btn_' . $kode_usulan . '" data-kd="' . $kode_usulan . '" class="btn btn-danger btn_ubah" data-toggle="modal" data-target="#modal_cek_cokumen" title="Klik untuk merubah status">Belum<br/>Survey</button>
                          ';
            }

            /*
              $checked_belum = '';
              $checked_sudah = '';

              if ($survey_stat == 4) {
              $checked_sudah = 'selected';
              }
              else {
              $checked_belum = 'selected';
              }

              $stat_survey = '<select class="form-control survey-btn" data-kd="'.$value['Kd_Ta_Forum_Lingkungan'].'">
              <option value="5" '.$checked_belum.'>Belum</option>
              <option value="4" '.$checked_sudah.'>Sudah</option>
              </select>';
             */
            $koreksi = Html::a('Koreksi', ['lingkungan/koreksi',
                        'Kd_Ta_Forum_Lingkungan' => $value['Kd_Ta_Forum_Lingkungan']
                            ], [
                        'class' => 'btn btn-primary',
            ]);
            ;
            $dokumen = Html::button('Dokumen', ['class' => 'btn btn-primary', 'id' => 'btn-dokumen', 'data-toggle' => 'modal', 'data-target' => '#modal_dokumen',
                        'onclick' => 'ZULsendiri(' . $value["Kd_Ta_Forum_Lingkungan"] . ')']);


            $koordinat = '<button class="btn btn-primary kordinat-btn" data-kd="' . $value['Kd_Ta_Forum_Lingkungan'] . '" data-lat="' . $value['Latitute'] . '" data-lng="' . $value['Longitude'] . '">Koordinat</button>';

            //$riwayat = '<button class="btn btn-success ">Riwayat</button>';

            $lihatriwayat = '<button class="btn btn-success btn_lihat_riwayat" data-kode2="' . $value['Kd_Ta_Forum_Lingkungan'] . '">Riwayat</button>';

            $lihatdokumen = '<button class="btn btn-success btn_lihat_dokumen" data-kode="' . $value['Kd_Ta_Forum_Lingkungan'] . '">Lihat Dokumen</button>';
        }

        $status_survey = $value['Status_Survey'];
        if ($status_survey == 4) {
            $koreksi = '';
            $dokumen = '';
            $koordinat = '';
            //$lihatriwayat='';
        }

        echo '
                        <tr>
                          <td>
                            ' . $no . '
                          </td>
                          <td>
                              ' . $value["Jenis_Usulan"] . '
                              <br><br>
                              <strong>Permasalahan</strong>
                              <br>
                              ' . $value["Nm_Permasalahan"] . '
                              <br>
                              (' . $value->kdPem->Bidang_Pembangunan . ')
                             </td>
                          <td>
                              ' . $value["Jumlah"] . '
                              ' . $value->kdSatuan->Uraian . '
                          </td>
                          <td class="uang">
                              ' . $value["Harga_Total"] . '
                          </td>
                          <td>
                              ' . $value->kdJalan->Nm_Jalan . '<br/>
                              Lat: ' . $value["Latitute"] . ' <br/>
                              Long: ' . $value["Longitude"] . '
                          </td>
                          <td>
                              ' . Yii::$app->formatter->asDateTime($value["Tanggal"], 'dd MM yyyy, H:i:s') . '
                              WIB
                           
                          </td>
                            <td class="tc-center">
                              <div class="btn-toolbar" role="toolbar">
                                  <div class="btn-group" role="group">
                                      ' . $ubah . '
                                      ' . $hapus . '
                                      <span id="span_' . $kode_usulan . '">
                                      ' . $koreksi . '
                                      ' . $dokumen . '
                                      ' . $koordinat . '
                                      </span>
                                      <br>
                                      ' . $lihatriwayat . '
                                      ' . $lihatdokumen . '
                                  </div>
                            </td>
                            <td>
                              ' . $btn_survey . '
                            
                            </td>

                          </tr>
                          ';
        $no++;
    }
}
?>

                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                                    <?php if ($acara->Waktu_Selesai == 0) : ?>
                    <!-- lingkungan/selesai -->
                                        <?= Html::a('Kirim ke Kelurahan', ['#'], ['class' => 'btn btn-success btn-lg', 'data-toggle' => 'modal', 'data-target' => '#modal_kirim_usulan']) ?>        
<?php else : ?>

<?php endif; ?>
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
<?= Html::a('Kirim', ['lingkungan/selesai'], ['class' => 'btn btn-success']) ?>
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
<?php
echo $form->field($model, 'imageFile[]')->widget(FileInput::className(), ['options' => [
        'multiple' => true], 'pluginOptions' => ['maxFileCount' => 50]])
?>
                    </div>
                    <div class="form-group">
<?php
echo $form->field($model, 'videoFile[]')->widget(FileInput::className(), ['options' => [
        'multiple' => true], 'pluginOptions' => ['maxFileCount' => 5]])
?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->field($model, 'id')->hiddenInput(['id' => 'id'])->label(false) ?>
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


<!-- modal musrenbang kelurahan -->
<div class="modal fade" id="modal_koordinat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
<?php
$form = ActiveForm::begin([
            'method' => 'post',
            'action' => ['lingkungan/kordinat'],
        ])
?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Koordinat</h4>
            </div>
            <div class="modal-body">
                <div id="peta" style="height:300px; width: 550px" class="col-md-12"></div>
                <input type="hidden" name="kd_usulan" id="kd_usulan_input">
                <div class="form-group">
                    <label >Latitude</label>
                    <input type="text" name="lat" id="lat" class="form-control" placeholder="Latitude">
                </div>
                <div class="form-group">
                    <label >Longitude</label>
                    <input type="text" name="long" id="lng" class="form-control" placeholder="Longitude">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Tutup</button>
<?= Html::submitButton('Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
<?php ActiveForm::end(); ?>
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