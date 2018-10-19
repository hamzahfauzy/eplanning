<?php
$this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '@web/js/sistem/lingkungan_skrip.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="col-md-12">
	<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#usulan" aria-controls="usulan" role="tab" data-toggle="tab">Usulan</a></li>
    <li role="presentation"><a href="#diterima" aria-controls="diterima" role="tab" data-toggle="tab">Diterima</a></li>
    <li role="presentation"><a href="#ditolak" aria-controls="ditolak" role="tab" data-toggle="tab">Ditolak</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="usulan">
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
            </tr>
          </thead>
          <tbody id="body-tabel">
            <?php
              $no=0;
              foreach ($usulan as $key => $value) :
                $no++;
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
                </tr>
              <?php
              endforeach;
            ?>

          </tbody>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane fade " id="diterima">
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
                    Status Penerimaan
                </th>
            </tr>
          </thead>
          <tbody id="body-tabel">
            <?php
              $no=0;
              foreach ($terima as $key => $value) :
                $no++;
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
                $penerimaan = $value->statusPenerimaan->Nm_Status_Penerimaan;
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
                  <td><?= $penerimaan ?></td>
                </tr>
              <?php
              endforeach;
            ?>

          </tbody>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane fade " id="ditolak">
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
            </tr>
          </thead>
          <tbody id="body-tabel">
            <?php
              $no=0;
              foreach ($tolak as $key => $value) :
                $no++;
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
                </tr>
              <?php
              endforeach;
            ?>

          </tbody>
        </table>
    </div>
  </div>

</div>