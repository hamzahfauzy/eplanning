<?php

use yii\helpers\html;

setlocale(LC_ALL, 'INDONESIA');
?>
<h5 style="text-align: center;"><b>BERITA ACARA FORUM OPD TAHUN 2017<br>
<br>
<br>
<p style="text-align: justify;">Forum OPD telah dilaksanakan pada :</p>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp;<?php
            echo(Yii::$app->zultanggal->ZULgethari(date('N', $model->Waktu_Mulai)) . ', ' .
            date('j', $model->Waktu_Mulai) . ' ' .
            Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Mulai)) . ' ' .
            date('Y', $model->Waktu_Mulai) . ' - ');
            echo(Yii::$app->zultanggal->ZULgethari(date('N', $model->Waktu_Selesai)) . ', ' .
            date('j', $model->Waktu_Selesai) . ' ' .
            Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Selesai)) . ' ' .
            date('Y', $model->Waktu_Selesai));
            ?> </td> </tr>
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
<p style="text-align: justify;">Materi yang dibahas dalam Forum OPD ini adalah menetapkan usulan-usulan kegiatan Kecamatan dan Pokir.</p>
<p style="text-align: justify;">Hasil pertemuan ditetapkan menjadi keputusan akhir Forum OPD adalah : </p>

<tr>
    <td><p style="text-align: justify;">Menyepakati usulan-usulan kegiatan dalam rangka menyelesaikan permasalahan yang terjadi untuk diusulkan dalam Musrenbang Kecamatan sebanyak <?php echo $usulan ?> kegiatan (terlampir).</p></td></tr>
<p style="text-align">
    Demikian berita acara ini dibuat dan disahkan untuk digunakan sebagaimana mestinya.
</p>
<br>

<br><br><br><br><br><br>
<p style="text-align: center;">
    Ditetapkan di Asahan, <?php echo (date('d', $model->Waktu_Mulai) . ' ' . Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Mulai)) . ' ' . date('Y', $model->Waktu_Mulai)); ?>
</p>
</p>

<table style="text-align: center;width: 100%">
    <tr><td style="width: 50%"> </td><td></tr>

    <tr><td colspan="2" > </td><td></tr>
    <tr><td>Pimpinan</td><td>Kepala Dinas</td></tr>
    <tr><td style="height: 75px"></td><td></td><td></tr>
    <tr><td>(.............................................)</td><td>(.............................................)</td></tr>
    <tr><td colspan="2" > </td></tr>
    <tr><td colspan="2" > </td></tr>
    <tr><td colspan="2">Mengetahui</td></tr>
    <tr><td colspan="2" > </td><td></tr>
    <tr><td ></td><td>Tim Pendamping</td></tr>
    <tr><td colspan ="2" style="height: 75px"></td></tr>
    <tr><td>(.............................................)</td><td>(.............................................)</td></tr>
    <tr><td>NIP : .............................................</td><td> </td></tr>
</table>

<br><br><br>
<p>Berita acara ini disampaikan ke Kelurahan</p>
<p>Tembusan : </p>
<p>- Bupati</p>
<pagebreak />
<?php include "absensi.php" ?>