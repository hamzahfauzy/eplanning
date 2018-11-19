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

$this->title = 'Usulan Masuk';
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
            <div class="control-wrap">
              <?= Html::a('Cetak Usulan',[''],['class'=>'btn btn-primary ']) ?>
            </div>
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
                        Status Penerimaan
                    </th>
                    <th>
                        Status Survey
                    </th>
                    <th>
                        Data
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
              </thead>
              <tbody>
              <?php
                $no=1;
                foreach ($data as $key => $value) {
                  $koreksi = Html::a('Koreksi', ['kelurahan/ubah', 
                                            'Kd_Ta_Forum_Lingkungan' => $value['Kd_Ta_Forum_Lingkungan']
                                            ],[
                                                'class' => 'btn btn-primary btn-sm',
                                              ]);

                  $dokumen = Html::a('Dokumen', ['kelurahan/', 
                                            'Kd_Ta_Forum_Lingkungan' => $value['Kd_Ta_Forum_Lingkungan']
                                            ],[
                                                'class' => 'btn btn-primary btn-sm',
                                              ]);

                  $pakai = Html::a('Pakai', ['kelurahan/', 
                                            'Kd_Ta_Forum_Lingkungan' => $value['Kd_Ta_Forum_Lingkungan']
                                            ],[
                                                'class' => 'btn btn-primary btn-sm',
                                                'title' => 'Pakai Usulan'
                                              ]);
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
                      <td>
                          '.$value["status"] .'
                      </td>
                      <td>

                      </td>
                      <td>
                          <div class="btn-toolbar" role="toolbar">
                              <div class="btn-group" role="group">
                                  '.$koreksi.'
                                  '.$dokumen.'
                              </div>
                          </td>
                          <td>
                              <div class="btn-toolbar" role="toolbar">
                                  <div class="btn-group" role="group">
                                      '.$pakai.'
                                  </div>
                              </td>
                          </tr>
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
  </div>
</div>
