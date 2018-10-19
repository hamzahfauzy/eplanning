<?php

use yii\helpers\html;



setlocale(LC_ALL, 'INDONESIA');


?>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
<tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN III :&nbsp; BERITA ACARA KESEPAKATAN  </td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;HASIL MUSRENBANG KECAMATAN<td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;: <?php echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;: <?php echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-------------------------------------------------- </td> </tr>

</table>
<br>
<br>
<p style="text-align: center;">Daftar Kegiatan Yang Belum Di Sepakati</p>
<p style="text-align: center;">Tahun <?php echo date('Y')+1; ?></p>
<BR>
<table border="1" cellpadding="7" width="100%">
    <tr>
		<td>No</td>
        <td style="text-align:center">Kegiatan</td>
        <td style="text-align:center">Lokasi (desa/kel)</td>
        <td style="text-align:center">Volume</td>
        <td style="text-align:center">Pagu</td>
		<td style="text-align:center">OPD</td>
		<td style="text-align:center">Alasan</td>
	</tr>
	<tr>
		<td style="text-align:center">(1)</td>
        <td style="text-align:center">(2)</td>
        <td style="text-align:center">(3)</td>
        <td style="text-align:center">(4)</td>
        <td style="text-align:center">(5)</td>
		<td style="text-align:center">(6)</td>
		<td style="text-align:center">(7)</td>
	</tr>
	<?php
	$no=1;
	foreach($usulan_tolak as $rows){
	?>
	<tr>
		<td><?php echo $no;$no++;?></td>
        <td>
		<b>Permasalahan :</b><br>
		<?=$rows->Nm_Permasalahan;?>
		<br>
		<b>Usulan :</b><br>
		<?=$rows->Jenis_Usulan;?>
		</td>
			<td>
		<?php
		if(empty($rows->kdJalan->Nm_Jalan)||($rows->kdJalan->Nm_Jalan=="-"))
		{
			
			echo @$rows->kelurahan->Nm_Kel.", ".@$rows->lingkungan->Nm_Lingkungan; 
		}
		else
		{
			echo @$rows->kdJalan->Nm_Jalan.", ".@$rows->kelurahan->Nm_Kel.", ".@$rows->lingkungan->Nm_Lingkungan;
		}
		
		//echo $rows->kdJalan->Nm_Jalan.", ".$rows->kelurahan->Nm_Kel.", ".$rows->lingkungan->Nm_Lingkungan;
		?>
		</td>
        <td>
		<?=$rows->Jumlah;?> <?=$rows->satuan->Uraian;?>
		</td>
        <td>
		<?=number_format($rows->Harga_Total,'0',',','.');?>
		</td>
		<td>
		<?=@$rows->refSubUnit->Nm_Sub_Unit;?>
		</td>
		<td>
		<?=$rows->Alasan_Kecamatan;?>
		</td>
	</tr>
	<?php } ?>
</table>
