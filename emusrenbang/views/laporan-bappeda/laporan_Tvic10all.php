<?php
use emusrenbang\models\TaBelanjaRincSub;
use common\models\TaKegiatan;
?>
     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Rencana Program dan Kegiatan Prioritas Daerah Tahun <?= $tahun+1 ?> <br>Kabupaten Asahan</h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
                 <thead>
                                <tr>
                                <th rowspan="2" class="vcenter text-center"> Kode </th>
                                <th rowspan="2" class="vcenter text-center">
                                    Urusan/Bidang Urusan <br> Pemerintahan Daerah dan <br>Program/Kegiatan
                                </th>
                                <th rowspan="2" class="vcenter text-center">
                                    Indikator Kinerja Program / Kegiatan
                                </th>
                                <th colspan="4" class="vcenter text-center">Rencana Tahun <?= $tahun +1 ?> </th>
                                <th rowspan="2" class="vcenter text-center">Catatan Penting</th>
                                <th colspan="2" class="vcenter text-center">Prakiraan Maju Rencana Tahun <?= $tahun + 2?> </th>
                                
                            </tr>
                            <tr>
                                <th class="vcenter text-center">Lokasi</th>
                                <th class="vcenter text-center">Target Capaian</th>
                                <th class="vcenter text-center">Kebutuhan Dana/ Pagu Indikatif</th>
                                <th class="vcenter text-center">Sumber Dana</th>
                                <th class="vcenter text-center">Target Capaian Kinerja</th>
                                <th class="vcenter text-center">Kebutuhan Dana/ Pagu Indikatif</th>
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
                            </tr>
							<tr>
							  <th colspan="10" class="vcenter text-left">Urusan Pemerintahan Konkuren</th>
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
                        <td style="font-size:11px;"> <b><?= $urusan['Nm_Urusan'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right"> <b><?= number_format($totUrus,0, ',', '.') ?></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right" ><b> <?= number_format($totUrus1,0, ',', '.') ?></b></td>
                        </tr>

                        <?php
                        $urusanbid = $urusan->refBidangs;
                        foreach ($urusanbid as $urusanbidang) : 
						$totBid=TaBelanjaRincSub::find()
								->where(['Kd_Urusan'=>$urusan])	
								->andwhere(['Kd_Bidang'=>$urusanbidang['Kd_Bidang']])
								->sum('Total');
						$totBid1=TaKegiatan::find()
								->where(['Kd_Urusan'=>$urusan])								
								->andwhere(['Kd_Bidang'=>$urusanbidang['Kd_Bidang']])
								->sum('Pagu_Anggaran_Nt1');
						
						$totKeg=TaKegiatan::find()
								->where(['Kd_Urusan'=>$urusan])								
								->andwhere(['Kd_Bidang'=>$urusanbidang['Kd_Bidang']])
								
								->count(); 
						if ($totKeg>0 ) : 
						?>
                        
                        <tr>
                        <td style="font-size:11px;"><b> <?= $urusanbidang['Kd_Urusan']?>.<?= $urusanbidang['Kd_Bidang'] ?> </b></td>
                        <td style="font-size:11px;"><b> <?= $urusanbidang['Nm_Bidang'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right"> <b><?= number_format($totBid,0, ',', '.') ?></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right" ><b> <?= number_format($totBid1,0, ',', '.') ?></b></td>
                        </tr>

                         <?php 

                        $bidunit = $urusanbidang->refUnits;
                        foreach ($bidunit as $bidangunit):
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

                        <tr>
                        <td style="font-size:11px;"> <b><?= $bidangunit['Kd_Urusan']?>.<?= $bidangunit['Kd_Bidang']?>.<?=$bidangunit['Kd_Unit'] ?></b> </td>
                        <td style="font-size:11px;"> <b><?= $bidangunit['Nm_Unit'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right"> <b><?= number_format($totUni,0, ',', '.') ?></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right" ><b> <?= number_format($totUni1,0, ',', '.') ?></b></td>
                        </tr>

                        <?php
                        $unitsub = $bidangunit->taSubUnits;
                        foreach ($unitsub as $unitsubs):
                         ?>

                        <tr>
                        <td style="font-size:11px;"> <b><?= $unitsubs['Kd_Urusan']?>.<?= $unitsubs['Kd_Bidang']?>.<?=$unitsubs['Kd_Unit'] ?>.<?=$unitsubs['Kd_Sub'] ?> </b></td>
                        <td style="font-size:11px;"> <b><?= $unitsubs->kdSubUnit['Nm_Sub_Unit'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right"> <b><?= number_format($unitsubs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right" ><b> <?= number_format($unitsubs->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        </tr>


                        <?php
                        $subprogram = $unitsubs->taPrograms;
                        foreach ($subprogram as $program) :

                           if ($program->getKegiatans()->count()<=0) {
                            continue;
                        }
                        ?>

                        <tr>
                        <td style="font-size:11px;"><b> <?= $program['Kd_Urusan']?>.<?= $program['Kd_Bidang']?>.<?=$program['Kd_Unit'] ?>.<?=$program['Kd_Sub'] ?>.<?= $program['Kd_Prog']  ?> </b></td>
                        <td style="font-size:11px;"> <b><?= $program->refProgram['Ket_Program'] ?> </b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right"> <b><?= number_format($program->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size:12px;" align="right"> <b><?= number_format($program->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        </tr>

                        <?php
                        $progkeg = $program->taKegiatans;
                        foreach ($progkeg as $kegiatan) :

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
                         
                        ?>

                        <tr>
                         <td style="font-size:11px;"> <?= $kegiatan['Kd_Urusan']?>.<?= $kegiatan['Kd_Bidang']?>.<?=$kegiatan['Kd_Unit'] ?>.<?=$kegiatan['Kd_Sub'] ?>.<?= $kegiatan['Kd_Prog'] ?>.<?= $kegiatan['Kd_Keg'] ?> </td>
                         <td style="font-size:11px;"> <?= $kegiatan['Ket_Kegiatan'] ?> </td>
                         <td style="font-size:11px;" > <?= $tolakukur ?></td>
                            <td style="font-size:11px;" > <?= $kegiatan['Lokasi'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangka ?> <?= $targeturaian ?></td>
                            <td style="font-size:11px;" align="right" > <?= number_format($kegiatan->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                            <td style="font-size:11px;" > <?= $kegiatan->sumberDana['Nm_Sumber'] ?></td>
                            <td style="font-size:11px;" > <?= $kegiatan['Keterangan'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangkan1 ?> <?= $targeturaiann1 ?> </td>
                            <td style="font-size:11px;" align="right" > <?= number_format($kegiatan['Pagu_Anggaran_Nt1'],0, ',', '.' )?></td>

                        </tr>                        

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
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <b><?= number_format($total,0, ',', '.') ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <b><?= number_format($totalpagu,0, ',', '.') ?> </b></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>