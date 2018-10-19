<table class="table table-striped table-bordered" id="sample_1">
    <caption class="headerFox text-center">
        <h3>Rumusan Rencana Program dan Kegiatan <?= $subunit->namaSub->Nm_Sub_Unit ?> </h2>
    </caption>
    <thead>
            <tr>
             <th rowspan="2" class="vcenter text-center"> No. </th>
            <th rowspan="2" class="vcenter text-center"> OPD </th>
            <th rowspan="2" class="vcenter text-center">
                Program
            </th>
            <th colspan="2" class="vcenter text-center">Kinerja </th>
            <th rowspan="2" class="vcenter text-center">Pagu Indikatif</th>
           
            
        </tr>
        <tr>
            <th class="vcenter text-center">Indikator</th>
            <th class="vcenter text-center">Target</th>
            
        </tr>

        <tr>
            <th class="text-center">(1)</th>
            <th class="text-center">(2)</th>
            <th class="text-center">(3)</th>
            <th class="text-center">(4)</th>
            <th class="text-center">(5)</th>
            <th class="text-center">(6)</th>
    </thead>
    <tbody>                      
    
    <?php
    $no = 1; 
    foreach ($dataKegiatan as $data): 
    ?>

    <tr>
        <td> <?= $no++ ?></td>
        <td style="font-size:11px;"> <?= $data->refSubUnit['Nm_Sub_Unit'] ?> </td>
        <td style="font-size:11px;" > <?= $data->refProgram['Ket_Program'] ?></td>
        <td></td>
        <td></td>
        <td style="font-size:12px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
    </tr>
    <?php endforeach; ?>    
    </tbody>
</table>