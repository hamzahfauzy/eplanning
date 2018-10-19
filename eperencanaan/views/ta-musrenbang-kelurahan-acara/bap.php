<?php

use yii\helpers\html;

setlocale(LC_ALL, 'INDONESIA');
?>
<h5 style="text-align: center;"><b>BERITA ACARA<br> HASIL KESEPAKATAN MUSRENBANG RKPD <BR> KABUPATEN ASAHAN <BR> <br>
        
        DI DESA/KELURAHAN <?php echo strtoupper($model->kdKel->Nm_Kel); ?> <BR>KECAMATAN <?php echo strtoupper($model->kdKec->Nm_Kec); ?> TAHUN <?= $Tahun ?></b>  </h5>
<br>
<br>
<p style="text-align: justify;">
  Pada hari   
                <?php //echo(Yii::$app->zultanggal->ZULgethari(date('N', $model->Waktu_Selesai))); ?>
				<?=$tanggal(date("Y-m-d"),true);?>
			
             <?php  //echo(date('j', $model->Waktu_Selesai));?>  
			 
            <?php //echo (Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Selesai))); ?>  
            <?php //echo (date('Y', $model->Waktu_Selesai)); ?> 
bertempat di <?php echo ($model->Nama_Tempat . ', ' . $model->Alamat) ?> Kecamatan  <?php echo ($model->kdKec->Nm_Kec); ?> telah diselenggarakan musrenbang dokumen rencana daerah Kabupaten Asahan yang dihadiri pemangku kepentingan sesuai dengan daftar hadir peserta yang tercantum
dalam LAMPIRAN I berita acara ini. </p>
<p style="text-align: justify;"> Setelah memperhatikan, mendengar dan mempertimbangkan : <br>

    


<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">1. Sambutan-sambutan yang disampaikan oleh : </td> </tr>
	<tr><td>
		<?php if ((substr(trim($model->Sambutan_1),0,2) == '-') or (substr(trim($model->Sambutan_1),0,2) == '')): ?>
		<?php else : ?>
			 <html>&nbsp;&nbsp;&nbsp;&nbsp; - </htm><?php  echo ($model->Sambutan_1); ?>  <br>
		<?php endif; ?>
		<?php if   ((substr(trim($model->Sambutan_2),0,2) == '-') or (substr(trim($model->Sambutan_2),0,2) == '')) : ?>
		<?php else : ?>
			 <html>&nbsp;&nbsp;&nbsp;&nbsp; - </htm> <?php  echo ($model->Sambutan_2); ?>  <br>
		<?php endif; ?>
		<?php if   ((substr(trim($model->Sambutan_3),0,2) == '-') or (substr(trim($model->Sambutan_3),0,2) == '')) : ?>
		<?php else : ?>
			 <html>&nbsp;&nbsp;&nbsp;&nbsp; - </htm> <?php  echo ($model->Sambutan_3); ?>  <br>
		<?php endif; ?>
		<?php if   ((substr(trim($model->Sambutan_4),0,2) == '-') or (substr(trim($model->Sambutan_4),0,2) == '')) : ?>
		<?php else : ?>
			 <html>&nbsp;&nbsp;&nbsp;&nbsp; - </htm> <?php  echo ($model->Sambutan_4); ?>  <br>
		<?php endif; ?>
		<?php if   ((substr(trim($model->Sambutan_5),0,2) == '-') or (substr(trim($model->Sambutan_5),0,2) == '')): ?>
		<?php else : ?>
			 <html>&nbsp;&nbsp;&nbsp;&nbsp; - </htm> <?php  echo ($model->Sambutan_5); ?>  <br>
		<?php endif; ?>
</tr></table>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">2. Pemaparan materi lainnya: </td> </tr>
	<tr><td>
		<?php if  ((substr(trim($model->Pemateri_1),0,2) == '-') or (substr(trim($model->Pemateri_1),0,2) == '')): ?>
		<?php else : ?>
			 <html>&nbsp;&nbsp;&nbsp;&nbsp; - </htm><?php  echo ($model->Pemateri_1); ?>  <br>
		<?php endif; ?>
		<?php if  ((substr(trim($model->Pemateri_2),0,2) == '-') or (substr(trim($model->Pemateri_2),0,2) == '')) : ?>
		<?php else : ?>
			 <html>&nbsp;&nbsp;&nbsp;&nbsp; - </htm> <?php  echo ($model->Pemateri_2); ?>  <br>
		<?php endif; ?>
		<?php if  ((substr(trim($model->Pemateri_3),0,2) == '-') or (substr(trim($model->Pemateri_3),0,2) == '')): ?>
		<?php else : ?>
			 <html>&nbsp;&nbsp;&nbsp;&nbsp; - </htm> <?php  echo ($model->Pemateri_3); ?>  <br>
		<?php endif; ?></tr></table>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">3. </td>
	<td> Tanggapan dan saran dari seluruh peserta musrenbang desa/kelurahan terhadap materi yang dipaparkan oleh masing-masing ketua kelompok diskusi sebagaimana telah dirangkum menjadi hasil keputusan kelompok diskusi musrenbang desa/kelurahan, maka pada:
