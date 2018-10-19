<?php
use emusrenbang\models\TaBelanjaRincSub;
use emusrenbang\models\TaBelanjaRancangan;
use common\models\TaKegiatanRancangan;
use common\models\TaKegiatan;
use common\models\TaProgram;
use common\models\TaSubUnit;
use emusrenbang\models\TaBelanjaRincRancanganAkhir;
use emusrenbang\models\TaBelanjaRincSubRancanganAkhir;
$unit = Yii::$app->levelcomponent->getUnit();
$Tahun = Yii::$app->pengaturan->getTahun();
      //$tahun = $Tahun + 1;
	  $tahun = $Tahun;

      $TaSubUnit = TaSubUnit::find()->where(['Tahun'=>$tahun,'Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit])->one();
      if(empty($TaSubUnit)){
      	//return $this->redirect(['ta-sub-unit/index']);
      	echo "<script>alert('Data Pimimpinan dan Visi masih kosong. Silahkan Isi Terlebih dahulu');location='index.php?r=ta-sub-unit/index';</script>";
      	return;
	  }
            
		$belanja = TaKegiatanRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	 // $belanjaranwal = TaKegiatanRancanganAwal::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  //$statusranwal = count($belanjaranwal);
	  $status=count($belanja);
	  $dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  if($status == 0){

        $dataKeteranganKeg = TaKegiatan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
	  
	  }else{
		
		//$dataKegiatan = TaProgram::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();

        $dataKeteranganKeg = TaKegiatanRancangan::find()->where(['Tahun'=>$TaSubUnit->Tahun ,'Kd_Urusan'=>$TaSubUnit->Kd_Urusan, 'Kd_Bidang'=>$TaSubUnit->Kd_Bidang, 'Kd_Unit'=>$TaSubUnit->Kd_Unit, 'Kd_Sub'=>$TaSubUnit->Kd_Sub])->all();
			
	  }
				if($status==0){
									$getBelanjaRinc = $subunit->getBelanjaRincSubs();
				}
				else{
									$getBelanjaRinc = $subunit->getBelanjaRincSubsRancangan();
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
                                <th colspan="4" class="vcenter text-center">Rencana Tahun <?= $tahun +1?> </th>
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
                            <td style="font-size:11px;"> <b><?= $subunit->Kd_Urusan?></b></td>
                            <td style="font-size:11px;" ><b> <?= $subunit->urusan['Nm_Urusan'] ?></b></td>
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
                            <td style="font-size:11px;" > <b><?= $subunit->kdBidang->Nm_Bidang ?></b></td>
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
                            <td style="font-size:11px;"> <b><?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?>.<?= $subunit->Kd_Sub?> </b></td>
                            <td style="font-size:11px;" ><b> <?= $subunit->kdSubUnit->Nm_Sub_Unit ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<!--Perintah Lama-->
                            <!--<td style="font-size:12px;" align="right"> <b><?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td>-->
							<td style="font-size:12px;" align="right"> <b><?= number_format($getBelanjaRinc->sum('Total'),0, ',', '.') ?></b></td>
							<!--Perintah Baru dari cetak_laporan_renja by Ripin-->
							<!--<td style="font-size:12px;" align="right"> <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran'),0, ',', '.') ?></td>-->
                            
							<td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" ><b> <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        </tr>

<!--Perintah Baru dari get_laporan_renja by Ripin-->
					  <?php 
                        foreach ($dataKegiatan as $data): 
							if($status == 0){
                                if ($data->getKegiatans()->count()<=0) {
                                    continue;
                                }
								$dataProgKeg = $data->kegiatans;
								$belanja = $data->getBelanjaRincSubs();
							}else{
                                if ($data->getKegiatanrancangan()->count()<=0) {
                                    continue;
                                }
								$dataProgKeg = $data->kegiatanrancangan;
								$belanja = $data->getBelanjaRincSubsRancangan();
							}
                        ?>
							
                        ?>
				<!--Perinta Lama -->
                        <?php 
                       /*foreach ($dataKegiatan as $data): 
                            if ($data->getKegiatans()->count()<=0) {
                                continue;
                            }*/
                        ?>

                        <tr>
                            <td style="font-size:11px;"><b> <?= $data['Kd_Urusan']?>.<?= $data['Kd_Bidang']?>.<?= $data['Kd_Unit'] ?>.<?= $data['Kd_Sub']?>.<?= $data['Kd_Prog'] ?></b> </td>
                            <td style="font-size:11px;" ><b> <?= $data->refProgram['Ket_Program'] ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
							<!--Perintah Baru dari get_laporan_renja by Ripin-->
							<!--<td style="font-size:12px;" align="right"> <?php //echo number_format($belanja,0, ',', '.') ?></td> -->
							<!--Perinta Lama -->
                            <!--<td style="font-size:12px;" align="right"><b> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td> -->
                            <td style="font-size:12px;" align="right">  <b><?= number_format($belanja->sum('Total'),0, ',', '.') ?></b></td>
							<td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right"><b> <?= number_format($data->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                            

                        <?php //$dataProgKeg = $data->kegiatans;


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
                        
						//Ditambah oleh Ripin G
						if (isset($dataProgKegs->taIndikatorsN1->Target_Uraian))
                        $targeturaiann1 = $dataProgKegs->taIndikatorsN1->Target_Uraian;                                
                        else
                        $targeturaiann1 = '-'; //batas ditambah
					
                        if (isset($dataProgKegs->taIndikatorsN1->Target_Angka))
                        $targetangkan1 = $dataProgKegs->taIndikatorsN1->Target_Angka;                                
                        else
                        $targetangkan1 = '-';

                        $PosisiKegiatan = [
							'Kd_Urusan' =>  $dataProgKegs['Kd_Urusan'], 
							'Kd_Bidang' => $dataProgKegs['Kd_Bidang'],
							'Kd_Unit' => $dataProgKegs['Kd_Unit'],
							'Kd_Sub' => $dataProgKegs['Kd_Sub'],
							'Kd_Prog' => $dataProgKegs['Kd_Prog'],
							'Kd_Keg' => $dataProgKegs['Kd_Keg'],
							];
								$data_belanja2=TaBelanjaRincRancanganAkhir::find()
								->where($PosisiKegiatan)
								->andwhere(['Kd_Rek_3'=>3])
								->count();
						
						
                        ?>
                        <tr> </tr>
                        <tr>
                            <td style="font-size:11px;"> <?= $dataProgKegs['Kd_Urusan']?>.<?= $dataProgKegs['Kd_Bidang']?>.<?= $dataProgKegs['Kd_Unit'] ?>.<?= $dataProgKegs['Kd_Sub']?>.<?= $dataProgKegs['Kd_Prog'] ?>.<?= $dataProgKegs['Kd_Keg']?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
                            <td style="font-size:11px;" > <?= $tolakukur ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Lokasi'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangka ?> <?= $targeturaian ?></td>
                           <!-- <td style="font-size:11px;" align="right" > <?php //echo number_format($pagu,0, ',', '.') ?></td> -->
						   	<td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td> 
								
                            <td style="font-size:11px;" > <?= $dataProgKegs->sumberDana['Nm_Sumber'] ?></td>
                            <td style="font-size:11px;" > <?= $dataProgKegs['Keterangan'] ?></td>
                            <td style="font-size:11px;" > <?= $targetangkan1 ?> <?= $targeturaiann1 ?> </td>
                            <td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs['Pagu_Anggaran_Nt1'],0, ',', '.' )?></td>

                        </tr>    
                        <tr> </tr>   
						<?php 
								
								if ($data_belanja2>0):
									$data_belanja1=TaBelanjaRincSubRancanganAkhir::find()
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
                            <td style="font-size:11px;"> <i>
							<?php 
								
								
										echo $xxB['Keterangan'];
									echo "<br>";
									echo $xxB['Lokasi']; 
									
									

							 ?>
							</td>
                            <td style="font-size:11px;" > </td>
							<td style="font-size:11px;" > <i><?= $xxB['Lokasi'] ?></td>
                            <td style="font-size:11px;" > <i>
							<?php 
								
								
									echo number_format($xxB['Jml_Satuan'],0, ',', '.')." ". $xxB['Satuan123'];
									

							?>
							</td>
                            <td style="font-size:11px;" align="right" > <i>
							<?php 
								
								
									echo number_format($xxB['Total'],0, ',', '.');
									

							?>
							
							<</td>
                            <td style="font-size:11px;" > </td>
							<?php if ($xxB['Kd_Rek_3']=='3'){ ?>
                            <td style="font-size:11px;" > Belanja Modal	</td>
							<?php } else { ?>
							<td style="font-size:11px;" > Belanja Barang	</td> 
							<?php } ?>
                            <td style="font-size:11px;" >   </td>
                            <td style="font-size:11px;" align="right" ></td>

                        </tr>    
                        <?php endforeach; ?>   
						<?php endforeach; ?>   
                        <?php endforeach; ?>

                        <tr>
                            <td></td>
                            <td><b>TOTAL</b></td>
                            <td></td>
                            <td></td> 
                            <td></td>
							<!-- Perintah Baru dari get_laporan_renja : by Ripin-->
							<!--<td style="font-size:12px;" align="right"> <?php  //echo number_format($pagu_total,0, ',', '.') ?></td> -->
							<!-- Perintah Lama -->
							<!--<td style="font-size:12px;" align="right"><b> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td> -->
							<td style="font-size:12px;" align="right">  <b><?= number_format($getBelanjaRinc->sum('Total'),0, ',', '.') ?> </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" ><b> <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></b></td>
                        </tr>
						
                        </tbody>
                    </table>