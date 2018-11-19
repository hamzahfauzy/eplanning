<?php


use yii\helpers\Html;
use emusrenbang\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\TaKegiatan;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefUnit;
use common\models\RefSubUnit;
use emusrenbang\models\TaBelanjaRincSub;
use common\models\TaKegiatanRancanganAwal;
use common\models\TaRpjmdSasaran;
use common\models\TaRpjmdPrioritasPembangunanDaerah;
use common\models\RefBidangPembangunan;
use common\models\RefRPJMD2;
use common\models\TaRpjmdProgramPrioritas;
use emusrenbang\models\TaIndikator;
use emusrenbang\models\TaBelanjaRancangan;
?>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
<tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN III : BERITA ACARA KESEPAKATAN  </td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;HASIL MUSRENBANG RKPD KABUPATEN ASAHAN<td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php //echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php //echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;__________________________________________________________________</td> </tr>

</table>
<br>
<br>


     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>PROGRAM DAN KEGIATAN PERANGKAT DAERAH <br>KABUPATEN ASAHAN <br> TAHUN <?= date('Y')+1 ?></h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
               <thead>
                    <tr>
                        <th style="vertical-align: middle;"><p class="text-center">No</p></th>
                        <th style="vertical-align: middle;"><p class="text-center">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/ Kegiatan </p></th>
                        <th style="vertical-align: middle;"><p class="text-center">Indikator Kinerja </p></th>
                        <th style="vertical-align: middle;"><p class="text-center">Pagu Indikatif </p></th>
                    </tr>
					<tr>
                        <th class="text-center">(1)</th>
                        <th class="text-center">(2)</th>
                        <th class="text-center">(3)</th>
                        <th class="text-center">(4)</th>
                    </tr>
               </thead>
			   <tbody>
			   <?php
                        foreach ($refurusan as $urusan) : 
						$totUrus=TaBelanjaRincSub::find()
								->where(['Kd_Urusan'=>$urusan])								
								->sum('Total');
						$totUrus1=TaKegiatan::find()
								->where(['Kd_Urusan'=>$urusan])									
								->sum('Pagu_Anggaran_Nt1');
						?>
						
                        <tr>
                        <td style="font-size:11px;"> <b><?= $urusan['Kd_Urusan'] ?> </b></td>
                        <td style="font-size:11px;"><b> <?= $urusan['Nm_Urusan'] ?> </b></td>
                        <td></td>
						 <td style="font-size:12px;" align="right"> <b><?= number_format($totUrus,0, ',', '.') ?></b></td>
					    </tr>

                        <?php
                        $urusanbid = $urusan->refBidangs;
						$a = 0;
                        foreach ($urusanbid as $urusanbidang) : 
						if($a == 20)
							break;
						$a++;
						$totBid=TaBelanjaRincSub::find()
								->Where(["and",
									["Kd_Urusan"=>$urusan],
									["Kd_Bidang"=>$urusanbidang['Kd_Bidang']],
								])
								->sum('Total');
						
						$totBid1=TaKegiatan::find()
								->Where(["and",
									["Kd_Urusan"=>$urusan],
									["Kd_Bidang"=>$urusanbidang['Kd_Bidang']],
								])
								->sum('Pagu_Anggaran_Nt1');
						$totKeg=TaKegiatan::find()
								->where(['Kd_Urusan'=>$urusan])								
								->andwhere(['Kd_Bidang'=>$urusanbidang['Kd_Bidang']])
								//->andwhere(['Kd_Unit'=>$bidangunit['Kd_Unit']])
								->count(); 
						if ($totKeg>0 ) : 
						?>
                        
                        <tr>
                        <td style="font-size:11px;"> <b><?= $urusanbidang['Kd_Urusan']?>.<?= $urusanbidang['Kd_Bidang'] ?> </b></td>
                        <td style="font-size:11px;"> <b><?= $urusanbidang['Nm_Bidang'] ?> </b></td>
                        <td></td>
						 <td style="font-size:12px;" align="right"> <b><?php echo number_format($totBid,0, ',', '.') ?></b></td>
                        
						</tr>

                        <?php 

                        $bidunit = $urusanbidang->refUnits;
						$b=0;
                        foreach ($bidunit as $bidangunit):
							if($b==20) break;
							$b++;
                         $totUni=TaBelanjaRincSub::find()
								->where(['Kd_Urusan'=>$urusan])	
								->andwhere(['Kd_Bidang'=>$urusanbidang['Kd_Bidang']])
								->andwhere(['Kd_Unit'=>$bidangunit['Kd_Unit']])
								->sum('Total');
						$totUni1=TaKegiatan::find()
								->where(['Kd_Urusan'=>$urusan])								
								->andwhere(['Kd_Bidang'=>$urusanbidang['Kd_Bidang']])
								->andwhere(['Kd_Unit'=>$bidangunit['Kd_Unit']])
								->sum('Pagu_Anggaran_Nt1');
						$totKeg1=TaKegiatan::find()
								->where(['Kd_Urusan'=>$urusan])								
								->andwhere(['Kd_Bidang'=>$urusanbidang['Kd_Bidang']])
								->andwhere(['Kd_Unit'=>$bidangunit['Kd_Unit']])
								->count(); 
						if ($totKeg1>0 ) : 
						?>
