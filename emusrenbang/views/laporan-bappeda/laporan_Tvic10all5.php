<?php
use eperencanaan\models\TaMusrenbang;

use yii\helpers\html;



setlocale(LC_ALL, 'INDONESIA');
?>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
 <tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN I :&nbsp; BERITA ACARA KESEPAKATAN	</td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;MUSRENBANG RKPD KABUPATEN ASAHAN <td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;: <?php echo (@$model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;: <?php echo (@$model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-------------------------------------------------- </td> </tr>

</table>

<h3 style="text-align: center; text-transform: uppercase;">DAFTAR HADIR PESERTA MUSRENBANG RKPD<BR>KABUPATEN ASAHAN <BR> Tahun <?= date('Y')+1 ?></h3>
</h3>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
   <?php if (@$model->Waktu_Mulai!=0){?>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan&ensp;&thinsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:&nbsp;  
<?php 
if ($model->Kd_Kec <=0) :
	
	if ($model->Waktu_Mulai!=0):
		echo @$kecamatan($post['MusrenbangSkpdAcara']['Kd_Kec'])->Nm_Kec;
	endif;
	//print_r($post);
	
else: 
    echo (@$model->kdKec->Nm_Kec); 
endif; 
   }?>

</td> </tr>
<tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Provinsi&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:&nbsp;<?="Sumatera Utara";?>
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
		//echo $hari.", ".$xTgl . " " . $bln ." ". $xThn. "- Rabu, 28 Maret 2018";
		echo "Selasa - Rabu, 27 s/d 28 Maret 2018";
		 ?>
	
	</td> </tr>    
	
            </td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;<?=date("H:i:s");?>
            </td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?php echo "Aula Melati Kantor Bupati Asahan";//(@$model->Nama_Tempat . ', ' . @$model->Alamat) ?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agenda&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Membahas, menetapkan dan menyepakati sasaran dan prioritas pembangunan daerah, serta rencana program dan kegiatan yang disertai ndikator dan target kinerja dan kebutuhan pendanaan dalam rancangan RKPD Kabupaten Asahan Tahun  <?= date('Y')+1 ?>.
           

</table>
<BR>
<table style="border: 1px solid black; text-align: center;">
    <tr><td style="width: 50px;border: 1px solid black;">No</td>
        <td style="width: 150px;border: 1px solid black;">Nama</td>
        <td style="width: 250px;border: 1px solid black;">Lembaga/Instansi</td>
        <td style="width: 230px;border: 1px solid black;">Alamat & No Telepon</td>
        <td style="width: 100px;border: 1px solid black;">Tanda Tangan</td> </tr>
<?php
if (@$model->Jumlah_Peserta==""||@$model->Jumlah_Peserta==0):
	$JP=125;
else:
	$JP=@$model->Jumlah_Peserta;
endif;
	
for ($x = 1; $x <= $JP; $x++) {
    echo '<tr><td style="width: 50px;height: 50px;border: 1px solid black;">' . $x . '</td>
              <td style="width: 150px;border: 1px solid black;"> </td>
  
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
    <tr><td> </td><td style="width: 300px">KEPALA BADAN PERENCANAAN PEMBANGUNAN DAERAH </td><td>
    <tr><td style="height: 75px"></td><td></td><td>
    <tr><td> </td><td>(<?php echo "Drs. H. ZAINAL ARIPIN SINAGA, MH"//(@$model->Nama_Pejabat); ?>)</td><td>

</table>
