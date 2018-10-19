<?php

use yii\helpers\html;

setlocale(LC_ALL, 'INDONESIA');
?>
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
		
		 ?>

<h5 style="text-align: center;"><b>BERITA ACARA<br> KESEPAKATAN HASIL FORUM PERANGKAT DAERAH <?php echo strtoupper ($model->sub1->Nm_Sub_Unit); ?> <BR> KABUPATEN ASAHAN TAHUN <?= $Tahun ?></b>  </h5>
<br>
<br>
<p style="text-align: justify;">Pada hari  

		<?php if ((substr(trim($model->Jadwal_Forum),0,2) == '-') or (substr(trim($model->Jadwal_Forum),0,2) == '')): ?>
			<!--<?php echo(Yii::$app->zultanggal->ZULgethari(date('N', $model->Waktu_Mulai))); ?>-->
				<?php echo $hari;?> tanggal
             		<!--<?php  echo(date('j', $model->Waktu_Mulai));?>--> <?=$xTgl;?> bulan 
            		<!--<?php echo (Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Mulai))); ?> -->  <?=$bln;?> tahun 
           		 <?php echo (date('Y', $model->Waktu_Mulai)); ?> 
					<?php if ($model->Waktu_Selesai!=0): ?>
						sampai dengan
                	<?php echo(Yii::$app->zultanggal->ZULgethari(date('N', $model->Waktu_Selesai))); ?> tanggal
            		 <?php  echo(date('j', $model->Waktu_Selesai));?> bulan 
            		<?php echo (Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Selesai))); ?> tahun 
           		 <?php echo (date('Y', $model->Waktu_Selesai)); ?>
				 <?php endif; ?>
		<?php else : ?>
			 <?php echo ($model->Jadwal_Forum);?>
		<?php endif; ?>


            bertempat di <?php echo $model->Alamat; ?> telah diselenggarakan Forum Perangkat Daerah   <?php echo ($model->sub1->Nm_Sub_Unit); ?> Kabupaten Asahan yang dihadiri pemangku kepentingan sesuai dengan daftar hadir peserta yang tercantum
dalam LAMPIRAN I berita acara ini. </p>
<p style="text-align: justify;"> Setelah memperhatikan, mendengar dan mempertimbangkan : <br>

    


<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">1. Materi dari <?php echo ($model->sub1->Nm_Sub_Unit); ?>.</td> </tr>
	</table>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">2. Tanggapan dan saran dari seluruh peserta Forum Perangkat Daerah Kabupaten terhadap materi yang dipaparkan oleh masing-masing ketua kelompok diskusi sebagaimana telah dirangkum menjadi hasil keputusan kelompok diskusi, maka pada: </td> </tr>
</table>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp;
<?php echo $hari.", ".$xTgl . " " . $bln ." ". $xThn;?>	

	<!--		
		<?php echo(Yii::$app->zultanggal->ZULgethari(date('N', $model->Waktu_Selesai))); ?>, 
             <?php    echo(   date('j', $model->Waktu_Selesai) . ' ' .
            Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Selesai)) . ' ' .
            date('Y', $model->Waktu_Selesai)); ?> -->
			</td> </tr>


    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;<?php
           // echo(date('H.i', $model->Waktu_Selesai) . ' WIB');
		   echo date('H.i') . ' WIB';
            ?> </td> </tr>

    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?php echo ($model->Nama_Tempat . ', ' . $model->Alamat) ?></td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peserta&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;:&nbsp;<?php echo ($model->Jumlah_Peserta); ?> orang<i> (Terlampir)</i> </td> </tr>
 <!--
 <tr>

        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forum Perangkat Daerah  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp; <tr>
        <td>Forum Perangkat Daerah <?php echo ($model->sub1->Nm_Sub_Unit); ?> Kabupaten Asahan Tahun <?= $Tahun+1 ?>.</td></tr>
-->
</table>

