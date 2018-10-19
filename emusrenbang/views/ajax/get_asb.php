<?php
	foreach ($data as $key => $value):
		$Kd_Asb1 = $value->Kd_Asb1;
		$Kd_Asb2 = $value->Kd_Asb2;
		$Kd_Asb3 = $value->Kd_Asb3;
		$Kd_Asb4 = $value->Kd_Asb4;
		$Kd_Asb5 = $value->Kd_Asb5;
		$uraian = ['Kd_Asb1'=>$Kd_Asb1, 'Kd_Asb2'=>$Kd_Asb2, 'Kd_Asb3'=>$Kd_Asb3, 'Kd_Asb4'=>$Kd_Asb4, 'Kd_Asb5'=>$Kd_Asb5];
		$uraian_kode = serialize($uraian);
	?>
		<tr>
			<td><?= $value->Jenis_Pekerjaan ?></td>
			<td><?= $value->kdSatuan->Uraian ?></td>
			<td><?= number_format($value->Harga,0, ',','.') ?></td>
			<td>
				<button type="button" class="btn btn-primary btn_pilih_asb" data-kd="<?= $value->Kd_Satuan; ?>" data-barang="<?= $value->Jenis_Pekerjaan ?>" data-harga="<?= $value->Harga ?>"  data-uraian='<?= $uraian_kode ?>' data-satuan='<?= $value->kdSatuan->Uraian ?>'>Pakai</button>
			</td>
		</tr>
	<?php
	endforeach;
?>

<script type="text/javascript">
	$(".btn_pilih_asb").click(function(){
		var barang = $(this).data('barang');
		var harga = $(this).data('harga');
		var uraian = $(this).data('uraian');
		var kd = $(this).data('kd');

		$("#Uraian_Asal_Biaya").val(uraian);

		$("#uraian_obyek").val(barang);
		$("#judul").val(barang);
		$("#nilai_obyek").val(harga);
		$("#asal_biaya").val('3');
		$("#Uraian_Asal_Biaya").val(uraian);

		var satuan = $(this).data('satuan');
		$("#satuan1").val(satuan).trigger("change");
		$("#satuan").val(kd).trigger("change");
		
		$("#close2").trigger("click");

		setTimeout(function(){
       $('#pilihAsbModal').modal('hide')
 		}, 100); 
	});
</script>