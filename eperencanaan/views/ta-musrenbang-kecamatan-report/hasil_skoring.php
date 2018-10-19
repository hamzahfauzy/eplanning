<tr>
	<td colspan="11">
		<h3>Infrastruktur</h3>
	</td>
</tr>
<?php
	$no=0;
	foreach ($data_infrastruktur as $val) :
		$id = $val->id;
		$no++;
		if ($val->Kd_Jalan)
			$jalan = $val->kdJalan->Nm_Jalan;
		else
			$jalan = '';

		if($val->Kd_Prioritas_Pembangunan_Daerah)
			$rpjmd_pilih = $val->rpjmd->Nm_Prioritas_Pembangunan_Kota;
		else
			$rpjmd_pilih = 'Non Prioritas';

		if ($val->Kd_Asal_Usulan == 1) {
			$asal_usulan = "Lingkungan";
		}
		else if ($val->Kd_Asal_Usulan == 2) {
			$asal_usulan = "Kelurahan";
		}
		else if ($val->Kd_Asal_Usulan == 3) {
			$asal_usulan = "Kecamatan";
		}
		else {
			$asal_usulan = "Tidak Ditemukan";
		}

		//$val->Status_Penerimaan_Kecamatan
		
		?>
		<tr>
			<td>
				<?= $no ?>
			</td>
			<td>
				<?= $asal_usulan ?>
			</td>
			<td>
				<b>Permasalahan:</b><br/>
		    <p><?= $val->Nm_Permasalahan ?></p>
		    <b>Usulan:</b>
		    <p><?= $val->Jenis_Usulan ?></p>
		    (<?= $val->bidangPembangunan->Bidang_Pembangunan ?>)
			</td>
		  <td>
		  	<?php if($val->Kd_Kel) echo $val->kelurahan->Nm_Kel ?>
		  </td>
		  <td>
		  	<?php if($val->Kd_Lingkungan) echo $val->lingkungan->Nm_Lingkungan ?>
		  </td>
		  <td>
		  	<?php if ($val->Kd_Jalan) echo $val->kdJalan->Nm_Jalan ?> <br/>
		  	<?= $val->Detail_Lokasi ?>
		  </td>
			<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
			<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
			<td align='center'>
		    	<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo $val->refSubUnit->Nm_Sub_Unit ?>
			</td>
			<td align="center">
		    	<?= $rpjmd_pilih ?>
			</td>
			<td align="center">
					<?php if($val->Skor != null) echo $val->Skor ?>
			</td>
		</tr>
		<?php
	endforeach;
?>
<!--sosialbudaya-->
<tr>
	<td colspan="11">
		<h3>Sosial Budaya</h3>
	</td>
</tr>
<?php
	$no=0;
	foreach ($data_sosbud as $val) :
		$id = $val->id;
		$no++;
		if ($val->Kd_Jalan)
			$jalan = $val->kdJalan->Nm_Jalan;
		else
			$jalan = '';

		if($val->Kd_Prioritas_Pembangunan_Daerah)
			$rpjmd_pilih = $val->rpjmd->Nm_Prioritas_Pembangunan_Kota;
		else
			$rpjmd_pilih = 'Non Prioritas';

		if ($val->Kd_Asal_Usulan == 1) {
			$asal_usulan = "Lingkungan";
		}
		else if ($val->Kd_Asal_Usulan == 2) {
			$asal_usulan = "Kelurahan";
		}
		else if ($val->Kd_Asal_Usulan == 3) {
			$asal_usulan = "Kecamatan";
		}
		else {
			$asal_usulan = "Tidak Ditemukan";
		}

		//$val->Status_Penerimaan_Kecamatan
		
		?>
		<tr>
			<td>
				<?= $no ?>
			</td>
			<td>
				<?= $asal_usulan ?>
			</td>
			<td>
				<b>Permasalahan:</b><br/>
		    <p><?= $val->Nm_Permasalahan ?></p>
		    <b>Usulan:</b>
		    <p><?= $val->Jenis_Usulan ?></p>
		    (<?= $val->bidangPembangunan->Bidang_Pembangunan ?>)
			</td>
		  <td>
		  	<?php if($val->Kd_Kel) echo $val->kelurahan->Nm_Kel ?>
		  </td>
		  <td>
		  	<?php if($val->Kd_Lingkungan) echo $val->lingkungan->Nm_Lingkungan ?>
		  </td>
		  <td>
		  	<?php if ($val->Kd_Jalan) echo $val->kdJalan->Nm_Jalan ?> <br/>
		  	<?= $val->Detail_Lokasi ?>
		  </td>
			<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
			<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
			<td align='center'>
		    	<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo @$val->refSubUnit->Nm_Sub_Unit ?>
			</td>
			<td align="center">
		    	<?= $rpjmd_pilih ?>
			</td>
			<td align="center">
					<?php if($val->Skor != null) echo $val->Skor ?>
			</td>
		</tr>
		<?php
	endforeach;
?>
<!--ekonomi-->
<tr>
	<td colspan="11">
		<h3>Ekonomi</h3>
	</td>
</tr>
<?php
	$no=0;
	foreach ($data_ekonomi as $val) :
		$id = $val->id;
		$no++;
		if ($val->Kd_Jalan)
			$jalan = $val->kdJalan->Nm_Jalan;
		else
			$jalan = '';

		if($val->Kd_Prioritas_Pembangunan_Daerah)
			$rpjmd_pilih = $val->rpjmd->Nm_Prioritas_Pembangunan_Kota;
		else
			$rpjmd_pilih = 'Non Prioritas';

		if ($val->Kd_Asal_Usulan == 1) {
			$asal_usulan = "Lingkungan";
		}
		else if ($val->Kd_Asal_Usulan == 2) {
			$asal_usulan = "Kelurahan";
		}
		else if ($val->Kd_Asal_Usulan == 3) {
			$asal_usulan = "Kecamatan";
		}
		else {
			$asal_usulan = "Tidak Ditemukan";
		}

		//$val->Status_Penerimaan_Kecamatan
		
		?>
		<tr>
			<td>
				<?= $no ?>
			</td>
			<td>
				<?= $asal_usulan ?>
			</td>
			<td>
				<b>Permasalahan:</b><br/>
		    <p><?= $val->Nm_Permasalahan ?></p>
		    <b>Usulan:</b>
		    <p><?= $val->Jenis_Usulan ?></p>
		    (<?= $val->bidangPembangunan->Bidang_Pembangunan ?>)
			</td>
		  <td>
		  	<?php if($val->Kd_Kel) echo $val->kelurahan->Nm_Kel ?>
		  </td>
		  <td>
		  	<?php if($val->Kd_Lingkungan) echo $val->lingkungan->Nm_Lingkungan ?>
		  </td>
		  <td>
		  	<?php if ($val->Kd_Jalan) echo $val->kdJalan->Nm_Jalan ?> <br/>
		  	<?= $val->Detail_Lokasi ?>
		  </td>
			<td><?= $val->Jumlah.' '.$val->satuan->Uraian; ?></td>
			<td><?= number_format($val->Harga_Total,0, ',', '.') ?></td>
			<td align='center'>
		    	<?php if(isset($val->Kd_Sub) && $val->Kd_Sub != 0 && $val->Kd_Sub != null ) echo @$val->refSubUnit->Nm_Sub_Unit ?>
			</td>
			<td align="center">
		    	<?= $rpjmd_pilih ?>
			</td>
			<td align="center">
					<?php if($val->Skor != null) echo $val->Skor ?>
			</td>
		</tr>
		<?php
	endforeach;
?>