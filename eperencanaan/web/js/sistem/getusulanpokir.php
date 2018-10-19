<?php 
$no = 1;
if(count($data)>0){
	foreach($data as $rows): 
		$asal_usulan = "Pokir";
		
		$status_survey = ($rows->Status_Survey == 4) ? "Sudah Survey" : "Belum Survey";
		$dis = "";
		if($rows->Status_Penerimaan_Skpd == NULL){
			$status_penerimaan = "Belum Di Proses";
			$linkterima = "index.php?r=musrenbang-skpd/usulan-terima&id=".$rows->id;
			$linktolak = "index.php?r=musrenbang-skpd/usulan-tolak&id=".$rows->id;
		}else if($rows->Status_Penerimaan_Skpd == 1){
			$status_penerimaan = "Diterima";
			$dis = "disabled";
			$linkterima = "#";
			$linktolak = "#";
		}else{
			$status_penerimaan = "Di Tolak";
			$dis = "disabled";
			$linkterima = "#";
			$linktolak = "#";
		}
		
	?>
	<tr>
		<td><?=$no;$no++;?></td>
		<td><span id="username_<?=$rows->id;?>"></span></td>
		<td><?=$dapil($rows->Kd_User);?></td>
		<td><?=$fraksi($rows->Kd_User);?></td>
		<td><span id="asal_usulan_<?=$rows->id;?>"></span></td>
		<td><?=$rows->Jenis_Usulan;?></td>
		<td>
		<?=$rows->Jumlah;?>
		<?=$rows->satuan->Uraian;?>
		</td>
		<td><?=number_format($rows->Harga_Total);?></td>
		<td>
			Lokasi : <?=$rows->Detail_Lokasi;?><br>
			Latitude : <?=$rows->Latitute;?><br>
			Longitude : <?=$rows->Longitude;?><br>
			<button class="btn btn-danger" data-toggle="modal" data-target="#modallokasi" onclick="showmodallokasi(['<?=$rows->Latitute;?>','<?=$rows->Longitude;?>']);"><span class="glyphicon glyphicon-map-marker"></span></button></td>
		
		<td>Skor : <?=$rows->Skor;?>
			<br>
			<button type="button" class="btn btn-success" <?=$dis;?> onclick="hitung('<?=$rows->id;?>');">Skoring</button>
		</td>
		<td>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="showToModal('<?=$rows->id;?>')">Lihat</button> 
			<button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal_terima" onclick="showToModalTerima('<?=$rows->id;?>')" <?=$dis;?>>Terima</button>
			<button type="button" class="btn btn-danger"   data-toggle="modal" data-target="#modal_tolak" onclick="showToModalTolak('<?=$rows->id;?>')" <?=$dis;?>>Tolak</button>
		</td>
		<td>
		<?=$status_penerimaan;?>
		<br>
		<br>
		<?=@$rows->Alasan_Skpd;?>
		</td>
		
		<td><button class="btn btn-success" onclick="showmodaldokumen(<?=$rows->id;?>);"><span class="glyphicon glyphicon-folder-close"></span> Dokumen</button></td>
	</tr>
	<script>
	//alert(<?=$rows->id;?>);
	$.get("index.php?r=musrenbang-skpd/get-asal-usulan-pokir&id=<?=$rows->id;?>",function(response){
		console.log(response);
		$("#asal_usulan_<?=$rows->id;?>").html(response.Kecamatan);
		$("#username_<?=$rows->id;?>").html(response.Username);
	},"json");
	</script>
<?php 
	endforeach; 
}else{
	echo "<tr><td colspan=10><center>Tidak Ada Data</center></td></tr>";
}
?>

<script>
$("#jumlah-total-usulan").html("Jumlah Total Usulan : <?=$no-1;?>");
					
	function showmodaldokumen(kd){
		$.get("index.php?r=dashboard/media-pokir&Kd="+kd, function(response){
			$("#response-modal").html(response);
			$("#modaldokumen").modal();
		});
	}
	function showmodallokasi(kd){
		$("#lat").html(kd[0]);
		$("#lng").html(kd[1]);	
		var sumber = "https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=600&hl=ru&coord="+kd[0]+","+kd[1]+"&ie=UTF8&t=&z=14&iwloc=B&output=embed";
		$("#frame").attr("src", sumber);
	}
	</script>