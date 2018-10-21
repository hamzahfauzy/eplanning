<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

// $this->title = "Laporan RKPD Tahun ".($tahun);
$this->title = "Laporan RKPD " .($tahun);
$this->params['breadcrumbs'][] = "Laporan";
$this->params['breadcrumbs'][] = $this->title;

// $level = Yii::$app->user->level;
// $namalengkap='';
// if($level != "admin"){
//     $namalengkap=Yii::$app->user->identity->nama_lengkap; 
// }


$js="Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
//UIExtendedModals.init('index.php?r=ajax/modaltest&id=test');
TableAdvanced.init();

";
$this->registerJs($js, 4, 'My');

?>
<div>
    <div class="clearfix"></div>
    <br>
    <style type="text/css">
        .tanda{
            background: #578ebe !important;
            color: #fff !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue-hoki">
                <div class="portlet-title">
                    <div class="tools">
                    </div>
                    <div class="control-wrap">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <br>
                               <?= Html::a('Cetak', ['/laporan-bappeda/cetak-tvic10all2'], ['class'=>'btn btn-bg btn-primary', 'target'=>'_blank']) ?>

                            </div>
                        </div>
                    </div>   
                </div>
                <div class="clearfix"></div>
                <h3 align="center">PROGRAM DAN KEGIATAN PERANGKAT DAERAH <br>KABUPATEN ASAHAN <br> TAHUN <?= date('Y')+1 ?></h3>
                <div class="box-body" style="overflow:auto;">
                    <table class="table table-striped table-bordered" id="sample_1">
                    <thead>
                    <tr>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">No</p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/ Kegiatan </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Prioritas Daerah </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Sasaran Daerah </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Lokasi </p></th>
                        <th colspan="6" style="vertical-align: middle;"><p class="text-center">Indikator Kinerja </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Pagu Indikatif </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Prakiraan Maju </p></th>
                        <th colspan="2" style="vertical-align: middle;"><p class="text-center">Keterangan </p></th>
                    </tr>
                    <tr>
                        <th colspan="2" style="vertical-align: middle;"><p class="text-center">Hasil Program </p></th>
                        <th colspan="2" style="vertical-align: middle;"><p class="text-center">Keluaran Kegiatan </p></th>
                        <th colspan="2" style="vertical-align: middle;"><p class="text-center">Hasil Kegiatan </p></th>
                        <th><p class="text-center">OPD </p></th>
                        <th><p class="text-center">Jenis Keg </p></th>
                    </tr>
					<tr>
                        <th><p class="text-center">Tolok Ukur </p></th>
                        <th><p class="text-center">Target </p></th>
                        <th><p class="text-center">Tolok Ukur </p></th>
                        <th><p class="text-center">Target </p></th>
                        <th><p class="text-center">Tolok Ukur </p></th>
                        <th><p class="text-center">Target </p></th>
                        <th><p class="text-center">1/2/3 </p></th>
                        <th><p class="text-center">1/2/3 </p></th>
                    
                    </tr>
					<tr>
                        <th class="text-center">(1)</th>
                        <th class="text-center">(2)</th>
                        <th class="text-center">(3)</th>
                        <th class="text-center">(4)</th>
                        <th class="text-center">(5)</th>
                        <th class="text-center">(6)</th>
                        <th class="text-center">(7)</th>
                        <th class="text-center">(8)</th>
                        <th class="text-center">(9)</th>
                        <th class="text-center">(10)</th>
						<th class="text-center">(11)</th>
						<th class="text-center">(12)</th>
						<th class="text-center">(13)</th>
						<th class="text-center">(14)</th>
						<th class="text-center">(15)</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($refurusan as $urusan) : 
                            $belanja = $urusan->sumBelanjaRincSub;
                            $kegiatan = $urusan->sumKegiatan;
                        ?>
						
                        <tr>
                        <td style="font-size:11px;"> <b><?= $urusan['Kd_Urusan'] ?> </b></td>
                        <td style="font-size:11px;"><b> <?= $urusan['Nm_Urusan'] ?> </b></td>
                       
						<td></td>
                        <td></td>
                        <td></td>
						<td></td>
                        <td></td>
                    	<td></td>
						<td></td>
                        <td></td>
                        <td></td>
						<td style="font-size:12px;" align="right"><b>Rp. <?= number_format($belanja,0, ',', '.'); ?></b></td>
					    <td style="font-size:12px;" align="right"><b>Rp. <?= number_format($kegiatan,0, ',', '.'); ?></b></td>
						<td></td>
                        <td></td>
                        </tr>
                        <?php 
                        foreach ($urusan->refBidangs as $urusanbidang) :
                            $bidang_belanja = $urusanbidang->sumBelanjaRincSub; 
                            $bidang_kegiatan = $urusanbidang->sumKegiatan; 
                            if(!empty($bidang_kegiatan)):
                        ?>
                        <tr>
                        <td style="font-size:11px;"> <b><?= $urusanbidang['Kd_Urusan']?>.<?= $urusanbidang['Kd_Bidang'] ?> </b></td>
                        <td style="font-size:11px;"> <b><?= $urusanbidang['Nm_Bidang'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td></td>
                        <td></td>
                        <td></td>
						<td></td>
                        <td></td>
                        <td></td>
						<td style="font-size:12px;" align="right"><b>Rp. <?= number_format($bidang_belanja,0, ',', '.'); ?></b></td>
					    <td style="font-size:12px;" align="right"><b>Rp. <?= number_format($bidang_kegiatan,0, ',', '.'); ?></b></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <?php 
                        endif; 
                        foreach ($urusanbidang->refUnits as $unit) : 
                            $unit_belanja = $unit->sumBelanjaRincSub; 
                            $unit_kegiatan = $unit->sumKegiatan; 
                            if(!empty($unit_kegiatan)):
                            foreach ($unit->refSubUnits as $subunit) :
                            foreach ($subunit->taPrograms as $program) :
                                if ($program->getKegiatans()->count()<=0) continue;
                        ?>
                        <tr>
                        <td style="font-size:11px;"><b><?= $program['Kd_Urusan']?>.<?= $program['Kd_Bidang']?>.<?=$program['Kd_Unit'] ?>.<?=$program['Kd_Sub'] ?>.<?= $program['Kd_Prog'] ?></b></td>
                        <td style="font-size:11px;"><b><?= $program->refProgram['Ket_Program'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td style="font-size:12px;" align="right"><b> <?= number_format($program->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td>
                        <td style="font-size:12px;" align="right"> <b><?= number_format($program->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        <td style="font-size:11px;" align="left" ><?= $subunit['Nm_Sub_Unit'] ?> </td>
                        <td></td>
						</tr>
                        <?php 
                            $sasaran1 = $program->taRpjmdProgramPrioritas;
                            $gs = $sasaran1['taRpjmdSasaran'];
                            $gd = $sasaran1['refRPJMD2'];
                            foreach($program->taKegiatans as $kegiatan):
                                $tolakukur = isset($kegiatan->taIndikatorsKinerja->Tolak_Ukur) ? $kegiatan->taIndikatorsKinerja->Tolak_Ukur : '-';
                                $targetangka = isset($kegiatan->taIndikatorsKinerja->Target_Angka) ? $kegiatan->taIndikatorsKinerja->Target_Angka : '';
                                $targeturaian = isset($kegiatan->taIndikatorsKinerja->Target_Uraian) ? $kegiatan->taIndikatorsKinerja->Target_Uraian : '';
                                $targetangkan1 = isset($kegiatan->taIndikatorsN1->Target_Angka) ? $kegiatan->taIndikatorsN1->Target_Angka : '';
                                $targeturaiann1 = !empty($kegiatan->taIndikatorsN1->Target_Angka) ? $kegiatan->taIndikatorsN1->Target_Uraian : '';
                        ?>
                        <tr>
                        <td style="font-size:11px;"> <?= $kegiatan['Kd_Urusan']?>.<?= $kegiatan['Kd_Bidang']?>.<?=$kegiatan['Kd_Unit'] ?>.<?=$kegiatan['Kd_Sub'] ?>.<?= $kegiatan['Kd_Prog'] ?>.<?= $kegiatan['Kd_Keg'] ?> </td>
                        <td style="font-size:11px;"> <?= $kegiatan['Ket_Kegiatan'] ?> </td>
						<td><?php echo $gd['Nm_Prioritas_Pembangunan_Kota'];?></td>
						<td><?php echo $gs['Sasaran'];?></td>
						<td style="font-size:11px;" > <?= $kegiatan['Lokasi'] ?></td>
                        <?php 
                                foreach ($kegiatan->taIndikators as $tow):
                                    if ($tow->Kd_Indikator!=7):
                        ?>
						<td><p style="font-size:11px;"><?= $tow->Tolak_Ukur ?></p></td> 
						<td><p style="font-size:11px;"><?= number_format($tow->Target_Angka,0,'.','.') ?> <?= $tow->Target_Uraian ?></td></td>
                        <?php 
                                    endif;
                                endforeach; 
                        ?>
                        <td style="font-size:11px;" align="right" > <?= number_format($kegiatan->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                        <td style="font-size:11px;" align="right" > <?= number_format($kegiatan['Pagu_Anggaran_Nt1'],0, ',', '.' )?></td>
						<td style="font-size:11px;" align="left" ><?= $subunit['Nm_Sub_Unit'] ?> </td>
						<td></td>	
                        </tr>
                        <?php
                            endforeach;
                            endforeach; 
                            endforeach; 
                            endif;
                        endforeach;
                        endforeach;
                        endforeach;
                        ?>
                        <tr>
                            <td></td>
                            <td><b>TOTAL</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<td style="font-size:12px;" align="right"><b> <?= number_format(@$total,0, ',', '.') ?></b></td>
                            <td style="font-size:12px;" align="right"> <b><?= number_format(@$totalpagu,0, ',', '.') ?></b> </td>
							<td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>