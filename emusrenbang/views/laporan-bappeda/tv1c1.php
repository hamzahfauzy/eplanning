<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Penggabungan Prioritas Masukan Masyarakat";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
        <?= Html::a('&nbsp;Cetak&nbsp;', ['tv1c1-cetak',
                    'urusan' => $TaSubUnit->Kd_Urusan,
                    'bidang' => $TaSubUnit->Kd_Bidang,
                    'unit' => $TaSubUnit->Kd_Unit,
                    'sub' => $TaSubUnit->Kd_Sub,
                ], 
                ['class' => 'btn btn-primary btn-lg', 'target' => '_blank']);
        ?>
    </div>
     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Penggabungan Prioritas Masukan Masyarakat <br> dengan Rancangan Renja <?= $TaSubUnit->kdSubUnit->Nm_Sub_Unit ?> <br> <?= $kelompok['Kab'] ?> </h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12"><h4>Nama OPD : <?= $TaSubUnit->kdSubUnit->Nm_Sub_Unit ?></h4></div>
        <div class="col-xs-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="5" style="text-align:center;vertical-align:center;">Rancangan Renja </th>
                        <th colspan="5" style="text-align:center;vertical-align:center;">Hasil Prioritas Masukan Masyarakat </th>
                        <th rowspan="2" style="text-align:center;vertical-align:center;">Catatan Penting </th>
                    </tr>
                    <tr>
                        <th style="text-align:center;vertical-align:center;">No </th>
                        <th style="text-align:center;vertical-align:center;">Program/ Kegiatan </th>
                        <th style="text-align:center;vertical-align:center;">Lokasi </th>
                        <th style="text-align:center;vertical-align:center;">Indikator Kinerja </th>
                        <th style="text-align:center;vertical-align:center;">Target Capaian </th>
                        <th style="text-align:center;vertical-align:center;">Pagu Indikatif (Rp.000) </th>
                        <th style="text-align:center;vertical-align:center;">Program/ Kegiatan </th>
                        <th style="text-align:center;vertical-align:center;">Lokasi </th>
                        <th style="text-align:center;vertical-align:center;">Indikator Kinerja </th>
                        <th style="text-align:center;vertical-align:center;">Target Capaian </th>
                        <th style="text-align:center;vertical-align:center;">Kebutuhan Dana (Rp.000) </th>
                    </tr>

                    <tr>
                    <td style="font-size:12px;"> (1) </td>
                    <td style="font-size:12px;"> (2) </td>
                    <td style="font-size:12px;"> (3) </td>
                    <td style="font-size:12px;"> (4) </td>
                    <td style="font-size:12px;"> (5) </td>
                    <td style="font-size:12px;"> (6) </td>
                    <td style="font-size:12px;"> (7) </td>
                    <td style="font-size:12px;"> (8) </td>
                    <td style="font-size:12px;"> (9) </td>
                    <td style="font-size:12px;"> (10) </td>
                    <td style="font-size:12px;"> (11) </td>
                    <td style="font-size:12px;"> (12) </td>
                    </tr>
                </thead>
                <tbody>
                
                <?php 
                $no = 1;
                foreach ($dataKegiatan as $data): 
                    if ($data->getKegiatans()->count()<=0) {
                        continue;
                    }
                ?>



                <tr>
                    
                <td style="font-size:11px;"><?= $data['Kd_Prog'] ?> </td>
                <td style="font-size:11px;" > <?= $data->refProgram['Ket_Program'] ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                </tr>

                <?php $dataProgKeg = $data->kegiatans;
                foreach ($dataProgKeg as $dataProgKegs) :
                ?>

                <?php 
                
                if (isset($dataProgKegs->taIndikatorsKinerja->Tolak_Ukur))                       
                $tolakukur = $dataProgKegs->taIndikatorsKinerja->Tolak_Ukur;
                 else 
                $tolakukur = '-';
                
                
                if (isset($dataProgKegs->taIndikatorsKinerja->Target_Angka))
                $targetangka = $dataProgKegs->taIndikatorsKinerja->Target_Angka;                                
                else
                $targetangka = '';


                 if (isset($dataProgKegs->taIndikatorsKinerja->Target_Uraian)) 
                $targeturaian = $dataProgKegs->taIndikatorsKinerja->Target_Uraian;                                
                else 
                $targeturaian = '';
                

                if (isset($dataProgKegs->taIndikatorsN1->Target_Angka))
                $targetangkan1 = $dataProgKegs->taIndikatorsN1->Target_Angka;                                
                else
                $targetangkan1 = '-';


                if (isset($dataProgKegs->taIndikatorsN1->Target_Angka))
                $targeturaiann1 = $dataProgKegs->taIndikatorsN1->Target_Uraian;
                else   
                $targeturaiann1 = '';
                   
                ?>
                <tr>
                <td style="font-size:11px;"> <?= $dataProgKegs['Kd_Prog'] ?>.<?= $dataProgKegs['Kd_Keg']?></td>
                <td style="font-size:11px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
                <td style="font-size:11px;" > <?= $dataProgKegs['Lokasi'] ?></td>
                <td style="font-size:11px;" > <?= $tolakukur ?></td>
                <td style="font-size:11px;" > <?= $targetangka ?> <?= $targeturaian ?></td>
                <td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <?php endforeach;?>
                <?php endforeach; ?>
               <tr>
                    <td></td>
                    <td><b>TOTAL</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                     <td style="font-size:12px;" align="right"> <?= number_format($TaSubUnit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
