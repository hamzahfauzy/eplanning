<?php
	foreach ($data as $key => $value) {
    $Kd_Prov= $value['Kd_Prov'];
    $Kd_Kab= $value['Kd_Kab'];
    $Kd_Kec= $value['Kd_Kec'];
    $Kd_Urut= $value['Kd_Urut'];
    $Nm_Kel= $value['Nm_Kel'];
		echo "<tr>
							<td data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' data-urut='$Kd_Urut' class='data-kel'>$Nm_Kel</td>
							<td></td>
					</tr>";
	}
?>

<script type="text/javascript">

	$(".data-kel").click(function(){
		var prov = $(this).data('prov');
		var kab = $(this).data('kab');
		var kec = $(this).data('kec');
		var urut = $(this).data('urut');
		//alert("index.php?r=explorer/getling&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut);
		
		$('#list-ling').html('');
		$('#list-usulan').html('');
		$('#list-jalan').html('');
		$('#list-usulanjalan').html('');
		$.ajax({
	    url: "index.php?r=explorer/getling",
	    data: "Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut,
	    success: function(data) {
	    	$('#list-ling').html(data);
	    }
	  });
	});
</script>