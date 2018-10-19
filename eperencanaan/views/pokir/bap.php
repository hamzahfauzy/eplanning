<?php

use yii\helpers\html;

setlocale(LC_ALL, 'INDONESIA');
$tanggal = date('Y-m-d');
$day = date('D', strtotime($tanggal));
$bulan=date('m', strtotime($tanggal));
$dayList = array(
	'Sun' => 'Minggu',
	'Mon' => 'Senin',
	'Tue' => 'Selasa',
	'Wed' => 'Rabu',
	'Thu' => 'Kamis',
	'Fri' => 'Jumat',
	'Sat' => 'Sabtu'
);
$bulanList = array(
	'01' => 'Januari',
	'02' => 'Pebruari',
	'03' => 'Maret',
	'04' => 'April',
	'05' => 'Mei',
	'06' => 'Juni',
	'07' => 'Juli',
	'08' => 'Agustus',
	'09' => 'September',
	'10' => 'Oktober',
	'11' => 'Nopember',
	'12' => 'Desember'
);
$Sekarang=$dayList[$day].", ". date('d')." ". $bulanList[$bulan]." ". date('Y');
foreach ($data as $row):
$j_peserta=$row['Jumlah_Peserta'];
$JP=$row->Jumlah_Peserta;
$Tempat=$row->Nama_Tempat;
$NBA=$row->Nomor_BA;
$TBA=$row->Tanggal_BA;
endforeach;
?>
<h3 style="text-align: center; text-transform: uppercase;">
    BERITA ACARA POKIR <br> <?= $Nm_Pemda." Tahun ".$Tahun ?>
</h3>
<h5 style="text-align: center; text-transform: uppercase;">
    NOMOR 	&emsp;&emsp;&nbsp;&nbsp;: <?= $NBA?> <BR>
	TANGGAL &emsp;&nbsp;&nbsp;: <?= $TBA ?>
	
</h5>
<br>
<br> 

<p style="text-align: justify;">Pokir telah dilaksanakan pada :</p>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:&nbsp;  <?=$Sekarang;?></td> </tr>
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;:&nbsp;  <?=date("H:i:s");?></td> </tr>
    <tr >
        <!--<td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp; <?=$Tempat;?> </td> </tr> -->
    <tr >
        <td style="padding: 4px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peserta&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;&thinsp;:&nbsp;  <?=$JP;?> orang<i> (Terlampir)</i> </td> </tr>
		
</table>
<br>
<p style="text-align: justify;">Materi yang dibahas dalam Pokir ini adalah menetapkan usulan-usulan kegiatan anggota dewan.</p> 
<p style="text-align: justify;">Hasil pertemuan ditetapkan menjadi keputusan akhir Pokir adalah : </p>

<tr>
    <td><p style="text-align: justify;">Menyepakati usulan-usulan kegiatan dalam rangka menyelesaikan permasalahan yang terjadi untuk diusulkan dalam Pokir sebanyak <?php echo $usulan ?> kegiatan (terlampir).</p></td></tr>
<p style="text-align">
    Demikian berita acara ini dibuat dan disahkan untuk digunakan sebagaimana mestinya.
</p>
<br>

<br><br><br><br><br><br>
<p style="text-align: center;">
    Ditetapkan di Kisaran, 
</p>
</p>

<table style="text-align: center;width: 100%">
    <tr><td style="width: 50%"> </td><td></tr>

    <tr><td colspan="2" > </td><td></tr>
    <tr><td>Perwakilan Anggota Dewan</td></tr>
    <tr><td style="height: 75px"></td><td></td><td></tr>
    <tr><td>(.............................................)</td></tr>
    <tr><td colspan="2" > </td></tr>
    <tr><td colspan="2" > </td></tr>
    <tr><td colspan="2">Mengetahui</td></tr>
    <tr><td colspan="2" > </td><td></tr>
    <tr><td >Sekretariat Dewan</td></tr>
    <tr><td colspan ="2" style="height: 75px"></td></tr>
    <tr><td>(.............................................)</td></tr>
    <tr><td>NIP : .............................................</td><td> </td></tr>
</table>

<br><br><br>
<!-- <p>Berita acara ini disampaikan ke Kelurahan</p>
<p>Tembusan : </p>
<p>- Kecamatan <?php //echo ($model->kdKec->Nm_Kec); ?></p> -->
<pagebreak />
<?php include "absensi.php" ?>