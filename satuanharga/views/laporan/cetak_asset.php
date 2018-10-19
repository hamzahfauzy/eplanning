<?php
/* @var $this yii\web\View */

$this->title = "Chart Akun Aset";
use common\models\RefRekAset1;
use common\models\RefRekAset2;
use common\models\RefRekAset3;
use common\models\RefRekAset4;
use common\models\RefRekAset5;

?>

<div>
  <div>
      <div>
          <div class="text-center">
              <h2>ASET</h2>
          </div>
      </div>
  </div><!-- /.box-header -->
  <div>
    <table cellpadding="5" class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Uraian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-size:10px;"><?= $data1['Kd_Aset1']; ?></td>
                <td style="font-size:10px;" colspan="4"><?= $data1['Nm_Aset1']; ?></td>
            </tr>
            <?php foreach ($data1Duas as $data1Dua): ?>
                <tr>
                    <td style="font-size:10px;"><?= $data1Dua['Kd_Aset1']; ?> . <?= $data1Dua['Kd_Aset2']; ?></td>
                    <td style="font-size:10px;" colspan="4"><?= $data1Dua['Nm_Aset2']; ?></td>
                </tr>
                <?php
                    $data1Tigas = $data1Dua->refRekAset3s;
                    foreach ($data1Tigas as $data1Tiga):
                ?>
                    <tr>
                        <td style="font-size:10px;"><?= $data1Tiga['Kd_Aset1']; ?> . <?= $data1Tiga['Kd_Aset2']; ?> . <?= $data1Tiga['Kd_Aset3']; ?></td>
                        <td style="font-size:10px;" colspan="4"><?= $data1Tiga['Nm_Aset3']; ?></td>
                    </tr>
                    <?php
                        $data1Empats = $data1Tiga->refRekAset4s;
                        foreach ($data1Empats as $data1Empat):
                    ?>
                        <tr>
                            <td style="font-size:10px;"><?= $data1Empat['Kd_Aset1']; ?> . <?= $data1Empat['Kd_Aset2']; ?> . <?= $data1Empat['Kd_Aset3']; ?> . <?= $data1Empat['Kd_Aset4']; ?></td>
                            <td style="font-size:10px;" colspan="4"><?= $data1Empat['Nm_Aset4']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
