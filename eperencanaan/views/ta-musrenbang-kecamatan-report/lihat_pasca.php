
<?php
$no = 1;
foreach ($NASUsulan as $value) :
    ?>
    <tr><td><?php echo $no++; ?></td>

        <td> <b>Permasalahan:</b><br/>
            <p><?php echo $value->Nm_Permasalahan; ?></p>
            <b>Usulan:</b>
            <p><?php echo $value->Jenis_Usulan; ?></p>
            (<?php echo @value->bidangPembangunan->Bidang_Pembangunan; ?>)
        </td>
        <td> </td>

        <td><p><?php echo @value->kelurahan->Nm_Kel; ?> </p> 
        </td> 
        <td><?php @value->lingkungan->Nm_Lingkungan ?></td> <!-- Lingkungan -->
        <td></td> <!-- Jalan -->
        <td><?php echo ($value->Jumlah . ' ' . $value->satuan->Uraian) ?></td>
        <td style="text-align: right"><?php echo \Yii::$app->zultanggal->ZULgetcurrency($value->Harga_Total) ?></td>
        <td><?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo $val->refSubUnit->Nm_Sub_Unit ?> </td>
        <td> </td>
        <td> </td>

    <tr>

    <?php endforeach; ?>

