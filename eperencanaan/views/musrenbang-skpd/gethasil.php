<?php 
$no = 1;
if(count($data)>0){
	foreach($data as $rows): 
		$dis = "";
		if($rows->Status_Penerimaan_Skpd == NULL){
			$status_penerimaan = "Belum Di Proses";
		}else if($rows->Status_Penerimaan_Skpd == 1){
			$status_penerimaan = "Diterima";
		}else{
			$status_penerimaan = "Di Tolak";
		}
		if($rows->Kd_Asal_Usulan >= 5){
			$asal_usulan = "-pokir";
			$id_media = "{'id':'".$rows->id."','untuk':'pokir'}";
		}else{
			$asal_usulan = "";
			$id_media = "{'id':'".$rows->taMusrenbangKelurahan['Kd_Ta_Musrenbang_Kelurahan']."','untuk':'kelurahan'}";
		}
		
	?>
	<tr>
		<td><?=$no;$no++;?></td>
		<td><span id="asal_usulan_<?=$rows->id;?>"></span>
		<?php if ($rows->Kd_Asal_Usulan!=1 || $rows->Kd_Asal_Usulan!=2 )
			{
				echo $rows->Detail_Lokasi;
			}
			?>
		</td>

		<td><?=$rows->Jenis_Usulan;?></td>
		<td><?=$rows->Jumlah;?>
		<?=$rows->satuan->Uraian;?>
		</td>
		<td><?=number_format($rows->Harga_Total);?></td>
		<td>
			
			Lokasi : <?=$rows->Detail_Lokasi;?><br>
			Latitude : <?=$rows->Latitute;?><br>
			Longitude : <?=$rows->Longitude;?><br>
			<button class="btn btn-danger" data-toggle="modal" data-target="#modallokasi" onclick="showmodallokasi(['<?=$rows->Latitute;?>','<?=$rows->Longitude;?>']);"><span class="glyphicon glyphicon-map-marker"></span></button></td>
		</td>
		<td><?=$status_penerimaan;?></td>
		<td><?=$rows->Skor;?></td>
		<td align="center"><button class="btn btn-success" onclick="showmodaldokumen(<?=$id_media;?>);"><span class="glyphicon glyphicon-folder-close"></span> </button></td>
	</tr>
	<script> 
	//alert(<?=$rows->id;?>);
	$.get("index.php?r=musrenbang-skpd/get-asal-usulan<?=$asal_usulan;?>&id=<?=$rows->id;?>",function(response){
		if("<?=$asal_usulan;?>"=="-pokir"){
			out = $.parseJSON(response);
			out = "Kecamatan : "+out.Kecamatan;
		}else
			out = response;
		$("#asal_usulan_<?=$rows->id;?>").html(out);
	});
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
		
		$.get("index.php?r=dashboard/media-"+kd.untuk+"&Kd="+kd.id, function(response){
			$("#response-modal").html(response);
			$("#modaldokumen").modal();
		});
		//console.log(kd);
		//alert(kd.untuk);
	}
	function showmodallokasi(kd){
		$("#lat").html(kd[0]);
		$("#lng").html(kd[1]);	
		var sumber = "https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=600&hl=ru&coord="+kd[0]+","+kd[1]+"&ie=UTF8&t=&z=14&iwloc=B&output=embed";
		$("#frame").attr("src", sumber);
	}
</script>