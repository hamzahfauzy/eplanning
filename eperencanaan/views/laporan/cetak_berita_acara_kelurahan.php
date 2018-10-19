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
<h1 class="judul1">Laporan Berita Acara Per Desa/Kelurahan</h1>
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
		<th rowspan="2">No.</th>
		<th rowspan="2">Dusun/Lingkungan</th>
		<td colspan="4">Waktu</td>
		<th rowspan="2">Nama Tempat</th>
		<th rowspan="2">Jumlah Usulan</th>
	</tr>
	<tr>
		<th>Unduh Absen</th>
		<th>Mulai</th>
		<th>Selesai</th>
		<th>Unduh Berita Acara</th>
	</tr>
	<?php  
		$no=0;
		foreach ($data->lingkungans as $lingkungan):	
			foreach ($lingkungan->taForumLingkunganAcaras as $key => $acara):	
			$no++;
		  ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $lingkungan->Nm_Lingkungan ?></td>
					<td><?= date("d-m-Y H:i:s", $acara->Waktu_Unduh_Absen) ?></td>
					<td><?= date("d-m-Y H:i:s", $acara->Waktu_Mulai) ?></td>
					<td><?= date("d-m-Y H:i:s", $acara->Waktu_Selesai) ?></td>
					<td><?= date("d-m-Y H:i:s", $acara->Waktu_Unduh_Berita_Acara) ?></td>
					<td><?= $acara->Nama_Tempat ?></td>
					<td><?= $lingkungan->getUsulans()->count() ?></td>
				</tr>
			<?php
			endforeach;
		endforeach;
	?>
</table>
</body>
</html>