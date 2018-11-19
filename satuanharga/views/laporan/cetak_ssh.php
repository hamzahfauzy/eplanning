<?php
/* @var $this yii\web\View */

$this->title = "Chart Akun SSH";
use common\models\RefSsh1;
use common\models\RefSsh2;
use common\models\RefSsh3;
use common\models\RefSsh4;
use common\models\RefSsh5;
use common\models\RefSsh;

?>

<div>
  <div>
      <div>
          <div class="text-center">
              <h2>DAFTAR STANDAR SATUAN HARGA</h2>
              <h3>(SSH)</h3>
          </div>
      </div>
  </div><!-- /.box-header -->
  <div>
    <table cellpadding="5" class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Uraian</th>
                <th>Spesifikasi</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:10px;"><?= $data1['Kd_Ssh1']; ?></td>
                <td style="font-size:10px;" colspan="4"><?= $data1['Nm_Ssh1']; ?></td>
            </tr>
            <?php foreach ($data1Duas as $data1Dua): ?>
                <tr>
                    <td style="font-size:10px;"><?= $data1Dua['Kd_Ssh1']; ?> . <?= $data1Dua['Kd_Ssh2']; ?></td>
                    <td style="font-size:10px;" colspan="4"><?= $data1Dua['Nm_Ssh2']; ?></td>
                </tr>
                <?php
                    $data1Tigas = $data1Dua->refSsh3s;
                    foreach ($data1Tigas as $data1Tiga):
                ?>
                    <tr>
                        <td style="font-size:10px;"><?= $data1Tiga['Kd_Ssh1']; ?> . <?= $data1Tiga['Kd_Ssh2']; ?> . <?= $data1Tiga['Kd_Ssh3']; ?></td>
                        <td style="font-size:10px;" colspan="4"><?= $data1Tiga['Nm_Ssh3']; ?></td>
                    </tr>
                    <?php
                        $data1Empats = $data1Tiga->refSsh4s;
                        foreach ($data1Empats as $data1Empat):
                    ?>
                        <tr>
                            <td style="font-size:10px;"><?= $data1Empat['Kd_Ssh1']; ?> . <?= $data1Empat['Kd_Ssh2']; ?> . <?= $data1Empat['Kd_Ssh3']; ?> . <?= $data1Empat['Kd_Ssh4']; ?></td>
                            <td style="font-size:10px;" colspan="4"><?= $data1Empat['Nm_Ssh4']; ?></td>
                        </tr>
                        <?php
                            $data1Limas = $data1Empat->refSsh5s;
                            foreach ($data1Limas as $data1Lima):
                        ?>
                            <tr>
                                <td style="font-size:10px;"><?= $data1Lima['Kd_Ssh1']; ?> . <?= $data1Lima['Kd_Ssh2']; ?> . <?= $data1Lima['Kd_Ssh3']; ?> . <?= $data1Lima['Kd_Ssh4']; ?> . <?= $data1Lima['Kd_Ssh5']; ?></td>
                                <td style="font-size:10px;" colspan="4"><?= $data1Lima['Nm_Ssh5']; ?></td>
                            </tr>
                            <?php
                                $data1Enams = $data1Lima->refSshes;
                                foreach ($data1Enams as $data1Enam):
                                    $dataSatuan = $data1Enam->kdSatuan;
                            ?>
                                <tr>
                                    <td style="font-size:10px;"><?= $data1Enam['Kd_Ssh1']; ?> . <?= $data1Enam['Kd_Ssh2']; ?> . <?= $data1Enam['Kd_Ssh3']; ?> . <?= $data1Enam['Kd_Ssh4']; ?> . <?= $data1Enam['Kd_Ssh5']; ?> . <?= $data1Enam['Kd_Ssh6']; ?></td>
                                    <td style="font-size:10px;"><?= $data1Enam['Nama_Barang']; ?></td>
                                    <td style="font-size:10px;">&nbsp;</td>
                                    <td style="font-size:10px;"><?= $dataSatuan['Uraian']; ?></td>
                                    <td style="font-size:10px;text-align:right;"><?= number_format($data1Enam['Harga_Satuan'],2,',','.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
