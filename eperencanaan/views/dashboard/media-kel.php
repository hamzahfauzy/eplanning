<?php
if(count($model)){
	$no=1;
?>
<table class="table table-bordered">
<!--<tr>
	<td>Jenis Dokumen</td>
	<td>Dokumen</td>
</tr> -->
<?php
foreach($model as $rows){
	echo "<tr>";
	
	echo "<td align='center'>";
	if($rows->Jenis_Dokumen=="Foto")
		echo "<a href='data/".$media($rows->Kd_Media)->Nm_Media."'><img src='data/".$media($rows->Kd_Media)->Nm_Media."' width=600 ></a>"; 
	echo "<br>";
	echo $rows->Jenis_Dokumen;
		
	//	print_r($media($rows->Kd_Media)->Judul_Media);
	echo "</td>";
	echo "</tr>";
	$no++;
}
?>
</table>
<?php
}else{
	echo "Tidak Ada Dokumen...!";
}