<!--
                        <tr>
                        <td style="font-size:11px;"> <b><?= $bidangunit['Kd_Urusan']?>.<?= $bidangunit['Kd_Bidang']?>.<?=$bidangunit['Kd_Unit'] ?></b> </td>
                        <td style="font-size:11px;"> <b><?= $bidangunit['Nm_Unit'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td></td>
                        <td></td>
                        <td></td>
                        
                        <td></td>
                        <td></td>
                        <td></td>
						<td style="font-size:12px;" align="right"> <b><?php 
					
						//	echo number_format($totUni,0, ',', '.') ;
					
							?></b></td>
                        <td style="font-size:12px;" align="right" ><b> <?php 
						
						//	echo number_format($totUni1,0, ',', '.') ;
						
						?></b></td>
						<td></td>
                        <td></td>
                       
                        </tr>
-->
                        <?php
                        $unitsub = $bidangunit->taSubUnits;
						$c = 0;
                        foreach ($unitsub as $unitsubs):
							if($c==20) break;
							$c++;
                         ?>
<!--
                        <tr>
                        <td style="font-size:11px;"> <b><?= $unitsubs['Kd_Urusan']?>.<?= $unitsubs['Kd_Bidang']?>.<?=$unitsubs['Kd_Unit'] ?>.<?=$unitsubs['Kd_Sub'] ?> </b></td>
                        <td style="font-size:11px;"> <b><?= $unitsubs->kdSubUnit['Nm_Sub_Unit'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
						<td style="font-size:12px;" align="right"> <b><?= number_format($unitsubs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td>
                        <td style="font-size:12px;" align="right" ><b> <?= number_format($unitsubs->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        <td></td>
                        <td></td>
                        
						</tr>
-->

                        <?php
                        $subprogram = $unitsubs->taPrograms;
						$d = 0;
                        foreach ($subprogram as $program) :
							if($d==20) break;
							$d++;
                           if ($program->getKegiatans()->count()<=0) {
                            continue;
                        }
                        ?>

                        <tr>
                        <td style="font-size:11px;"><b> <?= $program['Kd_Urusan']?>.<?= $program['Kd_Bidang']?>.<?=$program['Kd_Unit'] ?>.<?=$program['Kd_Sub'] ?>.<?= $program['Kd_Prog']  ?> </b></td>
                        <td style="font-size:11px;"> <b><?= $program->refProgram['Ket_Program'] ?> </b></td>
                        <td></td>
						<td style="font-size:12px;" align="right"><b> <?= number_format($program->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td>
                                               
						</tr>
									<?php $Sasaran1=TaRpjmdProgramPrioritas::find()
											-> where (['Kd_Prog'=>$program['Kd_Prog']])
											->one();
										/*	$GS=TaRpjmdSasaran::find()
											->where (['No_Sasaran'=>$Sasaran1['No_Sasaran']])
											->one();*/
											
										$GS=TaRpjmdSasaran::find()
											->where (['No_Misi'=>$Sasaran1['No_Misi']])
											->andwhere (['No_Tujuan'=>$Sasaran1['No_Tujuan']])
											->andwhere (['No_Sasaran'=>$Sasaran1['No_Sasaran']])
											->orderBy(['No_Sasaran' => SORT_ASC])
											->one();
										$GD=RefRPJMD2::find()
											->where (['Kd_Prioritas_Pembangunan_Kota'=>$Sasaran1['No_Prioritas']])
											->one();
										
								?>
                        <?php
                        $progkeg = $program->taKegiatans;
						$e = 0;
                        foreach ($progkeg as $kegiatan) :
						if($e==20) break;
						$e++;
                         if (isset($kegiatan->taIndikatorsKinerja->Tolak_Ukur))                       
                        $tolakukur = $kegiatan->taIndikatorsKinerja->Tolak_Ukur;
                         else 
                        $tolakukur = '-';
                        
                        
                        if (isset($kegiatan->taIndikatorsKinerja->Target_Angka))
                        $targetangka = $kegiatan->taIndikatorsKinerja->Target_Angka;                                
                        else
                        $targetangka = '';


                         if (isset($kegiatan->taIndikatorsKinerja->Target_Uraian)) 
                        $targeturaian = $kegiatan->taIndikatorsKinerja->Target_Uraian;                                
                        else 
                        $targeturaian = '';
                        

                        if (isset($kegiatan->taIndikatorsN1->Target_Angka))
                        $targetangkan1 = $kegiatan->taIndikatorsN1->Target_Angka;                                
                        else
                        $targetangkan1 = '-';


                        if (@$kegiatan->taIndikatorsN1->Target_Angka == null)
                            @$targeturaiann1 = ''; 
                        else 
                            @$targeturaiann1 = $kegiatan->taIndikatorsN1->Target_Uraian;;
                         
						  $PosisiKegiatan = [
							'Kd_Urusan' =>  $kegiatan['Kd_Urusan'], 
							'Kd_Bidang' => $kegiatan['Kd_Bidang'],
							'Kd_Unit' => $kegiatan['Kd_Unit'],
							'Kd_Sub' => $kegiatan['Kd_Sub'],
							'Kd_Prog' => $kegiatan['Kd_Prog'],
							'Kd_Keg' => $kegiatan['Kd_Keg'],
							];
								$data_belanja2=TaBelanjaRancangan::find()
								->where($PosisiKegiatan)
								->andwhere(['Kd_Rek_3'=>3])
								->count();
						 
                        ?>

                        <tr>
                        <td style="font-size:11px;"> <?= $kegiatan['Kd_Urusan']?>.<?= $kegiatan['Kd_Bidang']?>.<?=$kegiatan['Kd_Unit'] ?>.<?=$kegiatan['Kd_Sub'] ?>.<?= $kegiatan['Kd_Prog'] ?>.<?= $kegiatan['Kd_Keg'] ?> </td>
                        <td style="font-size:11px;"> <?= $kegiatan['Ket_Kegiatan'] ?> </td>
                        <td style="font-size:11px;" align="right" > <?= number_format($kegiatan->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
						<td></td>
							
                        </tr>                        
<tr> </tr>   
						<?php 
						
								
								if ($data_belanja2>0):
									$data_belanja1=TaBelanjaRincSubRancangan::find()
									->where($PosisiKegiatan)
									->andwhere(['or',['Kd_Rek_3'=>'3'],['and',['Kd_Rek_3'=>'2'],['Kd_Rek_4'=>'24']]])
									->all();
								else:
									$data_belanja1=TaBelanjaRincSub::find() 
									->where($PosisiKegiatan)
									->andwhere(['or',['Kd_Rek_3'=>'3'],['and',['Kd_Rek_3'=>'2'],['Kd_Rek_4'=>'24']]])
									->all();
								endif;
									foreach ($data_belanja1 as $xxB) : 

							 ?>
							
							<tr>
							<td style="font-size:11px;"></td>
                            <td style="font-size:11px;"></td>
                            <td style="font-size:11px;"></td>
                            <td style="font-size:11px;"></td>
                        </tr>      
						 <?php endforeach; ?>
                        <?php endforeach;?>
                        <?php endforeach; ?> 
						
                        <?php endforeach; ?> 
                        <?php endif; ?>
						<?php endforeach; ?> 
                        <?php endif; ?>
						<?php endforeach; ?>
                        <?php endforeach; ?>

						
					<tr>
                        <td></td>
                        <td><b>TOTAL</b></td>
						<td></td>
						<td style="font-size:12px;" align="right"><b> <?= number_format(@$total,0, ',', '.') ?></b></td>
                    </tr>
			   </tbody>
            </table>
        </div>
    </div>