<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Laporan RKPD";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <?= Html::a('&nbsp;Cetak&nbsp;', ['cetak-laporan-rkpd'], 
                ['class' => 'btn btn-primary', 'target' => '_blank']);
        ?>
    </div>
     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Rencana Program dan Kegiatan Prioritas Daerah Tahun <?= date('Y') ?> <br>Kabupaten Asahan, Provinsi Sumatera Utara</h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="3" style="text-align:center;vertical-align:middle;">Nomor </th>
                        <th rowspan="3" style="text-align:center;vertical-align:middle;">Urusan/ Bidang Urusan/ Pemerintahan Daerah dan Program/ Kegiatan </th>
                        <th rowspan="3" style="text-align:center;vertical-align:middle;">Prioritas Daerah </th>
                        <th rowspan="3" style="text-align:center;vertical-align:middle;">Sasaran Daerah </th>
                        <th rowspan="3" style="text-align:center;vertical-align:middle;">Lokasi </th>
                        <th colspan="6" style="text-align:center;vertical-align:middle;">Indikator Kerja </th>
                        <th rowspan="3" style="text-align:center;vertical-align:middle;">Pagu Indikatif </th>
                        <th rowspan="3" style="text-align:center;vertical-align:middle;">Prakiraan Maju </th>
                        <th colspan="3" style="text-align:center;vertical-align:middle;">Keterangan </th>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align:center;vertical-align:middle;">Hasil Program </th>
                        <th colspan="2" style="text-align:center;vertical-align:middle;">Keluaran Kegiatan </th>
                        <th colspan="2" style="text-align:center;vertical-align:middle;">Hasil Kegiatan </th>
                        <th style="text-align:center;vertical-align:middle;">OPD </th>
                        <th style="text-align:center;vertical-align:middle;">Jenis Keg </th>
                    </tr>
                    <tr>
                        <th style="text-align:center;vertical-align:middle;">Tolok Ukur </th>
                        <th style="text-align:center;vertical-align:middle;">Target </th>
                        <th style="text-align:center;vertical-align:middle;">Tolok Ukur </th>
                        <th style="text-align:center;vertical-align:middle;">Target </th>
                        <th style="text-align:center;vertical-align:middle;">Tolok Ukur </th>
                        <th style="text-align:center;vertical-align:middle;">Target </th>
                        <th style="text-align:center;vertical-align:middle;">1/2/3 </th>
                        <th style="text-align:center;vertical-align:middle;">1/2/3 </th>
                    </tr>

                    <tr>
                    <?php for($i=1;$i<=15;$i++): ?>
                        <td style="text-align:center;vertical-align:middle;">(<?= $i ?>)</td>
                    <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $data->urusan->Kd_Urusan ?></td>
                        <td><?= $data->urusan->Nm_Urusan ?></td>
                        <?php for($i=1;$i<=13;$i++): ?> <td></td> <?php endfor; ?>
                    </tr>
                    <tr>
                        <td><p><?= $data->urusan->Kd_Urusan.'.'.$data->kdBidang->Kd_Bidang ?></p></td>
                        <td style="padding-left:10px;"><p><?= $data->kdBidang->Nm_Bidang ?></p></td>
                        <?php for($i=1;$i<=13;$i++): ?> <td></td> <?php endfor; ?>
                    </tr>
                    <?php foreach ($data->taPrograms as $key1 => $value1): ?>
                        <tr>
                            <td><p><?= $data->urusan->Kd_Urusan.'.'.$data->kdBidang->Kd_Bidang.'.'.$value1->Kd_Prog ?></p></td>
                            <td style="padding-left:20px;"><p><?= $value1->Ket_Prog ?></p></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?= $value1->Tolak_Ukur ?></td>
                            <td><?= number_format($value1->Target_Angka,0,'.','.').' '.$value1->Target_Uraian ?></td>
                            <?php for($i=1;$i<=8;$i++): ?> <td></td> <?php endfor; ?>
                        </tr>
                        <?php foreach ($value1->kegiatans as $key2 => $value2): ?>
                        <?php $Indikator = $value2->taIndikators ?>
                            <tr>
                                <td><p><?= $data->urusan->Kd_Urusan.'.'.$data->kdBidang->Kd_Bidang.'.'.$value1->Kd_Prog.'.'.$value2->Kd_Keg ?></p></td>
                                <td style="padding-left:30px;"><p><?= $value2->Ket_Kegiatan ?></p></td>
                                <td></td>
                                <td></td>
                                <td><?= $value2->Lokasi ?></td>
                                <td></td>
                                <td></td>
                                <td><?= isset($Indikator[1]) ? $Indikator[1]->Tolak_Ukur : '' ?></td>
                                <td><?= isset($Indikator[1]) ? number_format($Indikator[1]->Target_Angka,0,'.','.').' '.$Indikator[1]->Target_Uraian : '' ?></td>
                                <td><?= isset($Indikator[2]) ? $Indikator[2]->Tolak_Ukur : '' ?></td>
                                <td><?= isset($Indikator[2]) ? number_format($Indikator[2]->Target_Angka,0,'.','.').' '.$Indikator[2]->Target_Uraian : '' ?></td>
                                <td style="text-align:right;"><?= number_format($value2->getBelanjaRincSubs()->sum('Total'),0,'.','.') ?></td>
                                <td style="text-align:right;"><?= number_format($value2->Pagu_Anggaran_Nt1,0,'.','.') ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
