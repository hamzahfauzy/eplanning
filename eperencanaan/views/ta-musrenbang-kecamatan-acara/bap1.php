<?php

use yii\helpers\html;

setlocale(LC_ALL, 'INDONESIA');
?>
<h5 style="text-align: center;"><b>BERITA ACARA MUSRENBANG KECAMATAN TAHUN 2017<br>
        
        KECAMATAN <?php echo strtoupper($model->kdKec->Nm_Kec); ?></b></h5>
<br>
<br>
<p style="text-align: justify;">Musrenbang Kecamatan telah dilaksanakan pada :</p>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp;
		<?php  echo $tanggal(date("Y-m-d") , true); ?> 
		</td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;<?php
            echo(date('H.i', $model->Waktu_Mulai) . ' WIB - ' .
            date('H.i', $model->Waktu_Selesai) . ' WIB');
            ?> </td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?php echo ($model->Nama_Tempat . ', ' . $model->Alamat) ?></td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peserta&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;:&nbsp;<?php echo ($model->Jumlah_Peserta); ?> orang<i> (Terlampir)</i> </td> </tr>
</table>
<br>
<p style="text-align: justify;">Materi yang dibahas dalam Musrenbang Kecamatan ini adalah menetapkan usulan-usulan kegiatan Desa atau Kelurahan</p>
<p style="text-align: justify;">Hasil pertemuan ditetapkan menjadi keputusan akhir Musrenbang Kecamatan adalah : </p>

<tr>
    <td><p style="text-align: justify;">Menyepakati usulan-usulan kegiatan dalam rangka menyelesaikan permasalahan yang terjadi untuk diusulkan dalam Musrenbang Kelurahan sebanyak <?php echo $usulan ?> kegiatan (terlampir).</p></td></tr>
<p style="text-align">
    Demikian berita acara ini dibuat dan disahkan untuk digunakan sebagaimana mestinya.
</p>
<br>

<br><br><br><br><br><br>
<p style="text-align: center;">
    Ditetapkan di Kecamatan <?php echo $model->kdKec->Nm_Kec; ?>, <?php echo (date('d', $model->Waktu_Mulai) . ' ' . Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Mulai)) . ' ' . date('Y', $model->Waktu_Mulai)); ?>
</p>
</p>

<table style="text-align: center;width: 100%">
    <tr><td style="width: 50%"> </td><td></tr>

    <tr><td colspan="2" > </td><td></tr>
    <tr><td>Perwakilan Masyarakat</td><td>Kepala Dusun/Lingkungan</td></tr>
    <tr><td style="height: 75px"></td><td></td><td></tr>
    <tr><td>(.............................................)</td><td>(.............................................)</td></tr>
    <tr><td colspan="2" > </td></tr>
    <tr><td colspan="2" > </td></tr>
    <tr><td colspan="2">Mengetahui</td></tr>
    <tr><td colspan="2" > </td><td></tr>
    <tr><td >Kepala Desa/Lurah</td><td>Tim Pendamping</td></tr>
    <tr><td colspan ="2" style="height: 75px"></td></tr>
    <tr><td>(.............................................)</td><td>(.............................................)</td></tr>
    <tr><td>NIP : .............................................</td><td> </td></tr>
</table>

<br><br><br>
<p>Tembusan : </p>
<p>- Bappeda Kabupaten Asahan</p>
<pagebreak />
<?php include "absensi.php" ?>