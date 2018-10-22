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
                        $urusan = 0;
                        $bidang = 0;
                        $unit = 0;
                        $sub_unit = 0;
                        $prog = 0;
                        $keg = 0;
                        $urusan_set = [];
                        $bidang_set = [];
                        $prog_set = [];
                        $keg_set = [];
                        foreach ($model as $row) :
                            $urusan = $row["Kd_Urusan"];
                            $bidang = $row["Kd_Bidang"];
                            $unit = $row["Kd_Unit"];
                            $sub_unit = $row["Kd_Sub"];
                            $prog = $row["Kd_Prog"];
                            $keg = $row["Kd_Keg"];
                            $kegiatan = $row['kegiatan'];
                            if(!isset($urusan_set[$urusan])):
                        ?>

                        <!-- URUSAN -->
                        <tr>
                        <td style="font-size:11px;"><b><?= $urusan ?></b></td>
                        <td style="font-size:11px;"><b><?= $row['urusan']['Nm_Urusan'] ?></b></td>                       
						<td></td>
                        <td></td>
                        <td></td>
						<td></td>
                        <td></td>
                    	<td></td>
						<td></td>
                        <td></td>
                        <td></td>
						<td style="font-size:12px;" align="right"><b>Rp. <?= number_format($row['urusan']->sumBelanjaRincSub,0, ',', '.'); ?></b></td>
					    <td style="font-size:12px;" align="right"><b>Rp. <?= number_format($row['urusan']->sumKegiatan,0, ',', '.'); ?></b></td>
						<td></td>
                        <td></td>
                        </tr>
                        <?php $urusan_set[$urusan] = 1; endif; ?>
                        
                        <!-- BIDANG -->
                        <?php if(!$row['bidang']->countKegiatan) continue; ?>
                        <?php $k = $urusan.$bidang; if(!isset($bidang_set[$k])): ?>
                        <tr>
                        <td style="font-size:11px;"> <b><?= $urusan?>.<?= $bidang ?> </b></td>
                        <td style="font-size:11px;"> <b><?= $row['bidang']['Nm_Bidang'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td></td>
                        <td></td>
                        <td></td>
						<td></td>
                        <td></td>
                        <td></td>
						<td style="font-size:12px;" align="right"><b><?= number_format($row['bidang']->sumBelanjaRincSub,0, ',', '.') ?></b></td>
                        <td style="font-size:12px;" align="right"><b><?= number_format($row['bidang']->sumKegiatan,0, ',', '.') ?></b></td>
                        <td></td>
                        <td></td>
                        </tr>
                        <?php $bidang_set[$k] = 1; endif; ?>

                        <!-- UNIT -->
                        <?php if(!$row['unit']->countKegiatan) continue; ?>


                        <!-- SUB UNIT -->
                        

                        <!-- PROGRAM -->
                        <?php //if(empty($row->taPrograms->kegiatans)) continue; ?>
                        <?php $k = $urusan.$bidang.$unit.$sub_unit.$prog; if(!isset($prog_set[$k])): ?>
                        <tr>
                        <td style="font-size:11px;"><b> <?= $urusan?>.<?= $bidang?>.<?=$unit ?>.<?=$sub_unit ?>.<?= $prog ?> </b></td>
                        <td style="font-size:11px;"> <b><?= $row['taProgram']->refProgram['Ket_Program'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td style="font-size:12px;" align="right"><b> <?= number_format($row['taProgram']->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td>
                        <td style="font-size:12px;" align="right"> <b><?= number_format($row['taProgram']->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        <td style="font-size:11px;" align="left" ><?= $row['subUnit']['Nm_Sub_Unit'] ?></td>
                        <td></td>
                        </tr>
                        <?php $prog_set[$k] = 1; endif; ?>

                        <!-- KEGIATAN -->
                        <?php $k = $urusan.$bidang.$unit.$sub_unit.$prog.$keg; if(!isset($keg_set[$k])): ?>
                        <?php 
                            $sasaran1 = $row['taProgram']->taRpjmdProgramPrioritas;
                            $gs = $sasaran1['taRpjmdSasaran'];
                            $gd = $sasaran1['refRPJMD2'];
                            $tolakukur = isset($row['kegiatan']->taIndikatorsKinerja->Tolak_Ukur) ? $row['kegiatan']->taIndikatorsKinerja->Tolak_Ukur : '-';
                            $targetangka = isset($row['kegiatan']->taIndikatorsKinerja->Target_Angka) ? $row['kegiatan']->taIndikatorsKinerja->Target_Angka : '';
                            $targeturaian = isset($row['kegiatan']->taIndikatorsKinerja->Target_Uraian) ? $row['kegiatan']->taIndikatorsKinerja->Target_Uraian : '';
                            $targetangkan1 = isset($row['kegiatan']->taIndikatorsN1->Target_Angka) ? $row['kegiatan']->taIndikatorsN1->Target_Angka : '';
                            $targeturaiann1 = !empty($row['kegiatan']->taIndikatorsN1->Target_Angka) ? $row['kegiatan']->taIndikatorsN1->Target_Uraian : '';
                            $_belanja = $row['kegiatan']->getBelanjaRincSubs()->sum('Total');
                        ?>
                        <tr>
                        <td style="font-size:11px;"> <?= $urusan?>.<?= $bidang?>.<?=$unit ?>.<?=$sub_unit ?>.<?= $prog ?>.<?= $keg ?> </td>
                        <td style="font-size:11px;"> <?= $row['kegiatan']['Ket_Kegiatan'] ?> </td>
						<td><?php echo $gd['Nm_Prioritas_Pembangunan_Kota'];?></td>
						<td><?php echo $gs['Sasaran'];?></td>
						<td style="font-size:11px;" > <?= $row['kegiatan']['Lokasi'] ?></td>
                        <?php 
                            if(!empty($row['kegiatan']->taIndikators))
                                foreach ($row['kegiatan']->taIndikators as $tow):
                                    if ($tow->Kd_Indikator!=7):
                        ?>
						<td><p style="font-size:11px;"><?= $tow->Tolak_Ukur ?></p></td> 
						<td><p style="font-size:11px;"><?= number_format($tow->Target_Angka,0,'.','.') ?> <?= $tow->Target_Uraian ?></td></td>
                        <?php 
                                    endif;
                                endforeach; 
                        ?>
						
                        <td style="font-size:11px;" align="right" > <?= number_format(!empty($_belanja) ? $_belanja : 0,0, ',', '.') ?></td>
                        <td style="font-size:11px;" align="right" > <?= number_format($row['kegiatan']['Pagu_Anggaran_Nt1'],0, ',', '.' )?></td>
						<td style="font-size:11px;" align="left" ><?= $row['subUnit']['Nm_Sub_Unit'] ?></td>
						<td></td>	
                        </tr>
                        <?php $keg_set[$k] = 1; endif; ?>
                        <?php if(($row['Kd_Rek_3'] == 3 || $row['Kd_Rek_3'] == 2) && $row['Kd_Rek_4'] == 24): ?>
                        <tr>
                        <td style="font-size:11px;"><?= $urusan.'.'.$bidang.'.'.$unit.'.'.$sub_unit.'.'.$prog.'.'.$keg ?></td>
						<td style="font-size:11px;">
                            <?php
                            echo $row['Keterangan'];
                            echo "<br>";
                            //echo $xxB['Lokasi']; 
                            echo "(".number_format($row['Jml_Satuan'],0, ',', '.')." ". $row['Satuan123'];
                            echo " Rp. ".number_format($row['Total'],0, ',', '.') .")";
                            ?>
                        </td>
                        <td></td>
                        <td></td>
						<td style="font-size:11px;"><?= $row['Lokasi'] ?></td>
                        <td></td>
                    	<td></td>
						<td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td></td>
                        <td></td>
                        </tr>
                        <?php endif ?>
                        <?php endforeach; ?>
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