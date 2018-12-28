<?php 
use common\models\RefMedia;
use eperencanaan\models\TaMusrenbangKelurahanMedia;
use eperencanaan\models\TaMusrenbangKecamatanMedia;
use eperencanaan\models\TaUsulanKelurahanMedia;

$no = 1;
if(count($data)>0){
	foreach($data as $rows): 
		if($rows->Kd_Asal_Usulan == 1)
			$asal_usulan = "Dusun/Lingkungan";
		else if($rows->Kd_Asal_Usulan == 2)
			$asal_usulan = "Desa/Kelurahan";
		else if($rows->Kd_Asal_Usulan == 3)
			$asal_usulan = "Kecamatan";
		
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
		<td><center>
		<?=$asal_usulan?>
		
		<br> <br>
		<b>
		<?=$rows->id;?>
		</b></center>
		
		</td>
		<td><span id="asal_usulan_<?=$rows->id;?>"></span>
			<?php if ($rows->Kd_Asal_Usulan!=1 || $rows->Kd_Asal_Usulan!=2 )
			{
				echo $rows->Detail_Lokasi;
			}
			?>
		</td>
		<td> 		<?=$rows->Nm_Permasalahan;?>		</td>
		<td><?=$rows->Jenis_Usulan;?></td>
		<td>
		<?=$rows->Jumlah;?>
		<?=$rows->satuan->Uraian;?>
		</td>
		<td>Rp. <?=number_format($rows->Harga_Total);?></td>
		<td>
			 <?php if ($rows->Kd_Asal_Usulan==1 || $rows->Kd_Asal_Usulan==2)
			{
				echo $rows->Detail_Lokasi;
				
			}
			?>
			 <br>
			Latitude : <?=$rows->Latitute;?><br>
			Longitude : <?=$rows->Longitude;?><br>
			<button class="btn btn-danger" data-toggle="modal" data-target="#modallokasi" onclick="showmodallokasi(['<?=$rows->Latitute;?>','<?=$rows->Longitude;?>']);"><span class="glyphicon glyphicon-map-marker"></span></button></td>
		</td>
		<td>P<?= isset($rows->Urutan_Prioritas) && $rows->Urutan_Prioritas > 0 ? $rows->Urutan_Prioritas : 0 ;?>
		</td>
		<?php if($acara['Waktu_Mulai']!=0){ ?>
		<td>Skor : <?=$rows->Skor;?>
			<br>
			<button type="button" class="btn btn-success"  onclick="hitung('<?=$rows->id;?>');">Skoring</button>
		</td>
		<td align="Center">
			<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="showToModal('<?=$rows->id;?>')">Lihat</button>  -->
			<a href='index.php?r=musrenbang-kecamatan/update&id=<?=$rows->id;?>&forum=101&xkel=<?=$rows->Kd_Kel;?>&xurut=<?=$rows->Kd_Urut_Kel;?>'><button class="btn btn-warning" >Revisi</button></a> 
			<button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal_terima" onclick="showToModalTerima('<?=$rows->id;?>')" <?=$dis;?>>Terima</button>
			<button type="button" class="btn btn-danger"   data-toggle="modal" data-target="#modal_tolak" onclick="showToModalTolak('<?=$rows->id;?>')" <?=$dis;?>>Tolak</button>
			<br>
			
		<!--	<button class="btn btn-success"  onclick="showmodaldokumen(<?php echo $rows->taMusrenbangKelurahan['Kd_Ta_Musrenbang_Kelurahan'];?>);"><span class="glyphicon glyphicon-folder-close"></span> </button>  -->
				<?php 
				 
			//	if ($rows->Kd_Asal_Usulan<='2'){
                                        
				$model1 = TaUsulanKelurahanMedia::find()
							->where(['Kd_Ta_Musrenbang_Kelurahan'=>$rows->taMusrenbangKelurahan['Kd_Ta_Musrenbang_Kelurahan']])
							->all();
				foreach ($model1 as $value1){
					$model2 = RefMedia::find()->where(['Kd_Media'=>$value1['Kd_Media']])->all();
					foreach ($model2 as $value){
						$Jenis_Media = $value['Jenis_Media'];
						$Nm_Media = $value['Nm_Media'];
						$Judul_Media = $value['Judul_Media'];
					$url="http://eplanning.asahankab.go.id/eperencanaan/eperencanaan/web/data/".$Nm_Media;
					echo '<button class="btn btn-danger" data-toggle="modal" data-target="#myModal1" value="'.$url.'" onclick="tambah_semangat1(this.value)">'.$Jenis_Media.'</button>';
						
					}
				 
				}
				
				
				


				
	
			?>
		
		
		</td>
		<td>
		<?=$status_penerimaan;?>
		<br>
		<br>
		<?=@$rows->Alasan_Skpd;?>
		</td>
		<?php } ?>
		<!--<td align="Center"><button class="btn btn-success"  onclick="showmodaldokumen(<?=$rows->taMusrenbangKelurahan['Kd_Ta_Musrenbang_Kelurahan'];?>);"><span class="glyphicon glyphicon-folder-close"></span> </button></td> -->
		
	</tr>
	
	
	<script>
	//alert(<?=$rows->id;?>);
	$.get("index.php?r=musrenbang-skpd/get-asal-usulan&id=<?=$rows->id;?>",function(response){
		$("#asal_usulan_<?=$rows->id;?>").html(response);
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
		$.get("index.php?r=dashboard/media-kelurahan&Kd="+kd, function(response){
			
			$("#response-modal").html(response);
			$("#modaldokumen").modal();
		//	alert(kd);
		});
		
	}
	function showmodallokasi(kd){
		$("#modaldokumen").close();
		$("#lat").html(kd[0]);
		$("#lng").html(kd[1]);	
		var sumber = "https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=600&hl=ru&coord="+kd[0]+","+kd[1]+"&ie=UTF8&t=&z=14&iwloc=B&output=embed";
		$("#frame").attr("src", sumber);
	}
	
	function tambah_semangat1(xKol1){
		var alamat1 = xKol1;
		var sumber1 = ""+alamat1;
		$("#img1").attr("src", sumber1);
		
	}
	
</script>


