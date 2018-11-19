<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$request = Yii::$app->request;

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
    '@web/css/sistem/lingkungan_style.css',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Rekapitulasi Usulan';
$this->params['subtitle'] = 'Usulan';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['tambah']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?php 
    if ($request->get('pesan')== 'berhasil') {
    ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Berhasil!</strong> Ubah Data Berhasil
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
              <?= Html::a('Cetak Usulan',['lingkungan/cetak-usulan'],['class'=>'btn btn-primary ']) ?>
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
                       
                         
                        <th class="tc-center">
                            Aksi
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
                            Biaya
                        </th>
                        <th>
                            Lokasi
                        </th>
                        
                        <th>
                            Tanggal
                        </th>
                        <th class="tc-center">
                            Aksi
                        </th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    $no=1;
                    foreach ($data as $key => $value) {
                      $ubah = Html::a('Ubah', ['lingkungan/ubah', 
                                                'Kd_Ta_Forum_Lingkungan' => $value['Kd_Ta_Forum_Lingkungan']
                                                ],[
                                                    'class' => 'btn btn-default btn-sm m-user-edit',
                                                  ]);

                      $hapus = Html::a('Hapus', ['lingkungan/hapus', 
                                                'Kd_Ta_Forum_Lingkungan' => $value['Kd_Ta_Forum_Lingkungan']
                                                ],[
                                                    'class' => 'btn btn-default btn-sm m-user-delete',
                                                    'data' => [
                                                                  'confirm' => 'Anda yakin ingin menghapus usulan?',
                                                                  'method' => 'post',
                                                              ],
                                                  ]);

                      if ($acara->Waktu_Selesai != 0){
                        $ubah = '';
                        $hapus = '';
                      }
                      
                      echo '
                        <tr>
                          <td>
                            '.$no.'
                          </td>
                          <td>
                              '.$value["Jenis_Usulan"].'
                              <br><br>
                              <strong>Permasalahan</strong>
                              <br>
                              '.$value["Nm_Permasalahan"].'
                             </td>
                          <td>
                              '.$value["Jumlah"].'
                              '.$value->kdSatuan->Uraian .'
                          </td>
                          <td class="uang">
                              '.$value["Harga_Total"].'
                          </td>
                          <td>
                              '.$value->kdJalan->Nm_Jalan .'
                          </td>
                          <td>
                              '. Yii::$app->formatter->asDateTime($value["Tanggal"]).'
                          </td>
                         
                           <td class="tc-center">
                              <div class="btn-toolbar" role="toolbar">
                                  <div class="btn-group" role="group">
                                      '.$ubah.'
                                      '.$hapus.'
                                  </div>
                              </td>
                          </tr>
                          ';
                          $no++;
                        }
                      ?>

                  </tbody>
                </table>
            </div> 
          </div>
        </div>
        <?php if ($acara->Waktu_Selesai == 0) : ?>
            <!-- lingkungan/selesai -->
            <?= Html::a('Kirim ke Kelurahan',['#'],['class'=>'btn btn-success btn-lg', 'data-toggle' => 'modal', 'data-target' => '#modal_kirim_usulan'])?>        
        <?php else : ?>
            <?= Html::a('Kirim ke Kelurahan',[''],['class'=>'btn btn-success btn-lg', 'disabled' => 'disabled'])?>
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
                <?= Html::a('Kirim',['lingkungan/selesai'],['class'=>'btn btn-success'])?>
            </div>
        </div>
    </div>
</div>
<!-- /.modal form -->