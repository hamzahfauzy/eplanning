<?php
/* @var $this yii\web\View */

$this->title = "Chart Akun HSPK";
use common\models\RefHspk1;
use common\models\RefHspk2;
use common\models\RefHspk3;
use common\models\RefHspk;

?>

<div>
  <div>
      <div>
          <div class="text-center">
              <h2>HARGA SATUAN POKOK KEGIATAN</h2>
              <h3>(HSPK)</h3>
          </div>
      </div>
  </div><!-- /.box-header -->
  <div>
    <table cellpadding="5" class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Uraian</th>
                <th>Harga Satuan</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:10px;"><?= $data1['Kd_Hspk1']; ?></td>
                <td style="font-size:10px;" colspan="3"><?= $data1['Nm_Hspk1']; ?></td>
            </tr>
            <?php foreach ($data1Duas as $data1Dua): ?>
                <tr>
                    <td style="font-size:10px;"><?= $data1Dua['Kd_Hspk1']; ?> . <?= $data1Dua['Kd_Hspk2']; ?></td>
                    <td style="font-size:10px;" colspan="3"><?= $data1Dua['Nm_Hspk2']; ?></td>
                </tr>
                <?php
                    $data1Tigas = $data1Dua->refHspk3s;
                    foreach ($data1Tigas as $data1Tiga):
                ?>
                    <tr>
                        <td style="font-size:10px;"><?= $data1Tiga['Kd_Hspk1']; ?> . <?= $data1Tiga['Kd_Hspk2']; ?> . <?= $data1Tiga['Kd_Hspk3']; ?></td>
                        <td style="font-size:10px;" colspan="3"><?= $data1Tiga['Nm_Hspk3']; ?></td>
                    </tr>
                    <?php
                        $data1Empats = $data1Tiga->refHspks;
                        foreach ($data1Empats as $data1Empat):
                            $dataSatuan = $data1Empat->kdSatuan;
                    ?>
                        <tr>
                            <td style="font-size:10px;"><?= $data1Empat['Kd_Hspk1']; ?> . <?= $data1Empat['Kd_Hspk2']; ?> . <?= $data1Empat['Kd_Hspk3']; ?> . <?= $data1Empat['Kd_Hspk4']; ?></td>
                            <td style="font-size:10px;"><?= $data1Empat['Uraian_Kegiatan']; ?></td>
                            <td style="font-size:10px;text-align:right;"><?= number_format($data1Empat['Harga'],2,',','.'); ?></td>
                            <td style="font-size:10px;"><?= $dataSatuan['Uraian']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
