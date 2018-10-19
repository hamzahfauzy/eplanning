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
    $Kd_Kel= $value['Kd_Kel'];
    $Kd_Urut= $value['Kd_Urut_Kel'];
    $Kd_Lingkungan= $value['Kd_Lingkungan'];
    $Nm_Lingkungan= $value['Nm_Lingkungan'];
    $btn_hapus = "<a href='#'  class='hapus_lingkungan' title='Hapus Lingkungan' data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' data-kel='$Kd_Kel' data-urut='$Kd_Urut' data-lingkungan='$Kd_Lingkungan'><i class='glyphicon glyphicon-trash'></i></a>";
		echo "<tr>
							<td data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' data-urut='$Kd_Urut' data-lingkungan='$Kd_Lingkungan' class='data-ling'>$Nm_Lingkungan </td>
							<td></td>
					</tr>";
	}
	/*
	echo "
		<tr><td colspan='2'>&nbsp;</td></tr>
		<tr>
			<td colspan='2'><button data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' data-kel='$Kd_Kel' data-urutkel='$Kd_Urut' class='btn btn-primary btn-urut'>Urutkan</button></td>
		</tr>
	";
	*/
?>

<script type="text/javascript">
	// data jalan
	$(".data-ling").click(function(){
		var prov = $(this).data('prov');
		var kab = $(this).data('kab');
		var kec = $(this).data('kec');
		var urut = $(this).data('urut');
		var lingkungan = $(this).data('lingkungan');
		//alert("index.php?r=explorer/getjalan&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Lingkungan="+lingkungan);
		$.ajax({
	    url: "index.php?r=explorer/getjalan",
	    data: "Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Lingkungan="+lingkungan,
	    success: function(jalan) {
	    	$('#list-jalan').html(jalan);
	    	//alert(ling);
	    }
	  });
	});

	// data usulan
	$(".data-ling").click(function(){
		var prov = $(this).data('prov');
		var kab = $(this).data('kab');
		var kec = $(this).data('kec');
		var urut = $(this).data('urut');
		var lingkungan = $(this).data('lingkungan');
		$('#list-usulan').html('');
		$('#list-jalan').html('');
		$('#list-usulanjalan').html('');
		//alert("index.php?r=explorer/getusulan&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Lingkungan="+lingkungan);
		$.ajax({
	    url: "index.php?r=explorer/getusulan",
	    data: "Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Lingkungan="+lingkungan,
	    success: function(usulan) {
	    	$('#list-usulan').html(usulan);
	    	//alert(ling);
	    }
	  });
	});

	$(".hapus_lingkungan").click(function(){
		var prov = $(this).data('prov');
		var kab = $(this).data('kab');
		var kec = $(this).data('kec');
		var kel = $(this).data('kel');
		var urut = $(this).data('urut');
		var lingkungan = $(this).data('lingkungan');

		$('#form_prov').val(prov);
		$('#form_kab').val(kab);
		$('#form_kec').val(kec);
		$('#form_kel').val(kel);
		$('#form_urut').val(urut);
		$('#form_lingkungan').val(lingkungan);

		$('#myModal').modal('show');
	});

	$("#btn_hapus_lingkungan").click(function(){
		//alert(prov);
		//alert("index.php?r=explorer/hapuslingkungan"+"&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut+"&Kd_Lingkungan="+lingkungan);
		//var datastring = $("#form_lingkungan_hapus").serialize();
		$.ajax({
		    type: "POST",
		    url: "index.php?r=explorer/hapuslingkungan",
		    data: $("#form_lingkungan_hapus").serialize(),
		    success: function(data) {
		    	$('#myModal').modal('hide');
		    	//$('#list-ling').html('');
		      //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
		      // do what ever you want with the server response
		    }
		});
	});

	$(".btn-urut").click(function(){
		var prov = $(this).data('prov');
		var kab = $(this).data('kab');
		var kec = $(this).data('kec');
		var kel = $(this).data('kel');
		var urutkel = $(this).data('urutkel');
		//alert("index.php?r=dodol/lingkungan"+"&"+"Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+kel+"&Kd_Urut_Kel="+urutkel);
		$.ajax({
		    type: "get",
		    url: "index.php?r=dodol/lingkungan",
		    data: "Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+kel+"&Kd_Urut_Kel="+urutkel,
		    success: function(data) {
		    	alert('berhasil');
		    	//alert(data);
		    	//$('#list-ling').html('');
		        //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
		        // do what ever you want with the server response
		    },
		    error: function() {
		      alert('error ajax');
		    }
		});
	});
</script>