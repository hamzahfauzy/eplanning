<?php

use yii\helpers\html;



setlocale(LC_ALL, 'INDONESIA');
?>
<h3 style="text-align: center; text-transform: uppercase;">DAFTAR HADIR RESES<br><?= $Nm_Pemda." Tahun ".$Tahun ?></h3>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Masa Reses&ensp;&thinsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&nbsp;
    <?php if(isset($model->Masa_Reses))
          $reses = $model->Masa_Reses;
          else
          $reses = '';
    echo $reses;
     ?>
    </td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp; </td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;
            </td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?php ?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agenda&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Membahas, menetapkan dan menyepakati bidang pembangunan masalah, usulan kegiatan, 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&thinsp;&thinsp;&thinsp;&nbsp; volume dan alamat lokasi untuk mengatasi permasalahan sesuai kebutuhan di wilayahnya,
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&thinsp;&thinsp;&thinsp;&nbsp; utamanya untuk mendukung prioritas pembangunan kabupaten.
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
for ($x = 1; $x <= 60; $x++) {
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
    <tr><td> </td><td style="width: 200px">Anggota Dewan</td><td>
    <tr><td style="height: 75px"></td><td></td><td>
    <tr><td> </td><td>(.............................................)</td><td>

</table>
