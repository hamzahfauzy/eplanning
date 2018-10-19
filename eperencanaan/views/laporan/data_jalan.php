<?php
	/*
  foreach($data as $d){
      echo "<li>$d[Nm_Lingkungan]</li>";
  }
  */
  foreach ($data as $key => $value) {
	    $Kd_Prov= $value['Kd_Prov'];
	    $Kd_Kab= $value['Kd_Kab'];
	    $Kd_Kec= $value['Kd_Kec'];
	    $Kd_Urut= $value['Kd_Urut_Kel'];
	    $Kd_Lingkungan= $value['Kd_Lingkungan'];
	    $Kd_Jalan= $value['Kd_Jalan'];
	    $Nm_Jalan= $value['Nm_Jalan'];
			echo "<tr>
								<td data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' data-urut='$Kd_Urut' data-lingkungan='$Kd_Lingkungan' data-jalan='$Kd_Jalan' class='data-jalan'>$Nm_Jalan</td>
								<td></td>
						</tr>";
		}

?>

<script type="text/javascript">
// data usulan
	$(".data-jalan").click(function(){
		var prov = $(this).data('prov');
		var kab = $(this).data('kab');
		var kec = $(this).data('kec');
		var urut = $(this).data('urut');
		var lingkungan = $(this).data('lingkungan');
		var jalan = $(this).data('jalan');
		//alert("index.php?r=explorer/getusulanjalan&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Lingkungan="+lingkungan+"&Kd_Jalan="+jalan);
		$.ajax({
	    url: "index.php?r=laporan/getusulanjalan",
	    data: "Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Lingkungan="+lingkungan+"&Kd_Jalan="+jalan,
	    success: function(usulan2) {
	    	$('#list-usulanjalan').html(usulan2);
	    	//alert(ling);
	    }
	  });
	});
</script>