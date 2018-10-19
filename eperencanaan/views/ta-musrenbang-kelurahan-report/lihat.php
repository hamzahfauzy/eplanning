<?php
    $no = 1;
    foreach ($ZULusulan as $value) : ?>
<tr><td><?php echo $no++;?></td>
    <td><?php echo ($value->kdLink->Nm_Lingkungan.'<br>('.
        $value->kdKel->Nm_Kel.','.$value->kdKec->Nm_Kec.')');?></td>
    <td> <b>Permasalahan:</b><br/>
        <p><?php echo $value->Nm_Permasalahan?></p>
    <b>Usulan:</b>
    <p><?php echo $value->Jenis_Usulan?></p>
    (<?php echo $value->kdPem->Bidang_Pembangunan?>)
    </td>
    <td><?php echo ($value->Jumlah.' '.$value->kdSatuan->Uraian)?></td>
    <td style="text-align: right"><?php echo \Yii::$app->zultanggal->ZULgetcurrency($value->Harga_Total)?></td>
    <td><?php echo $value->Detail_Lokasi?></td>
    
        
</tr>
    
<?php endforeach;?>

