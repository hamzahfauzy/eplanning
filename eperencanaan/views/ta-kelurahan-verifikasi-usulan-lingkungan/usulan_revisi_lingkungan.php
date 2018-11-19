<?php
use yii\helpers\Html;

$this->registerJsFile(
        '@web/js/sistem/jquery.number.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
        '@web/js/sistem/usulan-revisi.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Usulan Revisi';

//$this->params['breadcrumbs'][] ='';
$this->params['breadcrumbs'][] = ['label' => 'Usulan', 'url' => ['#']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
  <div class="box-widget widget-module">
    <div class="widget-container">
      <div class=" widget-block">
        <table class="table table-bordered data-table tabel-data">
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
                    Status Survey
                </th>
                <th>
                    Keterangan
                </th>
                <th>
                    Penerimaan
                </th>
            </tr>
          </thead>
          <tbody id="body-tabel">
            <?php
              $no=0;
              foreach ($data as $key => $value) :
                $no++;
                $Kd_Ta_Musrenbang_Kelurahan_Verifikasi = $value["Kd_Ta_Musrenbang_Kelurahan_Verifikasi"];
                $jenis_usulan = $value["Jenis_Usulan"];
                $permasalahan = $value["Nm_Permasalahan"];
                $bidang_pembangunan = $value->kdPem->Bidang_Pembangunan;
                $jumlah = $value["Jumlah"];
                $satuan = $value->kdSatuan->Uraian;
                $harga_total = $value["Harga_Total"];
                $jalan = $value->kdJalan->Nm_Jalan;
                $lat = $value["Latitute"];
                $lon = $value["Longitude"];
                $status = $value->statusSurvey->Nm_Status;
                $keterangan = $value["Keterangan"];

                $ubah = Html::a('Ubah', ['ta-kelurahan-verifikasi-usulan-lingkungan/revisi',
                    'Kd_Ta_Musrenbang_Kelurahan_Verifikasi' => $value['Kd_Ta_Musrenbang_Kelurahan_Verifikasi']
                        ], [
                    'class' => 'btn btn-primary',
                ]);
              ?>
                <tr>
                  <td><?= $no ?></td>
                  <td>
                    <b>Permasalahan:</b><br/>
                    <p><?= $permasalahan ?></p>
                    <b>Usulan:</b>
                    <p><?= $jenis_usulan ?></p>
                    (<?= $bidang_pembangunan ?>)
                  </td>
                  <td><?= $jumlah.' '.$satuan ?></td>
                  <td class="uang"><?= $harga_total ?></td>
                  <td>
                    <?= $jalan ?> <br/>
                    Lat: <?= $lat ?><br/>
                    Long: <?= $lon ?>
                  </td>
                  <td><?= $status ?></td>
                  <td class="text-center">
                    <?= $keterangan ?>
                  </td>
                  <td class="text-center">
                    <?= $ubah ?>
                  </td>
                </tr>
              <?php
              endforeach;
            ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
