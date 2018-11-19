
<?php
$no = 1;
foreach ($NASUsulan as $value) :
    ?>
    <tr><td><?php echo $no++; ?></td>
        <td><?php echo $value->Nm_Permasalahan; ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?php echo $value->kelurahan->Nm_Kel; ?></td>
        <td><?php echo $value->Jumlah . ' ' . $value->satuan->Uraian ?></td>
        <td style="text-align: right"><?php echo \Yii::$app->zultanggal->ZULgetcurrency($value->Harga_Total)?></td>
        <td><?php echo $value->Kd_Sub ?></td> 
  
    
    <tr>

    <?php endforeach; ?>