</td>
</tr></table>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp;
			<?php  echo $tanggal(date("Y-m-d") , true); ?> 
			<!--
<?php echo(Yii::$app->zultanggal->ZULgethari(date('N', $model->Waktu_Selesai))); ?>, 
             <?php  echo(date('j', $model->Waktu_Selesai));?> 
            <?php echo (Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Selesai))); ?> 
            <?php echo (date('Y', $model->Waktu_Selesai)); ?>  -->

			</td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;<?php
			if (date('H.i', $model->Waktu_Mulai) >= date('H:i'))
			{
				echo (date('H:i') . ' WIB') ; }
			else
			{
				
				echo (date('H.i', $model->Waktu_Mulai) . ' WIB - ' .
            //date('H.i', $model->Waktu_Selesai) . ' WIB');
			date('H:i') . ' WIB') ; 
			}
            ?> </td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?php echo ($model->Nama_Tempat . ', ' . $model->Alamat) ?></td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peserta&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;:&nbsp;<?php echo ($model->Jumlah_Peserta); ?> orang<i> (Terlampir)</i> </td> </tr>
 <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Musrenbang Desa/Kelurahan <?php echo ($model->kdKel->Nm_Kel); ?>  Kecamatan  <?php echo ($model->kdKec->Nm_Kec); ?></td> </tr>

</table>
<br>
<p style="text-align: Center;">MENYEPAKATI </p></BR>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">KESATU : </td>
<td>Kegiatan Prioritas, Sasaran, yang disertai target dan kebutuhan pendanaan dalam Daftar Prioritas Desa/Kelurahan  <?php echo ($model->kdKel->Nm_Kel); ?>  Kecamatan  <?php echo ($model->kdKec->Nm_Kec) ; ?> Kabupaten Asahan Tahun <?= $Tahun+1 ?> sebagaimana tercantum dalam LAMPIRAN II berita acara ini.			</td> </tr>
<tr ><td style="padding: 4px">KEDUA : </td>
<td>Usulan program dan kegiatan yang belum dapat diakomodir dalam rancangan dokumen rencana daerah Kabupaten Asahan Tahun <?= $Tahun+1 ?> beserta alasan penolakannya sebagaimana tercantum dalam LAMPIRAN III berita acara ini.</td> </tr>
<tr ><td style="padding: 4px">KETIGA : </td>
<td>Hasil kesepakatan sidang-sidang kelompok Musrenbang Desa/Kelurahan  <?php echo ($model->kdKel->Nm_Kel); ?>  Kecamatan  <?php echo ($model->kdKec->Nm_Kec); ?> Kabupaten Asahan Tahun <?= $Tahun+1 ?> Dan Daftar Hadir Peserta Musrenbang sebagaimana tercantum dalam Lampiran IV merupakan satu kesatuan dan merupakan bagian yang tidak terpisahkan dari berita ini.</td> </tr>
<tr ><td style="padding: 4px">KEEMPAT : </td>
<td>Berita acara ini dijadikan sebagai bahan penyusunan rancangan dokumen rencana daerah Kabupaten Asahan Tahun <?= $Tahun+1 ?>.</td> </tr>
</table>
<p style="text-align: justify;">Demikian berita acara ini dibuat dan disahkan untuk digunakan sebagaimana mestinya.</p>
<br>

<p style="text-align: left;">
<?php echo ($model->kdKel->Nm_Kel); ?>, <?php echo date('d F Y') ;?> <!-- <?php echo (date('d', $model->Waktu_Selesai) . ' ' . Yii::$app->zultanggal->ZULgetbulan(date('n', $model->Waktu_Selesai)) . ' ' . date('Y', $model->Waktu_Selesai)); ?> -->
</p>

<p style="text-align: justify;">
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;Pimpinan Sidang
<br><br><br><br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;<?php echo ($model->Pimpinan_Sidang);?>
</p>
<pagebreak />
<p style="text-align: left;">
   Mewakili peserta Musrenbang Desa/Kelurahan 
</p>

<table style="border: 1px solid black; text-align: center;">
    <tr><td style="width: 50px;border: 1px solid black;">No</td>
        <td style="width: 150px;border: 1px solid black;">Nama</td>
        <td style="width: 80px;border: 1px solid black;">Usia</td>
        <td style="width: 80px;border: 1px solid black;">Jenis Kelamin</td>
        <td style="width: 250px;border: 1px solid black;">Lembaga</td>
        <td style="width: 230px;border: 1px solid black;">Alamat & No Telepon</td>
        <td style="width: 100px;border: 1px solid black;">Tanda Tangan</td> </tr>
<?php
for ($x = 1; $x <= 10; $x++) {
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


<br><br><br>
<p>Berita acara ini disampaikan ke Kecamatan <?php echo ($model->kdKec->Nm_Kec); ?></p>
<p>Tembusan : </p>
<p>- Bappeda Kabupaten Asahan</p>
<pagebreak />
<?php include "absensi.php" ?>
<pagebreak />
<?php include "lampiran_ii.php" ?>