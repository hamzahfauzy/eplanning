<?php
/* @var $this yii\web\View */

$this->title = "Chart Akun ASB";
use common\models\RefAsb1;
use common\models\RefAsb2;
use common\models\RefAsb3;
use common\models\RefAsb4;
use common\models\RefAsb5;

?>

<div>
  <div>
      <div>
          <div class="text-center">
              <h2>ANALISA STANDART BELANJA</h2>
              <h3>(ASB)</h3>
          </div>
      </div>
  </div><!-- /.box-header -->
  <div>
    <table cellpadding="5" class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Uraian</th>
                <th>Harga</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:10px;"><?= $data1['Kd_Asb1']; ?></td>
                <td style="font-size:10px;" colspan="3"><?= $data1['Nm_Asb1']; ?></td>
            </tr>
            <?php foreach ($data1Duas as $data1Dua): ?>
                <tr>
                    <td style="font-size:10px;"><?= $data1Dua['Kd_Asb1']; ?> . <?= $data1Dua['Kd_Asb2']; ?></td>
                    <td style="font-size:10px;" colspan="3"><?= $data1Dua['Nm_Asb2']; ?></td>
                </tr>
                <?php
                    $data1Tigas = $data1Dua->refAsb3s;
                    foreach ($data1Tigas as $data1Tiga):
                ?>
                    <tr>
                        <td style="font-size:10px;"><?= $data1Tiga['Kd_Asb1']; ?> . <?= $data1Tiga['Kd_Asb2']; ?> . <?= $data1Tiga['Kd_Asb3']; ?></td>
                        <td style="font-size:10px;" colspan="3"><?= $data1Tiga['Nm_Asb3']; ?></td>
                    </tr>
                    <?php
                        $data1Empats = $data1Tiga->refAsb4s;
                        foreach ($data1Empats as $data1Empat):
                    ?>
                        <tr>
                            <td style="font-size:10px;"><?= $data1Empat['Kd_Asb1']; ?> . <?= $data1Empat['Kd_Asb2']; ?> . <?= $data1Empat['Kd_Asb3']; ?> . <?= $data1Empat['Kd_Asb4']; ?></td>
                            <td style="font-size:10px;" colspan="3"><?= $data1Empat['Nm_Asb4']; ?></td>
                        </tr>
                        <?php
                            $data1Limas = $data1Empat->refAsbs;
                            foreach ($data1Limas as $data1Lima):
                                $dataSatuan = $data1Lima->kdSatuan;
                        ?>
                            <tr>
                                <td style="font-size:10px;"><?= $data1Lima['Kd_Asb1']; ?> . <?= $data1Lima['Kd_Asb2']; ?> . <?= $data1Lima['Kd_Asb3']; ?> . <?= $data1Lima['Kd_Asb4']; ?> . <?= $data1Lima['Kd_Asb5']; ?></td>
                                <td style="font-size:10px;"><?= $data1Lima['Jenis_Pekerjaan']; ?></td>
                            <td style="font-size:10px;text-align:right;"><?= number_format($data1Lima['Harga'],2,',','.'); ?></td>
                                <td style="font-size:10px;"><?= $dataSatuan['Uraian']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
