<table class="table table-striped table-bordered" id="sample_1">
    <caption class="headerFox text-center">
        <h4>
            Rumusan Rencana Program dan Kegiatan <?= $subunit->namaSub->Nm_Sub_Unit ?>
            <br>
            <?= $kelompok['Kab'] ?>, Provinsi <?= $kelompok['Prov'] ?>
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
            <th colspan="2" class="vcenter text-center">Prakiraan Maju Rencana Tahun <?= $tahun+2 ?> </th>
            
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
        <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?></td>
        <td style="font-size:11px;" > <?= $subunit->urusan['Nm_Urusan'] ?></td>
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
        <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?></td>
        <td style="font-size:11px;" > <?= $subunit->kdBidang->Nm_Bidang ?></td>
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
        <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?></td>
        <td style="font-size:11px;" > <?= $subunit->unit->Nm_Unit ?></td>
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
        <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?>.<?= $subunit->Kd_Sub?> </td>
        <td style="font-size:11px;" > <?= $subunit->kdSubUnit->Nm_Sub_Unit ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-size:12px;" align="right"> <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran'),0, ',', '.') ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-size:12px;" align="right" > <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
    </tr>



    <?php 
	$pagu_total = 0;
  foreach ($dataKegiatan as $data): 
                            if ($data->getKegiatans()->count()<=0) {
                                continue;
                            }
                            if($data->getBelanjaRincSubs()->sum('Total')==0){
                                $belanja = $data->getKegiatans()->sum('Pagu_Anggaran');
                            }else{
                                $belanja = $data->getKegiatans()->sum('Pagu_Anggaran_Nt1');
                            }
							
    ?>

    <tr>
        <td style="font-size:11px;"> <?= $data['Kd_Urusan']?>.<?= $data['Kd_Bidang']?>.<?= $data['Kd_Unit'] ?>.<?= $data['Kd_Sub']?>.<?= $data['Kd_Prog'] ?> </td>
        <td style="font-size:11px;" > <?= $data->refProgram['Ket_Program'] ?></td>
        <td></td>
        <td></td>
        <td></td>
        
		<td style="font-size:12px;" align="right"> <?= number_format($belanja,0, ',', '.') ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-size:12px;" align="right"> <?= number_format($data->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
        

		
		
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
	
	//Ditambah Ripin G
	    if($dataProgKegs->getBelanjaRincSubs()->sum('Total')==0){
                            $pagu = $dataProgKegs->getPagu()->sum('pagu');
                        }else{
                            $pagu = $dataProgKegs->getBelanjaRincSubs()->sum('Total');
                        }

                        $pagu_total += $pagu;
	
	
    
    ?>
    <tr> </tr>
    <tr>
        <td style="font-size:11px;"> <?= $dataProgKegs['Kd_Urusan']?>.<?= $dataProgKegs['Kd_Bidang']?>.<?= $dataProgKegs['Kd_Unit'] ?>.<?= $dataProgKegs['Kd_Sub']?>.<?= $dataProgKegs['Kd_Prog'] ?>.<?= $dataProgKegs['Kd_Keg']?></td>
        <td style="font-size:11px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
        <td style="font-size:11px;" > <?= $tolakukur ?></td>
        <td style="font-size:11px;" > <?= $dataProgKegs['Lokasi'] ?></td>
        <td style="font-size:11px;" > <?= $targetangka ?> <?= $targeturaian ?></td>
        <td style="font-size:11px;" align="right" ><?= number_format($pagu,0, ',', '.') ?> <!-- <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?> --></td>
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
                             <td style="font-size:12px;" align="right"> <?= number_format($pagu_total,0, ',', '.') ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="font-size:12px;" align="right" > <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
                        </tr>
                        <?php if($subunit->getBelanjaRincSubs()->sum('Total')==0){ ?>
                        <script type="text/javascript">
                                document.getElementById("total").innerHTML = "<?= number_format($pagu_total,0, ',', '.') ?>";
                        </script>
                        <?php } ?>
	
	
	
	
    </tbody>
</table>