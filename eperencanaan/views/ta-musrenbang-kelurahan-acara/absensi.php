<?php

use yii\helpers\html;



setlocale(LC_ALL, 'INDONESIA');
$Nm_Pemda = Yii::$app->pengaturan->Kolom('Nm_Pemda');
?>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
 <tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN I :&nbsp; BERITA ACARA KESEPAKATAN  </td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;HASIL MUSRENBANG DESA/KELURAHAN <td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;: <?php echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;: <?php echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-------------------------------------------------- </td> </tr>

</table>


<h3 style="text-align: center; text-transform: uppercase;">DAFTAR HADIR <!-- <?php echo $stat ?> -->MUSRENBANG DESA/KELURAHAN<br><?= $Nm_Pemda ?> <?= $Tahun ?></h3>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desa/Kelurahan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&nbsp;<?php echo $model->kdKel->Nm_Kel; ?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan&ensp;&thinsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&nbsp;<?php echo $model->kdKec->Nm_Kec; ?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp; <?=$tanggal(date("Y-m-d"),true);?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;<?=date("H:i:s");?>
	
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?php echo ($model->Nama_Tempat . ', ' . $model->Alamat) ?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agenda&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Membahas, menetapkan dan menyepakati bidang pembangunan masalah, usulan kegiatan, volume
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&thinsp;&thinsp;&thinsp;dan alamat lokasi untuk mengatasi permasalahan sesuai kebutuhan di wilayahnya, utamanya
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&thinsp;&thinsp;&thinsp;untuk mendukung prioritas pembangunan daerah.
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Memasukkan usulan kegiatan yang telah disepakati ke dalam sistem e-Planning.</td> </tr>


</table>
<BR>
<table style="border: 1px solid black; text-align: center;">
    <tr><td style="width: 50px;border: 1px solid black;">No</td>
        <td style="width: 150px;border: 1px solid black;">Nama</td>
        <td style="width: 80px;border: 1px solid black;">Usia</td>
        <td style="width: 80px;border: 1px solid black;">Jenis Kelamin</td>
        <td style="width: 250px;border: 1px solid black;">Lembaga</td>
        <td style="width: 230px;border: 1px solid black;">Alamat & No Telepon</td>
        <td style="width: 100px;border: 1px solid black;">Tanda Tangan</td> </tr>
<?php
$jumlah = ($model->Jumlah_Peserta==0) ? 50 : $model->Jumlah_Peserta;
for ($x = 1; $x <= $jumlah; $x++) {
    echo '<tr><td style="width: 50px;height: 50px;border: 1px solid black;">' . $x . '</td>
              <td style="width: 150px;border: 1px solid black;"> </td>
              <td style="width: 50px;border: 1px solid black;"> </td>
              <td style="width: 80px;border: 1px solid black;"> </td>
              <td style="width: 250px;border: 1px solid black;"> </td>
              <td style="width: 230px;border: 1px solid black;"> </td>
              <td style="width: 100px;border: 1px solid black;"> </td> </tr>';
}
?>
</table>
<br>
<br>
<table style="text-align: center;">
    <tr><td style="width: 400px"> </td><td>Mengetahui</td>
    <tr><td> </td><td style="width: 200px">Kepala Desa/Lurah <?php echo $model->kdKel->Nm_Kel; ?></td><td>
    <tr><td style="height: 75px"></td><td></td><td>
    <tr><td> </td><td>(<?php echo ($model->Nama_Pejabat) ;?>)</td><td>

</table>
