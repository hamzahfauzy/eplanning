<?php

use yii\helpers\html;



setlocale(LC_ALL, 'INDONESIA');


?>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
<tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN III : BERITA ACARA KESEPAKATAN  </td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;HASIL FORUM PERANGKAT DAERAH<td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;NOMOR &nbsp;&nbsp;&nbsp;: <?php echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;TANGGAL&nbsp;: <?php echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;-------------------------------------------------- </td> </tr>

</table>
<br>
<br>
<p style="text-align: center;">Daftar Kegiatan Yang Belum Di Sepakati</p>
<p style="text-align: center;">Tahun <?php echo date('Y')+1; ?></p>
<BR>
<table border="1" cellpadding="5" width="100%">
     <tr>
		<td>No</td>
        <td style="text-align:center">Kegiatan</td>
        <td style="text-align:center">Lokasi (desa/kel)</td>
        <td style="text-align:center">Volume</td>
        <td style="text-align:center">Pagu</td>
		<td style="text-align:center">Alasan</td>
	</tr>
	<tr>
		<td style="text-align:center">(1)</td>
        <td style="text-align:center">(2)</td>
        <td style="text-align:center">(3)</td>
        <td style="text-align:center">(4)</td>
        <td style="text-align:center">(5)</td>
		<td style="text-align:center">(6)</td>
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
		if(empty($rows->kdJalan->Nm_Jalan)||empty($rows->kelurahan->Nm_Kel)){
			echo @$rows->Detail_Lokasi;//$rows->kecamatan->Nm_Kec;
		}else{
			if (@$rows->Kd_Asal_Usulan>=3):
				echo @$rows->kdJalan->Nm_Jalan.", ".@$rows->kelurahan->Nm_Kel.", ".@$rows->lingkungan->Nm_Lingkungan;
			else:
				echo @$rows->kdJalan->Nm_Jalan.", ".@$rows->kelurahan->Nm_Kel.", ".@$rows->lingkungan->Nm_Lingkungan;
				echo @$rows->Detail_Lokasi;
			endif;
		}
		?>
		</td>
        <td>
		<?=$rows->Jumlah;?> <?=$rows->satuan->Uraian;?>
		</td>
		<td>
		<?=number_format($rows->Harga_Total,'0',',','.');?>
		</td>
		
        <td>
		<?php if ($rows->Status_Penerimaan_Skpd==NULL)
		{
			ECHO "Belum Dibahas";
		}
		else
		{
		  echo $rows->Alasan_Skpd;
		}
		?>
		</td>
	</tr>
	<?php } ?>
</table>
