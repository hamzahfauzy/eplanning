<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<input type="text" id="cari_asb" placeholder="Cari" class="form-control">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Kode ASB</th>
			<th>Uraian</th>
			<th>Satuan</th>
			<th>Spesifikasi</th>
			<th>Harga</th>
			<th>Pilihan</th>
		</tr>
	</thead>
	<tbody id="body_tabel_asb">
	</tbody>
</table>

<script type="text/javascript">
	$("#cari_asb").keypress(function(e) {
    if(e.which == 13) {
    	var cari = $(this).val();
		if(cari == ""){
			$("#body_tabel_asb").html('<tr><td colspan=5>Keyword Tidak Boleh Kosong</td></tr>');
			return;
		}
    	$("#body_tabel_asb").html('<tr><td colspan=6>Mencari...</td></tr>');
		$.get('/../../standarharga5/index.php?action=api&asb='+cari,function(response){
			if(response){
				rows="";
				$.each(response, function(index, asb){
					rows += "<tr><td><b>"+asb.D+"</b></td>";
					rows += "<td>"+asb.C+"</td>";
					rows += "<td>"+asb.E+"</td>";
					rows += "<td>"+asb.J+"</td>";
					rows += "<td>"+numberFormat(asb.G)+"</td>";
					rows += "<td><button type='button' class='btn btn-primary' onclick='pilih(this);' data-kd='' data-uraian='"+asb.D+"' data-barang='"+asb.C+"' data-harga='"+asb.G+"' data-satuan='"+asb.E+"'>Pakai</button></td></tr>";
					
				});
				$("#body_tabel_asb").html(rows);
			}else{
				$("#body_tabel_asb").html('<tr><td colspan=5>Data Tidak Ada</td></tr>');
			}
				//console.log(response);
		},"json");
		/*
    	$("#body_tabel_asb").html('Mencari...');
		
    	$.ajax({ 
		    type: "GET",
		    url:'index.php?r=ajax/get-asb',
		    data:{cari:cari},
		    success: function(isi){
		      $("#body_tabel_asb").html(isi);
		    },
		    error: function(){
		      alert("failure");
		    }
		  });*/
    }
	});
	
	function pilih(obj){
		//console.log($(this).data);
		
		var barang = $(obj).data('barang');
		var harga = $(obj).data('harga');
		var satuan = $(obj).data('satuan');
		var uraian = $(obj).data('uraian');
		var kd = $(obj).data('kd');
		//alert(uraian);

		$("#nilai_obyek").val(harga);
		$("#Uraian_Asal_Biaya").val(uraian);

		$("#uraian_obyek").val(barang);
		$("#judul").val(barang);
		$("#satuan option:contains(" + satuan + ")").attr('selected', 'selected');
		$("#asal_biaya").val('3');
		$("#Uraian_Asal_Biaya").val(uraian);
		//$('#satuan1 option[value='+satuan+']').attr('selected','selected');
		
		setTimeout(function(){
			$('#pilihAsbModal').modal('hide')
 		}, 100);
	}
	function numberFormat(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
</script>