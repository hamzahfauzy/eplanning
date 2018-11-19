	<tr >
		<th>Kelurahan</th>
		<th>Waktu Mulai</th>
		<th>Waktu Selesai</th>
		<th>Nama Pejabat</th>
	</tr>
<?php  
	foreach ($kelurahan as $key => $value) :
	?>
		<tr >
			<td><?= $value->Nm_Kel ?></td>
			<td><?php if($value->taMusrenbangKelurahanAcara) echo date("Y-m-d H:i:s", $value->taMusrenbangKelurahanAcara->Waktu_Mulai) ?></td>
			<td><?php if($value->taMusrenbangKelurahanAcara) echo date("Y-m-d H:i:s", $value->taMusrenbangKelurahanAcara->Waktu_Selesai) ?></td>
			<td><?php if($value->taMusrenbangKelurahanAcara) echo $value->taMusrenbangKelurahanAcara->Nama_Pejabat ?></td>
		</tr>
	<?php  
	endforeach;
?>