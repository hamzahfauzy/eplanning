<?php
    $no = 1;
    foreach ($ZULusulan as $value) : ?>
<tr><td><?php echo $no++;?></td>
    <td> </td>
    <td> <b>Permasalahan:</b><br/>
        <p><?php echo $value->Nm_Permasalahan?></p>
    <b>Usulan:</b>
    <p><?php echo $value->Jenis_Usulan?></p>
    (<?php echo $value->kdPem->Bidang_Pembangunan?>)
    </td>
    <td><?php echo ($value->Jumlah.' '.$value->kdSatuan->Uraian)?></td>
    <td><?php echo $value->Harga_Total?></td>
    <td><?php echo $value->Detail_Lokasi?></td>
    
        
</tr>
    
<?php endforeach;?>

