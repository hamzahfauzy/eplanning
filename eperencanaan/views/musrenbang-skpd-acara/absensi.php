<?php

use yii\helpers\html;



setlocale(LC_ALL, 'INDONESIA');
?>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
 <tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN I :&nbsp; BERITA ACARA KESEPAKATAN	</td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;HASIL FORUM PERANGKAT DAERAH <td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;: <?php echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;: <?php echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-------------------------------------------------- </td> </tr>

</table>

<h3 style="text-align: center; text-transform: uppercase;">Daftar Hadir <!--<?php echo $stat ?> --><br>Forum Perangkat Daerah  <?php echo ($model->sub1->Nm_Sub_Unit); ?> <BR><?= $Nm_Pemda?> Tahun <?= $Tahun ?>
</h3>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
   <?php if (false){ //$model->Waktu_Mulai!=0 ){ ?>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan&ensp;&thinsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&nbsp;  
<?php 
if ($model->Kd_Kec <=0) :
	
	if ($model->Waktu_Mulai!=0):
		echo $kecamatan($post['MusrenbangSkpdAcara']['Kd_Kec'])->Nm_Kec;
		// print_r($post['MusrenbangSkpdAcara']['Kd_Kec']);
	endif;
	//print_r($post);
	
else: 
    echo ($model->kdKec->Nm_Kec); 
endif; 
   }?>

</td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp;
	<?php $hr=date('D');$xTgl=date("d");$xBln=date("m");$xThn=date("Y");
		  if ($xBln==1):
			 $bln="Januari";
		  elseif ($xBln==2):
			$bln="Februari"; 
		elseif ($xBln==3):
			$bln="Maret";
		elseif ($xBln==4):
			$bln="April";
		elseif ($xBln==5):
			$bln="Mei";
		elseif ($xBln==6):
			$bln="Juni";
		elseif ($xBln==7):
			$bln="Juli";
		elseif ($xBln==8):
			$bln="Agustus";
		elseif ($xBln==9):
			$bln="September";
		elseif ($xBln==10):
			$bln="Oktober";
		elseif ($xBln==11):
			$bln="November";
		elseif ($xBln==12):
			$bln="Desember";
		endif;
		if ($hr=="Sun"):
			$hari="Minggu";
		elseif ($hr=="Mon"):
			$hari="Senin";
		elseif ($hr=="Tue"):
			$hari="Selasa";
		elseif ($hr=="Wed"):
			$hari="Rabu";
		elseif ($hr=="Thu"):
			$hari="Kamis";
		elseif ($hr=="Fri"):
			$hari="Jumat";
		elseif ($hr=="Sat"):
			$hari="Sabtu";
		endif;
		echo $hari.", ".$xTgl . " " . $bln ." ". $xThn;
		 ?>
	
	<!-- <?php echo(Yii::$app->zultanggal->ZULgethari(date('N', $model->Waktu_Selesai))); ?>, 
             <?php    echo(   date('j', $model->Waktu_Selesai) . ' ' .
            Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Selesai)) . ' ' .
            date('Y', $model->Waktu_Selesai)); ?> --></td> </tr>    
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;<?=date("H:i:s");?>
            </td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?php echo ($model->Nama_Tempat . ', ' . $model->Alamat) ?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agenda&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Membahas, menetapkan dan menyepakati bidang pembangunan masalah, usulan kegiatan, volume
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&thinsp;&thinsp;&thinsp;dan alamat lokasi untuk mengatasi permasalahan sesuai kebutuhan di wilayahnya, utamanya
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&thinsp;&thinsp;&thinsp;untuk mendukung prioritas pembangunan kabupaten.
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
if ($model->Jumlah_Peserta==""||$model->Jumlah_Peserta==0):
	$JP=125;
else:
	$JP=$model->Jumlah_Peserta;
endif;
	
for ($x = 1; $x <= $JP; $x++) {
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
    <tr><td> </td><td style="width: 200px">Kepala <?php echo $model->sub1->Nm_Sub_Unit ;?> </td><td>
    <tr><td style="height: 75px"></td><td></td><td>
    <tr><td> </td><td>(<?php echo ($model->Nama_Pejabat); ?>)</td><td>

</table>
