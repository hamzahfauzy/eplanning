<?php

use yii\helpers\html;



setlocale(LC_ALL, 'INDONESIA');
?>
<?php $now = getdate(); 
      
?>
<h3 style="text-align: center;">LAPORAN POKIR<br>MUSRENBANG KECAMATAN<br>KABUPATEN ASAHAN <?=$now['year']?></h3>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
  <tr>
      <td style="width: 20%;border: 1px solid black;padding: 10px 10px 10px 18px">Nama
      </td>
      <td style="border: 1px solid black;padding: 10px 10px 10px 18px">: <?=$dataUser->nama_lengkap?> 
      </td>
  </tr>
  <tr>
      <td style="width: 20%;border: 1px solid black;padding: 10px 10px 10px 18px">Email
      </td>
      <td style="border: 1px solid black;padding: 10px 10px 10px 18px">: <?=$dataUser->email?> 
      </td>
  </tr>
  <tr>
      <td style="width: 20%;border: 1px solid black;padding: 10px 10px 10px 18px">Hari/Tanggal
      </td>
      <td style="border: 1px solid black;padding: 10px 10px 10px 18px">: <?=date('l / d-F-Y')?> 
      </td>
  </tr>
  <tr>
      <td style="width: 20%;border: 1px solid black;padding: 10px 10px 10px 18px">Waktu
      </td>
      <td style="border: 1px solid black;padding: 10px 10px 10px 18px">: <?=date('H:i:s')?> 
      </td>
  </tr>


</table>
<BR>
<table style="width:100%; border: 1px solid black; text-align: center;">
    <tr>
      <th style="border: 1px solid black;padding: 10px 10px 10px 10px">No </th>
      <th style="border: 1px solid black;padding: 10px 10px 10px 10px">Kegiatan Prioritas </th>
      <th style="border: 1px solid black;padding: 10px 10px 10px 10px">Prioritas Kota </th>
      <th style="border: 1px solid black;padding: 10px 10px 10px 10px">Jumlah/Vol </th>
      <th style="border: 1px solid black;padding: 10px 10px 10px 10px">Pagu(Rp)</th>
      <th style="border: 1px solid black;padding: 10px 10px 10px 10px">OPD Penanggung Jawab</th>
      <th style="border: 1px solid black;padding: 10px 10px 10px 10px">Kode Pembangunan</th>
    </tr>
    <?php
       $no=0;
      foreach ($data as $value): 
        
        $no++;
      ?>
        <tr>
            <td style="border: 1px solid black;padding: 10px 10px 10px 10px"><?= $no ?></td>
            <td style="border: 1px solid black;padding: 10px 10px 10px 10px"><?= $value->Nm_Permasalahan ?></td>
            <td style="border: 1px solid black;padding: 10px 10px 10px 10px"><?= $value->Jenis_Usulan ?></td>
            <td style="border: 1px solid black;padding: 10px 10px 10px 10px"><?= $value->Jumlah ?></td>
            <td style="border: 1px solid black;padding: 10px 10px 10px 10px"><?= number_format($value->Harga_Total,0,'.','.') ?></td>
            <td style="border: 1px solid black;padding: 10px 10px 10px 10px"><?= ($value->Kd_Sub) ? $value->subUnit->kdSubUnit->Nm_Sub_Unit : '-' ?></td>
            <td style="border: 1px solid black;padding: 10px 10px 10px 10px"><?= $value->Kd_Pem ?></td>
            <!-- <td><?php if($isi = $value->Rincian_Skor) print_r(unserialize($value->Rincian_Skor))  ?></td> -->
        </tr>
<?php endforeach;

?>
</table>
<br>
<br>
<table style="text-align: center;">
    <tr><td style="width: 400px"> </td><td>Mengetahui</td>
    <tr><td> </td><td style="width: 200px"><?=$dataUser->nama_lengkap?></td><td>
    <tr><td style="height: 75px"></td><td></td><td>
    <tr><td> </td><td>(.............................................)</td><td>

</table>
