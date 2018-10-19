<table class="table" id="sample_1">
    <caption class="headerFox text-center">
    <h3> Prioritas dan Sasaran Pembangunan Daerah Tahun <?= $tahun ?></h3>
    </caption>
    <thead>

        <tr>
            <th> NO. </th>
            <th class="vcenter text-center">Prioritas Pembangunan Daerah</th>
            <th class="vcenter text-center">Sasaran Pembangunan Daerah</th>
            <th class="vcenter text-center">Nama Program</th>
            <th class="vcenter text-center">OPD Penanggung Jawab</th>
        </tr>

        <tr>
            <th class="text-center">(1)</th>
            <th class="text-center">(2)</th>
            <th class="text-center">(3)</th>
            <th class="text-center">(4)</th>
            <th class="text-center">(5)</th>
        </tr>
    </thead>
    <tbody> 

    <?php
    $no = 1;
    foreach ($PrioritasPem as $Prioritas) : ?>

    <tr> 
      <td> <?= $no++ ?> </td>
      <td style="font-size:11px;"> <?= $Prioritas['Prioritas_Pembangunan_Daerah'] ?> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr> 
        <?php $PrioritasProg =  $Prioritas->taRpjmdProgramPrioritas;
        foreach ($PrioritasProg as $Program) :
        ?>

            <tr>
              <td style="font-size:11px;"><?= $Program->taRpjmdSasaran['Sasaran'] ?></td>
              <td style="font-size:11px;"> <?= $Program->refProgram['Ket_Prog'] ?> </td> 
              <td style="font-size:11px;"> <?= $Program->refProgram->kdBidang->refUnits->refSubUnits['Nm_Sub_Unit'] ?> </td>      
            </tr> 

        <?php 
            endforeach; 
        ?>
        <?php 
            endforeach; 
        ?>    
    </tbody>
</table>