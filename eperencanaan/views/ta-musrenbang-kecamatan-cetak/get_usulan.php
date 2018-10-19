
<?php

use yii\helpers\Html;
    

    $no=0;
    foreach ($data as $value): 
        
        $no++;

        if ($value->Status_Penerimaan_Kecamatan == '0') {
            $Status_Penerimaan_Kecamatan = 'Belum Punya Status';
        }
        else if ($value->Status_Penerimaan_Kecamatan == '1') {
            $Status_Penerimaan_Kecamatan = 'Terima';
        }
        else if ($value->Status_Penerimaan_Kecamatan == '2') {
            $Status_Penerimaan_Kecamatan = 'Terima Dengan Perubahan';
        }
        else if ($value->Status_Penerimaan_Kecamatan == '3') {
            $Status_Penerimaan_Kecamatan = 'Ditolak';
        }

        if ($value->Status_Penerimaan_Kelurahan == '0') {
            $Status_Penerimaan_Kelurahan = 'Belum Punya Status';
        }
        else if ($value->Status_Penerimaan_Kelurahan == '1') {
            $Status_Penerimaan_Kelurahan = 'Terima';
        }
        else if ($value->Status_Penerimaan_Kelurahan == '2') {
            $Status_Penerimaan_Kelurahan = 'Terima Dengan Perubahan';
        }
        else if ($value->Status_Penerimaan_Kelurahan == '3') {
            $Status_Penerimaan_Kelurahan = 'Ditolak';
        }

    ?>

        <tr>
            <td><?= $no ?></td>
            <td><?= $value->Nm_Permasalahan ?></td>
            <td><?= $value->Jenis_Usulan ?></td>
            <td><?php if($value->Kd_Kel) echo $value->kelurahan->Nm_Kel ?></td>
            <td><?php if($value->Kd_Lingkungan) echo $value->lingkungan->Nm_Lingkungan ?></td>
            <td><?php if($value->Kd_Jalan) echo $value ->kdJalan->Nm_Jalan ?> <br/>
                <?= $value->Detail_Lokasi ?>
            </td>
            <td><?= $value->Jumlah ?></td>
            <td><?= $value->Harga_Total ?></td>
            <td><?php //if($value->Kd_Sub) echo $value->subUnit->kdSubUnit->Nm_Sub_Unit ?></td>
            <td><?= $Status_Penerimaan_Kelurahan ?> 
            <br>
            <?= $value->Alasan_Kelurahan ?></td>
            <td><?= $Status_Penerimaan_Kecamatan ?>
            <br>
            <?= $value->Alasan_Kecamatan ?>
            </td>
            <td><?= $value->Skor ?></td>
            <td><?= $value->Kd_Pem ?></td>
            <!-- <td><?php if($isi = $value->Rincian_Skor) print_r(unserialize($value->Rincian_Skor))  ?></td> -->
        </tr>
    <?php endforeach;
    
?>