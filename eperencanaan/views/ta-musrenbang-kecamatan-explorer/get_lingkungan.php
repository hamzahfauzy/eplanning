<?php  
	foreach ($lingkungan as $key => $value) :
	?>
		<tr class="ling-col">
			<td class="ling" data-kel='<?= $value->Kd_Kel ?>' data-urut='<?= $value->Kd_Urut_Kel ?>' data-lingkungan='<?= $value->Kd_Lingkungan ?>'><?= $value->Nm_Lingkungan ?></td>
		</tr>
	<?php  
	endforeach;
?>

<script type="text/javascript">
	$(".ling-col").click(function(){
	    $(".ling-col").removeClass("active");
	    $(this).addClass("active");
	});

	$(".ling").click(function(){
		$("#list-usulan-lingkungan").html('Loading...');
		var kel = $(this).data('kel');
		var urut = $(this).data('urut');
		var lingkungan = $(this).data('lingkungan');
		//alert(kel+" "+urut+" "+lingkungan);
		$.ajax({
		    type: "GET",
		    url: "index.php?r=ta-musrenbang-kecamatan-explorer/get-usulan-lingkungan",
		    data: {kel:kel, urut:urut, lingkungan:lingkungan },
		    success: function (isi) {
		        $("#list-usulan-lingkungan").html(isi);
		    },
		    error: function(){
		      alert("gagal download list lingkungan");
		    }
		});
	});

	
</script>