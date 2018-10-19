<table class="table table-bordered" id="example">
	<tr>
		<th>No</th>
		<th>ID</th>
		<th>Kecamatan</th>
		<th>Lokasi</th>
		<th>Usulan</th>
		<th>Jumlah/Vol</th>
		<th>Skor</th>
		<th>Sumber</th>
		<th>Aksi</th>
	</tr>
	<?php 
	$no=1;
	foreach($model as $val){
		if($val->Kd_Asal_Usulan == '1' || $val->Kd_Asal_Usulan == '2' || $val->Kd_Asal_Usulan == '3'){
			$asal_usulan = 4;
		}elseif($val->Kd_Asal_Usulan > 3 || $val->Kd_Asal_Usulan < 6){
			$asal_usulan = $val->Kd_Asal_Usulan+1;
		}	
		if($val->Status_Penerimaan_Kota == 1){
			$btn = "<button class='btn btn-warning' type='button'>Sudah Di Pilih</button>";
		}else{
			$btn = '<button type="button" class="btn btn-primary btn-usulan-pilih" value="'.$val->id.'" data-asal="'.$asal_usulan.'" data-harga="'.$val->Harga_Satuan.'" data-satuan="'.$val->satuan->Uraian.'" data-kd="'.$val->Kd_Satuan.'"  data-barang="'.$val->Jenis_Usulan.'" data-lokasi="'.$val->Detail_Lokasi.'" data-jumlah="'.$val->Jumlah.'" data-kecamatan="'.$val->kecamatan->Nm_Kec.'">Pilih</button>';
		}
			
	?>
	<tr>
		<td>
		<?=$no;$no++;?>
		</td>
		<td algin="Center"> <?=$val->id;?></td>
		<td><?=$val->kecamatan->Nm_Kec;?></td>
		<?php if ($val->Kd_Asal_Usulan=='3' || $val->Kd_Asal_Usulan=='4' || $val->Kd_Asal_Usulan=='5' || $val->Kd_Asal_Usulan=='6' ||$val->Kd_Asal_Usulan=='7'||$val->Kd_Asal_Usulan=='8')
		{ ?>
		<td><?=$val->Detail_Lokasi;?></td>
		<?php } else {?>
		<td><?= @$val->lingkungan->Nm_Lingkungan . " Desa/Kel ". @$val->kelurahan->Nm_Kel;?></td>
		<?php } ?>
		<td><?=$val->Jenis_Usulan;?></td>
		<td><?=$val->Jumlah;?> <?=$val->satuan->Uraian;?></td>
		<td><?=$val->Skor;?></td>
		<?php if ($val->Kd_Asal_Usulan=='5' || $val->Kd_Asal_Usulan=='6' ||$val->Kd_Asal_Usulan=='7'||$val->Kd_Asal_Usulan=='8')
		{ ?>
		<td><?="Pokir";?></td>
		<?php } else { ?>
		<td><?="Kec";?></td>
		<?php }?>
		<td><?=$btn;?></td>
	</tr>
		<?php } ?>
</table>
<script>
$(".btn-usulan-pilih").click(function(){
	  //alert($(this).val());
	    var jumlah = $(this).data('jumlah');
	    var lokasi = $(this).data('lokasi');
  	    var barang = $(this).data('barang');
  	    var harga = $(this).data('harga');
		var satuan = $(this).data('satuan').toLowerCase();
		var kd = $(this).data('kd');
		var asal = $(this).data('asal');
		var kecamatan = $(this).data('kecamatan');
		
		//alert(uraian);

		$("#uraian_obyek").val(barang);
		$("#id_musrenbang").val($(this).val());
		$("#nilai_obyek").val(harga);
		//$("#satuan1").val(satuan);
		$("#satuan1").val(satuan).change();
		$("#satuan").val(kd).change();
		$("#asal_biaya").val(asal);
	    $("#nilai1").val(jumlah);  
	    $("#lokasi").val(lokasi);
		
		$xx=$("#kcmtn").val(kecamatan);
		$("#Uraian_Asal_Biaya").val($(this).val() + "|" + kecamatan)
		$("#judul").val(barang);
		
		$("#jumlah_satuan").val(jumlah); 
		$("#total_nilai").val(jumlah*harga);
});
</script>