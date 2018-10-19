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

<h5 style="text-align: center;"><b>BERITA ACARA<br> HASIL KESEPAKATAN MUSRENBANG RKPD  <BR> KABUPATEN ASAHAN TAHUN <?= $tahun ?></b>  </h5>
<br>

<p style="text-align: justify;">Pada hari Selasa sampai dengan Rabu Tanggal 27 sampai dengan 28 bulan Maret tahun dua ribu delapan belas,

           bertempat di Aula Melati Kantor Bupati Asahan <?php //echo @$model->Alamat; ?> telah diselenggarakan Musrenbang RKPD Kabupaten Asahan yang dihadiri pemangku kepentingan sesuai dengan daftar hadir peserta yang tercantum
dalam Lampiran I berita acara ini. </p>
<p style="text-align: justify;"> Setelah memperhatikan, mendengar dan mempertimbangkan : <br>
  


<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">1. Sambutan-sambutan yang disampaikan oleh : <br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Gubernur Sumatera Utara diwakili Kepala Dinas Provinsi Sumatera Utara (H. Rajali, S.Sos, M.SP)<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Wakil Bupati Asahan (H. Surya, B.Sc)</td> </tr>
	</table>
	<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">2. Pemaparan materi: 
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Tim Pemantau dan Pengamanan Pembangunan dan Pemerintah Daerah (Elon Unedo P. Pasaribu, SH)<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Bappeda Provinsi Sumatera Utara (Hasmirizal Lubis, P.Hd)<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Dinas Pendidikan Provinsi Sumatera Utara (Dr. H. M. Joharis Lubis, MM, M.Pd)
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Dinas Bina Marga dan Bina Konstruksi Provinsi Sumatera Utara (Ahmad Satibi Simangunsong, ST, M.Si)
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Dinas Tanaman Pangan dan Hortikultura (Dr. Ir. Bahrul Jamil, M.Si)
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Kepala Bappeda Kabupaten Asahan (Drs. H. Zainal Aripin Sinaga, MH)
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Kepala Dinas PUPR Kabupaten Asahan (T. Adi Huzaifah, S.Sos)
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Kepala Dinas Kesehatan Kabupaten Asahan (dr. Aris Yudariansah, MM)
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Kepala Dinas Pendidikan Kabupaten Asahan (Asmunan, S.Pd)
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Kepala Dinas Pertanian Kabupaten Asahan (Ir. Hazairin, MM)
	</td> 
	</tr>
</table>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">3. Tanggapan dan saran dari seluruh peserta Musrenbang RKPD terhadap materi yang dipaparkan oleh masing-masing ketua kelompok diskusi sebagaimana telah dirangkum menjadi hasil keputusan kelompok diskusi Musrenbang RKPD, maka pada: </td> </tr>
</table>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp;
<?php echo "Rabu, 28 Maret 2018"//$hari.", ".$xTgl . " " . $bln ." ". $xThn;?>	

	<!--		
		<?php //echo(Yii::$app->zultanggal->ZULgethari(date('N', @$model->Waktu_Selesai))); ?>, 
             <?php   // echo(   date('j', @$model->Waktu_Selesai) . ' ' .
          //  Yii::$app->zultanggal->ZULgetbulan(date('n', @$model->Waktu_Selesai)) . ' ' .
          //  date('Y', @$model->Waktu_Selesai)); ?> -->
			</td> </tr>


    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;<?php
           // echo(date('H.i', @$model->Waktu_Selesai) . ' WIB');
		   //echo date('H.i') . ' WIB s/d Selesai';
		   echo "13.00 WIB";//s/d Selesai";
            ?> </td> </tr>

    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?php echo "Aula Melati Kantor Bupati Asahan";//(@$model->Nama_Tempat . ', ' . @$model->Alamat) ?></td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peserta&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;:&nbsp;<?php echo "Hari I : 270 Orang; Hari II: 170";//(@$model->Jumlah_Peserta); ?> orang<i> (Terlampir)</i> </td> </tr>
 <!--
 <tr>

        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forum Perangkat Daerah  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp; <tr>
        <td>Forum Perangkat Daerah <?php echo (@@$model->sub1->Nm_Sub_Unit); ?> Kabupaten Asahan Tahun <?= $tahun ?>.</td></tr>
-->
</table>

<br>
<p style="text-align: justify;">seluruh peserta Musrenbang RKPD Kabupaten Asahan Tahun <?= $tahun ?>. </p>
<br>
<p style="text-align: Center;">MENYEPAKATI </p></BR>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">KESATU : </td>
<td>Sasaran dan prioritas pembangunan daerah, serta rencana program dan kegiatan yang disertai indikator dan target kinerja dan kebutuhan pendanan dalam rancangan RKPD Kabupaten Asahan Tahun <?= $tahun ?> sebagaimana tercantum dalam Lampiran II dan Lampiran III berita acara ini;</td>
</tr> 
<tr ><td style="padding: 4px">KEDUA : </td>
<td>Program dan kegiatan yang belum diakomodir dalam rancangan RKPD Kabupaten Asahan Tahun <?= $tahun ?> beserta alasannya sebagaimana tercantum dalam Lampiran IV berita acara ini;</td> </tr>
<tr ><td style="padding: 4px">KETIGA : </td>
<td>Rumusan yang tercantum dalam lampiran yang merupakan bagian yang tidak terpisahkan dari hasil kesepakatan Musrenbang RKPD Kabupaten Asahan Tahun <?= $tahun ?>  untuk dijadikan sebagai bahan penyusunan rancangan akhir RKPD Kabupaten Asahan Tahun <?= $tahun ?>;</td> </tr>

</table>

<p style="text-align: justify;">Demikian berita acara ini dibuat dan disahkan untuk digunakan sebagaimana mestinya.</p>
<br>
<!--
<p style="text-align: left;">

 Kisaran,  <?php    echo(   date('j', @$model->Waktu_Selesai) . ' ' .
            Yii::$app->zultanggal->ZULgetbulan(date('n', @$model->Waktu_Selesai)) . ' ' .
            date('Y', @$model->Waktu_Selesai)); ?>
</p>
-->
<p style="text-align: left;">

 Kisaran,  <?php echo "28 Maret 2018";//date('d F Y') ;?> 
</p>
<p style="text-align: justify;">
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;Wakil Bupati Asahan 
<br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;Selaku Pimpinan Sidang Musrenbang RKPD
<br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;Kabupaten Asahan Tahun <?= $tahun ?>
<br><br><br><br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;<?php echo "H. SURYA, B.Sc"; //(@$model->Pimpinan_Sidang);?></p>
<br><br>
<pagebreak />
<p style="text-align: left;">
   Mewakili peserta musrenbang RKPD Kabupaten Asahan Tahun  <?= $tahun ?> <!--<?php echo (@$model->sub1->Nm_Sub_Unit); ?> -->
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
              <td style="width: 80px;border: 1px solid black;"> </td> 
 
<br><br><br>
<p>Berita acara ini disampaikan ke Bappeda Kabupaten Asahan</p>
<p>Tembusan : </p>
<p>- Bupati Asahan</p> -->
<pagebreak />
<?php // include "laporan_Tvic10all5.php" ?>
<pagebreak />
<?php //include "laporan_Tvic10all3.php" ?>
<pagebreak />
<?php //include "laporan_Tvic10all2.php" ?>
<pagebreak />
<?php //include "laporan_Tvic10all4.php" ?>