<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Plafon Anggaran Sementara";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
    </div>
     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Plafon Anggaran Sementara <br>Berdasarkan Program dan Kegiatan Tahun Anggaran <?= date('Y') + 1 ?></h3></div><div class="col-md-1"></div>
        <div class="col-xs-12"><strong>Urusan &ensp;: </strong><?= $subunit->urusan->Nm_Urusan ?></div>
        <div class="col-xs-12"><strong>OPD&ensp;&ensp;&ensp;: </strong><?= $subunit->Nm_Sub_Unit ?></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">No </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Program/Kegiatan </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Sasaran Program/Kegiatan </th>
                        <th colspan="2" style="text-align:center;vertical-align:middle;">Target </th>
                        <th rowspan="2" style="text-align:center;vertical-align:middle;">Plafon Anggaran Sementara</th>
                    </tr>
                    <tr>
                        <th style="text-align:center;vertical-align:middle;">Volume </th>
                        <th style="text-align:center;vertical-align:middle;">Satuan </th>
                    </tr>

                    <tr>
                    <?php for($i=1;$i<=6;$i++): ?>
                        <td style="text-align:center;vertical-align:middle;">(<?= $i ?>)</td>
                    <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach ($TaProgram as $data1 => $value1): 
                        ?>
                        <tr>
                            <td><strong><?= $value1->Kd_Prog ?></strong></td>
                            <td><strong><?= $value1->Ket_Prog ?></strong></td>
                            <td style="text-align:right;"><strong><?= isset($value1->taRpjmdProgramPrioritas) ? $value1->taRpjmdProgramPrioritas->taRpjmdSasaran->Sasaran : '-' ?></strong></td>
                            <td style="text-align:center;"></td>
                            <td style="text-align:center;"></td>
                            <td style="text-align:right;"></td>
                        </tr>
                        <?php 
                            foreach ($value1->taKegiatans as $data2 => $value2): 
                                ?>
                                <tr>
                                    <td><?= $value1->Kd_Prog.'.'.$value2->Kd_Keg ?></td>
                                    <td style="padding-left:30px;"><?= $value2->Ket_Kegiatan ?></td>
                                    <td><?= isset($value2->taIndikatorsKinerja->Tolak_Ukur) ? ($value2->taIndikatorsKinerja->Tolak_Ukur) : '-' ?></td>
                                    <td style="text-align:center;"><?= isset($value2->taIndikatorsKinerja->Target_Angka) ? number_format($value2->taIndikatorsKinerja->Target_Angka,0,'.','.') : ''?></td>
                                    <td style="text-align:center;"><?= isset($value2->taIndikatorsKinerja->Target_Uraian) ? ($value2->taIndikatorsKinerja->Target_Uraian) : '-' ?></td>
                                    <td style="text-align:right;"><strong><?= isset($value2->pagukegiatans) ? number_format($value2->pagukegiatans,0,'.','.') : 0 ?></strong></td>
                                </tr>
                                <?php 
                            endforeach; ?>
                        <?php 
                    endforeach; 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
