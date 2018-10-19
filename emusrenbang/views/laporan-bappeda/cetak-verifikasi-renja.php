    <table class="table table-bordered" id="sample_1">
        <caption class="headerFox text-center">
            <h3>Rumusan Rencana Program dan Kegiatan <?= $subunit->namaSub->Nm_Sub_Unit ?> </h2>
        </caption>
        <thead>
            <tr>
                <th rowspan="2" class="text-center"> Kode </th>
                <th rowspan="2" class="text-center">
                    Urusan/Bidang Urusan <br> Pemerintahan Daerah dan <br>Program/Kegiatan
                </th>
                <th rowspan="2" class="text-center">
                    Indikator Kinerja Program / Kegiatan
                </th>
                <th colspan="4" class="text-center">Rencana Tahun <?= $tahun ?> </th>
                <th rowspan="2" class="text-center">Catatan Penting</th>
                <th colspan="2" class="text-center">Prakiraan Maju Rencana Tahun 2019 </th>
                <th rowspan="2" class="text-center">Keterangan Verifikasi Bappeda</th>
            </tr>
            <tr>
                <th class="text-center">Lokasi</th>
                <th class="text-center">Target Capaian</th>
                <th class="text-center">Kebutuhan Dana/ Pagu Indikatif</th>
                <th class="text-center">Sumber Dana</th>
                <th class="text-center">Target Capaian Kinerja</th>
                <th class="text-center">Kebutuhan Dana/ Pagu Indikatif</th>
                
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
            <td></td>
        </tr>
         <tr>
            <td style="font-size:11px;"> <?= $subunit->Kd_Urusan?>.<?= $subunit->Kd_Bidang?>.<?= $subunit->Kd_Unit?>.<?= $subunit->Kd_Sub?> </td>
            <td style="font-size:11px;" > <?= $subunit->kdSubUnit->Nm_Sub_Unit ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size:12px;" align="right" > <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
            
        </tr>

        <?php 
        foreach ($dataKegiatan as $data): 
            if ($data->getKegiatans()->count()<=0) {
                continue;
            }
        ?>

        <tr>
            <td style="font-size:11px;"> <?= $data['Kd_Urusan']?>.<?= $data['Kd_Bidang']?>.<?= $data['Kd_Unit'] ?>.<?= $data['Kd_Sub']?>.<?= $data['Kd_Prog'] ?> </td>
            <td style="font-size:11px;" > <?= $data->refProgram['Ket_Program'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size:12px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size:12px;" align="right"> <?= number_format($data->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
            <td></td>

        <?php 
            $dataProgKeg = $data->kegiatans;
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


        if ($dataProgKegs->taIndikatorsN1->Target_Angka == null)
            $targeturaiann1 = '';
        else 
            $targeturaiann1 = $dataProgKegs->taIndikatorsN1->Target_Uraian;;
        
        ?>
        <tr> </tr>
        <tr>
            <td style="font-size:11px;"> <?= $dataProgKegs['Kd_Urusan']?>.<?= $dataProgKegs['Kd_Bidang']?>.<?= $dataProgKegs['Kd_Unit'] ?>.<?= $dataProgKegs['Kd_Sub']?>.<?= $dataProgKegs['Kd_Prog'] ?>.<?= $dataProgKegs['Kd_Keg']?></td>
            <td style="font-size:11px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
            <td style="font-size:11px;" > <?= $tolakukur ?></td>
            <td style="font-size:11px;" > <?= $dataProgKegs['Lokasi'] ?></td>
            <td style="font-size:11px;" > <?= $targetangka ?> <?= $targeturaian ?></td>
            <td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
            <td style="font-size:11px;" > <?= $dataProgKegs->sumberDana['Nm_Sumber'] ?></td>
            <td style="font-size:11px;" > <?= $dataProgKegs['Keterangan'] ?></td>
            <td style="font-size:11px;" > <?php $targetangkan1 ?> <?php $targeturaiann1 ?> </td>
            <td style="font-size:11px;" align="right" > <?= number_format($dataProgKegs['Pagu_Anggaran_Nt1'],0, ',', '.' )?></td>
            <td><?= $dataProgKegs['Keterangan_Verifikasi_Bappeda'] ?></td>

        </tr>
        <?php endforeach; ?>   
        <?php endforeach; ?>

        <tr>
            <td></td>
            <td><b>TOTAL</b></td>
            <td></td>
            <td></td>
            <td></td>
             <td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size:12px;" align="right" > <?= number_format($subunit->getKegiatans()->sum('Pagu_Anggaran_Nt1'),0, ',', '.') ?></td>
        </tr>
        

        </tbody>
    </table>