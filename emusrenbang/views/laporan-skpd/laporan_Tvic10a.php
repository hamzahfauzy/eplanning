<?php
use emusrenbang\models\TaBelanjaRincSub;
use common\models\TaSubUnit;
use common\models\TaKegiatanRancanganAwal;
use common\models\TaProgram;
use common\models\TaKegiatan;
$unit = Yii::$app->levelcomponent->getUnit();

      $Tahun = 2019;
      //$tahun = $Tahun + 1;
	  $tahun = $Tahun;
      $TaSubUnit = TaSubUnit::find()->where(['Tahun'=>$tahun,'Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();
	  $kegiatanranwal = @TaKegiatanRancanganAwal::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  $status=count($kegiatanranwal);
	 
	  $dataKegiatan = @TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  if($status == 0){
        $dataKeteranganKeg = @TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  }else{
        $dataKeteranganKeg = $kegiatanranwal;			
	  }
	  
?>
                                 <table class="table table-striped table-bordered" id="sample_1">
                        <caption class="headerFox text-center">
                            <h4>
                                Rumusan Rencana Program dan Kegiatan <?= $subunit->namaSub->Nm_Sub_Unit ?> 
                                <br>
                                Kabupaten Asahan, Provinsi Sumatera Utara
                            </h4>
                        </caption>
                        <thead>
                                <tr>
                                <th rowspan="2" class="vcenter text-center"> Kode </th>
                                <th rowspan="2" class="vcenter text-center">
                                    Urusan/Bidang Urusan <br> Pemerintahan Daerah dan <br>Program/Kegiatan
                                </th>
                                <th rowspan="2" class="vcenter text-center">
                                    Indikator Kinerja Program / Kegiatan
                                </th>
                                <th colspan="4" class="vcenter text-center">Rencana Tahun <?= $tahun+1 ?> </th>
                                <th rowspan="2" class="vcenter text-center">Catatan Penting</th>
                                <th colspan="2" class="vcenter text-center">Prakiraan Maju Rencana Tahun <?= $tahun +2 ?> </th>
                                
                            </tr>
                            <tr>
                                <th class="vcenter text-center">Lokasi</th>
                                <th class="vcenter text-center">Target Capaian</th>
                                <th class="text-center">Kebutuhan Dana/ Pagu Indikatif</th>
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
                        </thead>
                        <tbody>                      
                        <tr>
                            <td style="font-size:11px;"><b> <?= $subunit->Kd_Urusan?></b></td>
                            <td style="font-size:11px;" > <b><?= $subunit->urusan['Nm_Urusan'] ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="font-size:11px;"> <b><?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?></b></td>
                            <td style="font-size:11px;" ><b> <?= $subunit->kdBidang->Nm_Bidang ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                         <tr>
                            <td style="font-size:11px;"> <b><?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?></b></td>
                            <td style="font-size:11px;" > <b><?= $subunit->unit->Nm_Unit ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                         <tr>
                            <td style="font-size:11px;"><b> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?>.<?= $subunit->Kd_Sub?> </b></td>
                            <td style="font-size:11px;" ><b> <?= $subunit->kdSubUnit->Nm_Sub_Unit ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<!--Perintah Lama-->
                            <!--<td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>-->
							<!--Perintah Baru dari cetak_laporan_renja by Ripin-->
							<?php 
							$jumR=0;$jumQ=0;
							foreach ($dataKeteranganKeg as $data): 
                            if($status==0){
                               
									$jumR=$subunit->getKegiatans()->sum('Pagu_Anggaran');
									$jumQ=$subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1');
                                
                            }else{
                                
									$jumR=$jumR+$data['Pagu_Anggaran'];
									$jumQ=$jumQ+$data['Pagu_Anggaran_Nt1'];
                                
                            }
							endforeach;
							?>
							
							<td style="font-size:12px;" align="right"> <b><?php echo number_format($jumR,0, ',', '.');; ?></b></td>
                            
							<td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" ><b> <?php echo number_format($jumQ,0, ',', '.');; ?></b></td>
                        
						</tr>

<!--Perintah Baru dari get_laporan_renja by Ripin-->
					 <?php 
						/*$pagu_total = 0;
                        foreach ($dataKegiatan as $data): 
                            if ($data->getKegiatans()->count()<=0) {
                                continue;
                            }
                            if($data->getBelanjaRincSubs()->sum('Total')==0){
                                $belanja = $data->getKegiatans()->sum('Pagu_Anggaran');
                            }else{
                                $belanja = $data->getKegiatans()->sum('Pagu_Anggaran_Nt1');
                            }
							*/
							
                        ?>
				<!--Perinta Lama -->
                        <?php 
						$total = 0;
                        $totalnt1 = 0;
                        foreach ($dataKegiatan as $data): 
                            if($status==0){
                                if ($data->getKegiatans()->count()<=0) {
                                    continue;
                                }
                            }else{
                                if ($data->getKegiatanrancanganawal()->count()<=0) {
                                    continue;
                                }
                            }
							$tahunn = [2016=>"Pagu_Indikatif",2017=>"Tahun_Pertama",2018=>"Tahun_Kedua",2019=>"Tahun_Ketiga",2020=>"Tahun_Keempat",2021=>"Tahun_Kelima"];
							$target = [2016=>"Target0",2017=>"Target1",2018=>"Target2",2019=>"Target3",2020=>"Target4",2021=>"Target5"];
                        ?>

                        <tr>
                            <td style="font-size:11px;"> <b> <?= $data['Kd_Urusan']?>.<?= $data['Kd_Bidang']?>.<?= $data['Kd_Unit'] ?>.<?= $data['Kd_Sub']?>.<?= $data['Kd_Prog'] ?></b> </td>
                            <td style="font-size:11px;" ><b> <?= $data->refProgram['Ket_Program'] ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<!--Perintah Baru dari get_laporan_renja by Ripin-->
							<!--<td style="font-size:12px;" align="right"><b> <?php //echo  number_format($belanja,0, ',', '.') ?></b></td>-->
							<!--Perinta Lama -->
							<?php if($status == 0) { ?>
							<td style="font-size:12px;" align="right"> <b><?= number_format($data->getKegiatans()->sum('Pagu_Anggaran'),0, ',', '.') ?></b></td> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <b><?= number_format($data->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
							<?php } else { ?>
                            <td style="font-size:12px;" align="right"> <b><?= number_format($data->getKegiatanrancanganawal()->sum('Pagu_Anggaran'),0, ',', '.') ?></b></td> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"> <b><?= number_format($data->getKegiatanrancanganawal()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                            <?php } ?>

                        <?php 
						if($status == 0)
                                $dataProgKeg = $data->kegiatans;
                            else
                                $dataProgKeg = $data->kegiatanrancanganawal;


                              foreach ($dataProgKeg as $dataProgKegs) :
							  $pagu = $dataProgKegs->getPagu()->sum('pagu'); 
							  if($dataProgKegs['Pagu_Anggaran'] == 0)
								   $pagu = $dataProgKegs->refKegiatans->{$tahunn[date("Y")+1]};
							  else
								  $pagu = $dataProgKegs['Pagu_Anggaran'];
                                   
							  

							 
							  if($dataProgKegs['Pagu_Anggaran_Nt1'] == 0)
								  //print_r($dataProgKegs->refKegiatans);
								  $nt1 = 0;//$dataProgKegs->refKegiatans[$tahunn[date("Y")+2]]; //$dataProgKegs->refKegiatans->{; //dikomen oleh Ripin G || Edited By HF
								  
							  else
								  $nt1 = $dataProgKegs['Pagu_Anggaran_Nt1'];
                            
                            $total += $pagu;
                            $totalnt1 += $nt1;
                         ?>

                        <?php 
                         
                        if (isset($dataProgKegs->taIndikatorsKinerja->Tolak_Ukur))                       
                        $tolakukur = $dataProgKegs->taIndikatorsKinerja->Tolak_Ukur;
                         else 
                        $tolakukur = '-';
                        
                        
                        if (isset($dataProgKegs->taIndikatorsKinerja->Target_Angka))
							$targetangka = $dataProgKegs->taIndikatorsKinerja->Target_Angka;                                
                        else
							$targetangka = "-";


                         if (isset($dataProgKegs->taIndikatorsKinerja->Target_Uraian)) 
							@$targeturaian = $dataProgKegs->taIndikatorsKinerja->Target_Uraian;                                
                        else 
							@$targeturaian = "-";
                         
                        
						//Ditambah oleh Ripin G
						if (isset($dataProgKegs->taIndikatorsN1->Target_Uraian))
                        $targeturaiann1 = $dataProgKegs->taIndikatorsN1->Target_Uraian;                                
                        else
                        $targeturaiann1 = '-'; //batas ditambah
					
                        if (isset($dataProgKegs->taIndikatorsN1->Target_Angka))
                        $targetangkan1 = $dataProgKegs->taIndikatorsN1->Target_Angka;                                
                        else
                        $targetangkan1 = '-';

                        
						//Ditambah dari get_laporan_renja : by Ripin
						/* if($dataProgKegs->getBelanjaRincSubs()->sum('Total')==0){
                            $pagu = $dataProgKegs->getPagu()->sum('pagu');
                        }else{
                            $pagu = $dataProgKegs->getBelanjaRincSubs()->sum('Total');
                        }

                        $pagu_total += $pagu; //batas ditambah
						 */
                        ?>
                        <tr> </tr> 
                        <tr>
                            <td style="font-size:11px;"> <?= $dataProgKegs['Kd_Urusan']?>.<?= $dataProgKegs['Kd_Bidang']?>.<?= $dataProgKegs['Kd_Unit'] ?>.<?= $dataProgKegs['Kd_Sub']?>.<?= $dataProgKegs['Kd_Prog'] ?>.<?= $dataProgKegs['Kd_Keg']?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
                            <td style="font-size:11px;" > <?= $tolakukur ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Lokasi'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangka ?> <?= $targeturaian ?></td>
                            <!--<td style="font-size:11px;" align="right" > <?php //echo  number_format($pagu,0, ',', '.') ?></td> -->
							<td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs['Pagu_Anggaran'],0, ',', '.' )?></td>
							<!--<td style="font-size:11px;" align="right" > <?php //echo number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td> -->
                            
							<td style="font-size:11px;" > <?= $dataProgKegs->sumberDana['Nm_Sumber'] ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Keterangan'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangkan1 ?> <?= $targeturaiann1 ?> </td>
                            <td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs['Pagu_Anggaran_Nt1'],0, ',', '.' )?></td>

                        </tr>    
                    
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
                            <td style="font-size:12px;" align="right" ><b> <?= number_format($totalnt1,0, ',', '.') ?> 
                                <script type="text/javascript">
                                    document.getElementById("total").innerHTML = "<?= number_format($total,0, ',', '.') ?>";
                                    document.getElementById("totalnt1").innerHTML = "<?= number_format($totalnt1,0, ',', '.') ?>";
                                </script>
								</b>
                            </td>
                        </tr>
                        </tbody>
                    </table>