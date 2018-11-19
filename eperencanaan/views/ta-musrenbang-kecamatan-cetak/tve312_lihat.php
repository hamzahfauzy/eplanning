
<?php
$no = 1;
foreach ($NASUsulan as $value) :
    ?>
    <tr><td><?php echo $no++; ?></td>
        <td><?php echo $value->Nm_Permasalahan; ?></td>
        <td><?php echo $value->kelurahan->Nm_Kel; ?> </td>
        <td><?php if($value->Kd_Prioritas_Pembangunan_Daerah) echo $value->rpjmd->Nm_Prioritas_Pembangunan_Kota; ?> </td>
        <td>0</td>
    <tr>

    <?php endforeach; ?>


