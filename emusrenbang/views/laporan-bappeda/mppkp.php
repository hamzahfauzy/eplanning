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
        <?= Html::a('&nbsp;Cetak&nbsp;', ['cetak-mppkp',
                'urusan' => $subunit->Kd_Urusan,
                'bidang' => $subunit->Kd_Bidang,
                'unit' => $subunit->Kd_Unit,
                'sub' => $subunit->Kd_Sub,
            ], 
                ['class' => 'btn btn-primary', 'target' => '_blank']);
        ?>
    </div>
     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Matriks Prioritas Pembangunan Daerah <br>Perubahan Tahun Anggaran <?= date('Y') + 1 ?></h3></div><div class="col-md-1"></div>
        <div class="col-xs-12"><strong>Urusan &ensp;: </strong><?= $subunit->urusan->Nm_Urusan ?></div>
        <div class="col-xs-12"><strong>Perangkat Daerah&ensp;&ensp;&ensp;: </strong><?= $subunit->Nm_Sub_Unit ?></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">No </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Prioritas Pembangunan Daerah </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Sasaran </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Perangkat Daerah yang Melaksanakan </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Program </th>
                        <th colspan="2" style="text-align:center;vertical-align:middle;">Pagu Indikatif </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Perubahan (-/+) (Rp) </th>
                    </tr>
                    <tr>
                        <th style="text-align:center;vertical-align:middle;">Sebelum Perubahan (Rp) </th>
                        <th style="text-align:center;vertical-align:middle;">Sesudah Perubahan (Rp) </th>
                    </tr>

                    <tr>
                    <?php for($i=1;$i<=8;$i++): ?>
                        <td style="text-align:center;vertical-align:middle;">(<?= $i ?>)</td>
                    <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                        foreach ($data1 as $key1 => $value1):
                    ?>
                        <tr>
                            <td style="text-align:center;"><?= $no++ ?></td>
                            <td><?= $value1 ?></td>
                            <td><?= $data2[$key1] ?></td>
							<td>
                            <?php foreach ($data4[$key1] as $key3 => $value3): ?>
                                <p><?= $value3 ?></p>
                            <?php endforeach; ?>
                            </td>
                            <td>
                            <?php foreach ($data3[$key1] as $key2 => $value2): ?>
                                <p><?= $value2 ?></p>
                            <?php endforeach; ?>
                            </td>
                            <td style="text-align:right;">
                            <?php foreach ($data5[$key1] as $key4 => $value4): ?>
                                <p><?= number_format($value4,0,'.','.') ?></p>
                            <?php endforeach; ?>
                            </td>
                            <td style="text-align:right;">
                            <?php foreach ($data6[$key1] as $key5 => $value5): ?>
                                <p><?= number_format($value5,0,'.','.') ?></p>
                            <?php endforeach; ?>
                            </td>
                            <td style="text-align:right;">
                            <?php foreach ($data7[$key1] as $key6 => $value6): ?>
                                <p><?= number_format($value6,0,'.','.') ?></p>
                            <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
