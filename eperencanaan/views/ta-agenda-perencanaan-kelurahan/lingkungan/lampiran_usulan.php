<?php

use yii\helpers\html;

setlocale(LC_ALL, 'INDONESIA');
/* public function getbulan($id){
  switch($id){
  case 1: return "Januari"; break;
  case 2: return "Februari"; break;
  case 3: return ""; break;
  case 4: return "Januari"; break;
  case 5: return "Januari"; break;
  case 6: return "Januari"; break;
  case 7: return "Januari"; break;
  case 8: return "Januari"; break;
  case 9: return "Januari"; break;
  case 10: return "Januari"; break;
  case 11: return "Januari"; break;
  default: return "Desember";
  }
  } */
?>
<!--<table style="vertical-align: top;">
    <tr><td style="width: 650px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN I</td><td style="width: 10px">:</td><td>BERITA ACARA KESEPAKATAN HASIL FORUM LINGKUNGAN <?php echo $link->kdLink->Nm_Lingkungan ?></td> </tr>
    <tr><td style="width: 650px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR</td><td style="width: 10px">:</td><td > </td> </tr>
    <tr><td style="width: 650px;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL</td><td style="width: 10px">:</td><td><?php echo date('l, d F Y', $link->Waktu_Unduh_Absen); ?></td> </tr>
</table>-->

<table style="width: 170%;">
    <tr><td style="text-align:center;">
            <br>
            <h3 style="text-align: center;"><BR>REKAPITULASI USULAN REMBUK WARGA <?= $Kelurahan." ". $Lingkungan ?><BR>TAHUN <?= $Tahun ?></h3>
        
            <BR>
        
            <table style="border: 1px solid black; text-align: center; width: 100%;height:200%;border-collapse: collapse;">
                <tr><td style="width: 50px;border: 1px solid black;">No</td>
                    <td style="width: 100px;height: 50px;border: 1px solid black;">Bidang Pembangunan</td>
                    <td style="width: 250px;height: 50px;border: 1px solid black;">Permasalahan</td>

                    <td style="width: 250px;border: 1px solid black;">Usulan Kegiatan</td>
                    <td style="width: 100px;border: 1px solid black;">Lokasi</td> 
                    <td style="width: 50px;border: 1px solid black;">Volume</td> 
                    <td style="width: 120px;border: 1px solid black;">Perkiraan Anggaran (Rp.)</td>

                </tr>
                <?php
                $x = 1;
                if ($data->count() == 0) {
                    echo '<tr><td colspan="7" style="text-align: center;"><i><h2>NIHIL</h2></i></td></tr>';
                }
                foreach ($data->all() as $model) :
                    ?>
                    <tr><td style="width: 50px;height: 50px;border: 1px solid black;"><?php
                            echo $x;
                            $x++;
                            ?></td>
                        <td style="width: 100px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->kdPem->Bidang_Pembangunan ?></td>
                        <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Nm_Permasalahan ?></td>	
                        <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 5px;"><?= $model->Jenis_Usulan ?></td>
                        <td style="width: 100px;border: 1px solid black; text-align: justify;padding: 5px;"><?= $model->kdJalan->Nm_Jalan ?></td> 
                        <td style="width: 50px;border: 1px solid black; text-align: justify;padding: 5px;"><?= $model->Jumlah . ' ' . $model->kdSatuan->Uraian ?></td> 
                        <!--<td style="width: 50px; text-align: left;">&nbsp;&nbsp; Rp. </td>-->
                        <td style="width: 120px; text-align: right;border: 1px solid black;">&nbsp;&nbsp;<?= Yii::$app->zultanggal->ZULgetcurrency($model->Harga_Total) ?></td>
                    </tr>
                    <?php if ($x > 11) break; ?> 
<?php endforeach;
$x = 0; ?>
            </table>
        </td></tr>
     
    <?php foreach ($data->all() as $model) : ?>
    <?php if ($x < 11) {$x++;continue;} ?>
    <?php if ($x % 11 === 0) echo '<tr><td><table style="border: 1px solid black; text-align: center; width: 100%;height:200%;border-collapse: collapse;">'; ?>
        <tr><td style="width: 50px;height: 50px;border: 1px solid black;"><?php
    echo $x;
    $x++;
    ?></td>
            <td style="width: 100px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->kdPem->Bidang_Pembangunan ?></td>
            <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Nm_Permasalahan ?></td>	
            <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 5px;"><?= $model->Jenis_Usulan ?></td>
            <td style="width: 100px;border: 1px solid black; text-align: justify;padding: 5px;"><?= $model->kdJalan->Nm_Jalan ?></td> 
            <td style="width: 50px;border: 1px solid black; text-align: justify;padding: 5px;"><?= $model->Jumlah . ' ' . $model->kdSatuan->Uraian ?></td> 
            <!--<td style="width: 50px; text-align: left;">&nbsp;&nbsp; Rp. </td>-->
            <td style="width: 120px; text-align: right;border: 1px solid black;">&nbsp;&nbsp;<?= Yii::$app->zultanggal->ZULgetcurrency($model->Harga_Total) ?></td>
        </tr>


    <?php if ($x % 11 === 0) {echo '</table></td></tr>';} ?>
<?php endforeach; if ($x % 11 !== 0) echo '</table></td></tr>'; ?>
    
    <tr>
        <td>
            <table style="text-align: center;width: 100%">
                <tr><td> </td><td></tr>
                <tr><td colspan="2">Mengetahui</td><td colspan="2"> </td></tr>
                <tr><td colspan="4" > </td></tr>
                <tr><td>Lurah</td><td>Tim Pendamping</td><td>Kepala Lingkungan</td><td>Perwakilan Masyarakat</td></tr>
                <tr><td style="height: 75px"></td><td></td><td></tr>
                <tr><td>(.............................................)</td><td>(.............................................)</td><td>(.............................................)</td><td>(.............................................)</td></tr>
                <tr><td>NIP : .............................................</td></tr>
            </table>
        </td>
    </tr>
</table>
