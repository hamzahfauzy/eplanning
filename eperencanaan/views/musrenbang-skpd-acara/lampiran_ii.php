<?php

use yii\helpers\html;



setlocale(LC_ALL, 'INDONESIA');


?>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
<tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN II : BERITA ACARA KESEPAKATAN  </td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;HASIL FORUM PERANGKAT DAERAH<td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;: <?php echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;: <?php echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-------------------------------------------------- </td> </tr>

</table>
<br>
<br>
<p>Daftar Urutan Kegiatan Prioritas Kecamatan Hasil Forum Perangkat Daerah</p>

<table>
    
    <tr>
	<td>Kecamatan</td>
	<td>:</td>
	<td><?php echo @$kecamatan($post['MusrenbangSkpdAcara']['Kd_Kec'])->Nm_Kec; ?></td>
	</tr>
	
	<tr>
	<td>Tahun</td>
	<td>:</td>
	<td><?php echo date('Y')+1; ?></td>
	</tr>
</table>
<BR>
<table border="1" cellpadding="5">
    <tr>
		<td>No</td>
        <td  style="text-align:center">Prioritas Daerah</td>
        <td style="text-align:center">Sasaran Daerah</td>
        <td style="text-align:center">Program</td>
        <td style="text-align:center">Kegiatan Prioritas</td>
        <td style="text-align:center">Sasaran Kegiatan</td>
        <td style="text-align:center">Lokasi (desa/kel)</td>
        <td style="text-align:center">Volume</td>
        <td style="text-align:center">Pagu (Rp)</td>
        <td style="text-align:center">Skor</td>
	</tr>
	<tr>
		<td>(1)</td>
        <td style="text-align:center">(2)</td>
        <td style="text-align:center">(3)</td>
        <td style="text-align:center">(4)</td>
        <td style="text-align:center">(5)</td>
        <td style="text-align:center">(6)</td>
        <td style="text-align:center">(7)</td>
        <td style="text-align:center">(8)</td>
        <td style="text-align:center">(9)</td>
        <td style="text-align:center">(10)</td>
	</tr>
	<?php
	$no=1;
	foreach($usulan_terima as $rows){
	?>
	<tr>
		<td><?php echo $no;$no++;?></td>
        <td><?=$rows->bidangPembangunan->Bidang_Pembangunan;?></td>
        <td> </td>
		<td><?=$rows->program['Ket_Prog'];?></td>
        <td>
		<b>Permasalahan :</b><br>
		<?=$rows->Nm_Permasalahan;?>
		<br>
		<b>Usulan :</b><br>
		<?=$rows->Jenis_Usulan;?>
		</td>
        <td><?=$rows->kegiatan['Ket_Kegiatan'];?></td>
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
		//echo @$rows->kdJalan->Nm_Jalan.", ".@$rows->kelurahan->Nm_Kel.", ".@$rows->lingkungan->Nm_Lingkungan;
		?>
		</td>
        <td>
		<?=$rows->Jumlah;?> <?=$rows->satuan->Uraian;?>
		</td>
        <td>
		<?=number_format($rows->Harga_Total,'0',',','.');?>
		</td>
        <td>
		<?php //echo @$rows->refSubUnit->Nm_Sub_Unit;?>
		<?php echo @$rows->Skor;?>
		<br>
		<?php if ($rows->Kd_Asal_Usulan=='1' || $rows->Kd_Asal_Usulan=='2' || $rows->Kd_Asal_Usulan=='3')
		{
			echo "(Kecamatan)";
		}
		else{
			echo "(Pokir)";
		}
		?>
		
		
		</td>
	</tr>
	<?php } ?>
</table>
