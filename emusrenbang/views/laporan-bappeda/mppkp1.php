<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Prioritas Pembangunan Daerah";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <?= Html::a('&nbsp;Cetak&nbsp;', ['cetak-mppkp1',
                'urusan' => $subunit->Kd_Urusan,
                'bidang' => $subunit->Kd_Bidang,
                'unit' => $subunit->Kd_Unit,
                'sub' => $subunit->Kd_Sub,
            ], 
                ['class' => 'btn btn-primary', 'target' => '_blank']);
        ?>
    </div>
     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Matriks Prioritas Pembangunan Daerah <br> Tahun Anggaran <?= date('Y') + 1 ?></h3></div><div class="col-md-1"></div>
        <div class="col-xs-12"><strong>Urusan &ensp;: </strong><?= @$subunit->urusan->Nm_Urusan ?></div>
        <div class="col-xs-12"><strong>OPD&ensp;&ensp;&ensp;: </strong><?= @$subunit->Nm_Sub_Unit ?></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">No </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Prioritas Pembangunan Daerah </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Sasaran </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">OPD yang Melaksanakan </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Program </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Pagu Indikatif (Rp)</th>
                    </tr>
                    <tr></tr>

                    <tr>
                    <?php for($i=1;$i<=6;$i++): ?>
                        <td style="text-align:center;vertical-align:middle;">(<?= $i ?>)</td>
                    <?php endfor; ?>
                    </tr>
                </thead>
				<tbody>
                    <?php 
					$no = 1;
					
                        foreach ($data1 as $key1 => $value1):
						$iterasi=0;
						$jumlah = count($data3[$key1]);
                    ?>
                        <tr>
                            <td rowspan="<?=$jumlah;?>"style="text-align:center;"><?= $no++ ?></td>
                            <td rowspan="<?=$jumlah;?>"><?= $value1 ?></td>
                            <td rowspan="<?=$jumlah;?>"><?= $data2[$key1] ?></td>
                            <td rowspan="<?=$jumlah;?>"><?php print_r($data4[$key1][0]) ?></td>
                            <?php 
							foreach ($data3[$key1] as $key2 => $value2): ?>
							<td><?= $value2 ?></td>
							<td style="text-align:right;">
								<?=number_format($data5[$key1][$key2]);?>
							</td>
							</tr>
							<?php if($iterasi<$jumlah-1){ ?>
							<tr> 
							<?php } $iterasi++; ?>
                            <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
