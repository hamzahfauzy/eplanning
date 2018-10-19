<!DOCTYPE html>
<html>
<head>
	<title>Laporan Usulan Desa/Kelurahan</title>
</head>
<style type="text/css">
	.judul1, .judul2{
		text-align: center;
	}

	.tabel-data {
    border-collapse: collapse;
	}

	.tabel-data, .tabel-data th, .tabel-data td {
	    border: 1px solid black;
	    padding: 5px;
	}
</style>
<body>
<h1 class="judul1">Laporan Usulan Desa/Kelurahan</h1>
<h2 class="judul2">Rembuk Warga </h2>
<table>
	<tr>
		<td>Tanggal Cetak</td>
		<td>: <?= date("d-m-Y") ?></td>
	</tr>
	<tr>
		<td>Kelurahan</td>
		<td>: <?= $data->Nm_Kel; ?></td>
	</tr>
</table>
<table class="tabel-data">
	<tr>
		<th>No.</th>
		<th>Dusun/Lingkungan</th>
		<th>Bidang<br/>Pembangunan</th>
		<th>Permasalahan</th>
		<th>Usulan</th>
		<th>Jumlah</th>
		<th>Estimasi Biaya</th>
		<th>Lokasi</th>
		<th>Tanggal</th>
	</tr>
	<?php  
		$no=0;
		foreach ($data->lingkungans as $lingkungan):	
			foreach ($lingkungan->usulans as $forum):	
			$no++;
		  ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $lingkungan->Nm_Lingkungan ?></td>
					<td><?= $forum->kdPem->Bidang_Pembangunan ?></td>
					<td><?= $forum->Nm_Permasalahan ?></td>
					<td><?= $forum->Jenis_Usulan ?></td>
					<td><?= $forum->Jumlah." ".$forum->kdSatuan->Uraian ?></td>
					<td align='right'><?= number_format($forum->Harga_Total,2, ',', '.') ?></td>
					<td><?= $forum->Detail_Lokasi ?></td>
					<td><?= date("d-m-Y", $forum->Tanggal) ?></td>
				</tr>
			<?php
			endforeach;
		endforeach;
	?>
</table>


</body>
</html>