<br>
<p style="text-align: justify;">Forum Perangkat Daerah <?php echo ($model->sub1->Nm_Sub_Unit); ?> Kabupaten Asahan Tahun <?= $Tahun ?>. </p>
<br>
<p style="text-align: Center;">MENYEPAKATI </p></BR>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">KESATU : </td>
<td>Program dan kegiatan prioritas,dan indikator kinerja yang disertai target dan kebutuhan pendanaan, yang telah diselaraskan dengan usulan kegiatan prioritas dari forum Perangkat Daerah Kabupaten;</td>
</tr> 
<tr ><td style="padding: 4px">KEDUA : </td>
<td>Rancangan Renja Perangkat Daerah <?php echo ($model->sub1->Nm_Sub_Unit); ?> Kabupaten Asahan Tahun <?= $Tahun+1 ?> sebagaimana tercantum dalam LAMPIRAN II berita acara ini;</td> </tr>
<tr ><td style="padding: 4px">KETIGA : </td>
<td>Daftar Usulan program dan kegiatan lintas Perangkat Daerah dan lintas wilayah sebagaimana tercantum dalam LAMPIRAN III berita acara ini;
<!--  Hasil kesepakatan Forum Perangkat Daerah 
Kabupaten Asahan Tahun <?= $Tahun+1 ?> Dan Daftar Hadir Peserta Musrenbang sebagaimana tercantum dalam Lampiran IV merupakan satu kesatuan dan merupakan bagian yang tidak terpisahkan dari berita ini. --></td> </tr>
<tr ><td style="padding: 4px">KEEMPAT : </td>
<td>Berita acara ini beserta lampirannya merupakan satu kesatuan dan bagian yang tidak terpisahkan dari berita acara hasil kesepakatan forum Perangkat Daerah/Lintas Perangkat Daerah  <?php echo ($model->sub1->Nm_Sub_Unit); ?> Kabupaten Asahan ini; dan </td> </tr>
<tr ><td style="padding: 4px">KELIMA : </td>
<td>Berita acara ini beserta lampirannya dijadikan sebagai bahan penyempurnaan rancangan RKPD Kabupaten Asahan Tahun <?= $Tahun +1 ?>. </td> </tr>
</table>

<p style="text-align: justify;">Demikian berita acara ini dibuat dan disahkan untuk digunakan sebagaimana mestinya.</p>
<br>
<!--
<p style="text-align: left;">

 Kisaran,  <?php    echo(   date('j', $model->Waktu_Selesai) . ' ' .
            Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Selesai)) . ' ' .
            date('Y', $model->Waktu_Selesai)); ?>
</p>
-->
<p style="text-align: left;">

 Kisaran,  <?php echo date('d F Y') ;?> 
</p>
<p style="text-align: justify;">
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;Pimpinan Sidang
<br><br><br><br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;<?php echo ($model->Pimpinan_Sidang);?></p>
<br><br>
<pagebreak />
<p style="text-align: left;">
   Mewakili Peserta Forum Perangkat Daerah Kabupaten <!--<?php echo ($model->sub1->Nm_Sub_Unit); ?> -->
</p>

<table style="border: 1px solid black; text-align: center;">
    <tr><td style="width: 50px;border: 1px solid black;">No</td>
        <td style="width: 150px;border: 1px solid black;">Nama</td>
 <!--       <td style="width: 80px;border: 1px solid black;">Usia</td>
        <td style="width: 80px;border: 1px solid black;">Jenis Kelamin</td> -->
        <td style="width: 250px;border: 1px solid black;">Unsur Perwakilan</td>
        <td style="width: 230px;border: 1px solid black;">Alamat & No Telepon</td>
        <td style="width: 100px;border: 1px solid black;">Tanda Tangan</td> </tr>
<?php
for ($x = 1; $x <= 10; $x++) {
    echo '<tr><td style="width: 50px;height: 50px;border: 1px solid black;">' . $x . '</td>
              <td style="width: 150px;border: 1px solid black;"> </td>
              <td style="width: 250px;border: 1px solid black;"> </td>
              <td style="width: 230px;border: 1px solid black;"> </td>
              <td style="width: 100px;border: 1px solid black;"> </td> </tr>';
}
?>
</table>
<!--
             <td style="width: 50px;border: 1px solid black;"> </td>
              <td style="width: 80px;border: 1px solid black;"> </td> -->
 
<br><br><br>
<p>Berita acara ini disampaikan ke Bappeda Kabupaten Asahan</p>
<p>Tembusan : </p>
<p>- Bupati Asahan</p>
<pagebreak />
<?php include "absensi.php" ?>
<pagebreak />
<?php include "lampiran_ii.php" ?>
<pagebreak />
<?php include "lampiran_iii.php" ?>
<pagebreak />
<?php include "lampiran_iv.php" ?>