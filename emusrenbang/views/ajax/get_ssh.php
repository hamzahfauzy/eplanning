<?php
	foreach ($data as $key => $value):
		$Kd_Ssh1 = $value->Kd_Ssh1;
		$Kd_Ssh2 = $value->Kd_Ssh2;
		$Kd_Ssh3 = $value->Kd_Ssh3;
		$Kd_Ssh4 = $value->Kd_Ssh4;
		$Kd_Ssh5 = $value->Kd_Ssh5;
		$Kd_Ssh6 = $value->Kd_Ssh6;
		$uraian = ['Kd_Ssh1'=>$Kd_Ssh1, 'Kd_Ssh2'=>$Kd_Ssh2, 'Kd_Ssh3'=>$Kd_Ssh3, 'Kd_Ssh4'=>$Kd_Ssh4, 'Kd_Ssh5'=>$Kd_Ssh5, 'Kd_Ssh6'=>$Kd_Ssh6];
		$uraian_kode = serialize($uraian);
	?>
		<tr>
			<td><?= $value->Nama_Barang ?></td>
			<td><?= $value->Satuan ?></td>
			<td><?= $value->Spesifikasi ?></td>
			<td><?= number_format($value->Harga_Satuan,0, ',','.') ?></td>
			<td>
				<button type="button" class="btn btn-primary btn_pilih_ssh" data-kd="<?= $value->Kd_Satuan; ?>" data-barang="<?= $value->Nama_Barang ?>" data-harga="<?= $value->Harga_Satuan ?>" data-satuan="<?= $value->Satuan ?>" data-uraian='<?= $uraian_kode ?>'>Pakai</button>
			</td>
		</tr>
	<?php
	endforeach;
?>

<script type="text/javascript">
	$(".btn_pilih_ssh").click(function(){
		//console.log($(this).data);
		
		var barang = $(this).data('barang');
		var harga = $(this).data('harga');
		var satuan = $(this).data('satuan').toLowerCase();
		var uraian = $(this).data('uraian');
		var kd = $(this).data('kd');
		//alert(uraian);

		$("#uraian_obyek").val(barang);
		$("#judul").val(barang);
		$("#nilai_obyek").val(harga);
		//$("#satuan1").val(satuan);
		$("#satuan1").val(satuan).change();
		$("#satuan").val(kd).change();
		$("#asal_biaya").val('1');
		$("#Uraian_Asal_Biaya").val(uraian);
		//$('#satuan1 option[value='+satuan+']').attr('selected','selected');
		
		$("#close1").trigger("click");

		setTimeout(function(){
       $('#pilihSshModal').modal('hide')
 		}, 100); 
	});
</script>