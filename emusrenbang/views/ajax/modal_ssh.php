<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<input type="text" id="cari" placeholder="Cari" class="form-control">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No. Rekening</th>
			<th>Uraian</th>
			<th>Satuan</th>
			<th>Spesifikasi</th>
			<th>Harga</th>
			<th>Pilihan</th>
		</tr>
	</thead>
	<tbody id="body_tabel_ssh">
	</tbody>
</table>

<script type="text/javascript">
	$("#cari").keypress(function(e) {
    if(e.which == 13) {
    	var cari = $(this).val();
		if(cari == ""){
			$("#body_tabel_ssh").html('<tr><td colspan=5>Keyword Tidak Boleh Kosong</td></tr>');
			return;
		}
    	$("#body_tabel_ssh").html('<tr><td colspan=6>Mencari...</td></tr>');
		$.get('/../../standarharga5/index.php?action=api&ssh='+cari,function(response){
			if(response){
				rows="";
				$.each(response, function(index, ssh){
					rows += "<tr><td><b>"+ssh.C+"</b></td>";
					rows += "<td>"+ssh.D+"</td>";
					rows += "<td>"+ssh.F+"</td>";
					rows += "<td>"+ssh.E+"</td>";
					//rows += "<td>"+ssh.ssh_level_8_harga+"</td>";
					rows += "<td>"+numberFormat(ssh.G)+"</td>";
					rows += "<td><button type='button' class='btn btn-primary' onclick='pilih(this);' data-kd='' data-barang='"+ssh.D+"' data-harga='"+ssh.G+"' data-satuan='"+ssh.F+"' data-uraian='"+ssh.C+"'>Pakai</button></td></tr>";
					
				});
				$("#body_tabel_ssh").html(rows);
			}else{
				$("#body_tabel_ssh").html('<tr><td colspan=5>Data Tidak Ada</td></tr>');
			}
				//console.log(response);
		},"json");
		/*
    	$("#body_tabel_ssh").html('Mencari...');
    	$.ajax({ 
		    type: "GET",
		    url:'index.php?r=ajax/get-ssh',
		    data:{cari:cari},
		    success: function(isi){
		      $("#body_tabel_ssh").html(isi);
		    },
		    error: function(){
		      alert("failure");
		    }
		  });
		  */
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
		
		$("#uraian_obyek").val(barang);
		$("#judul").val(barang);
		$("#nilai_obyek").val(harga);
		//$("#satuan1").val(satuan);
		$("#satuan1").val(satuan).change();
		//$("#satuan").val(kd).change();
		$("#asal_biaya").val('1');
		$("#Uraian_Asal_Biaya").val(uraian);
		$("#satuan option:contains(" + satuan + ")").attr('selected', 'selected');
		setTimeout(function(){
			$('#pilihSshModal').modal('hide')
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