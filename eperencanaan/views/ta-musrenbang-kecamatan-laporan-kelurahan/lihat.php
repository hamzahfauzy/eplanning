<?php

   /* $no = 1;
    foreach ($ZULusulan as $value) : ?>
        <tr><td><?php echo $no++;?></td>
            <td> <b>Permasalahan:</b><br/>
                <p><?php echo $value->Nm_Permasalahan?></p>
                <b>Usulan:</b>
                <p><?php echo $value->Jenis_Usulan?></p>
            (<?php echo $value->kdPem->Bidang_Pembangunan?>)
            </td>
            <td><?php echo ($value->Jumlah.' '.$value->kdSatuan->Uraian)?></td>
            <td style="text-align: right"><?php echo \Yii::$app->zultanggal->ZULgetcurrency($value->Harga_Total)?></td>
            <td><?php echo $value->Detail_Lokasi?></td>
        </tr> */
    $no = 1;

    foreach ($NASUsulan as $value) : ?>
        <tr><td><?php echo $no++;?></td>
            <td><b>Permasalahan:</b><br/>
                <p><?php echo $value->Nm_Permasalahan;?></p>
                <b>Usulan:</b>
                <p><?php echo $value->Jenis_Usulan;?></p>
            (<?php echo $value->kdPem->Bidang_Pembangunan;?>) </td>
            <td> <!-- 1 --> </td>
            <td> <!-- 2 --> </td>
            <td> <!-- 3 --></td>
            <td> <!-- 4 --></td>
            <td> <!-- 5 --></td> 
            <td><!-- 6 --></td>
            <td> <!-- 7 --> </td>
            <td><!-- 8 --> </td>
            <td> <!-- Total -->  </td>
            <tr>
                  
<?php endforeach;?>
    
        