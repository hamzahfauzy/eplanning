$(document).ready(function(){
	//alert(1);
});
alasan = "", id="";
$("#cari-usulan").click(function(){
	stt = $("#status-usulan").val();
	pbp = $("#prioritas-bid-pem").val();
	kec = $("#select-kecamatan").val();
	pkk = $("#select-pokir").val();
	$.get("index.php?r=musrenbang-skpd/get-usulan-pokir&status="+stt+"&prioritas="+pbp+"&kec="+kec+"&pokir="+pkk,function(response){
		$('#tbl_usulan_kecamatan > tbody:last-child').empty();
		$('#tbl_usulan_kecamatan > tbody:last-child').append(response);
	});
});

$("#cetak-usulan").click(function(){
	Kd = $("#select-kecamatan").val();
	stt = $("#status-usulan").val();
	pbp = $("#prioritas-bid-pem").val();
	pkk = $("#select-pokir").val();
	link="index.php?r=musrenbang-skpd/cetak-usulan-pokir&Kd_Kec="+Kd+"&status="+stt+"&prioritas="+pbp+"&pokir="+pkk;
	window.open(link,'_blank');
	
	return false;
});

function showToModal(val){
	$.get("index.php?r=musrenbang-skpd/show-usulan-pokir&id="+val,function(response){
		s = "<table class='table table-bordered'>";
		$.each(response, function(key, value){
			$.each(value, function(key, value){
				if(	key !== "Rincian_Skor" && 
					key == "Tahun" || 
					key == "Nm_Permasalahan" ||
					key == "Jenis_Usulan" ||
					key == "Detail_Lokasi" ||
					key == "Jumlah" ||
					key == "Harga_Total")
					{
						if(key == "Harga_Total")
							value = "Rp."+(numberFormat(value));
					s += "<tr><td>"+key+"</td><td>:</td><td>"+ value+"</td></tr>";
					}
			});
		});
		$("#res").html(s+"</table>");
		$("#btnterima").attr("href","index.php?r=musrenbang-skpd/usulan-terima&id="+val);
	},"json");
}
				
	
function showToModalTerima(val){
	$.get("index.php?r=musrenbang-skpd/show-usulan-pokir&id="+val,function(response){
		s = "<table class='table table-bordered'>";
		$.each(response, function(key, value){
			$.each(value, function(key, value){
				if(	key !== "Rincian_Skor" && 
					key == "Tahun" || 
					key == "Nm_Permasalahan" ||
					key == "Jenis_Usulan" ||
					key == "Detail_Lokasi" ||
					key == "Jumlah" ||
					key == "Harga_Total")
					{
						if(key == "Harga_Total")
							value = "Rp."+(numberFormat(value));
					s += "<tr><td>"+key+"</td><td>:</td><td>"+ value+"</td></tr>";
					}
			});
		});
		$("#res_terima").html(s+"</table>");
		id = val;
	},"json");
}

$("#btnterima").click(function(){
	alasan = $("#alasan_terima").val();
	location="index.php?r=musrenbang-skpd/usulan-terima&id="+id+"&alasan="+alasan;
});


	
function showToModalTolak(val){
	$.get("index.php?r=musrenbang-skpd/show-usulan-pokir&id="+val,function(response){
		s = "<table class='table table-bordered'>";
		$.each(response, function(key, value){
			$.each(value, function(key, value){
				if(	key !== "Rincian_Skor" && 
					key == "Tahun" || 
					key == "Nm_Permasalahan" ||
					key == "Jenis_Usulan" ||
					key == "Detail_Lokasi" ||
					key == "Jumlah" ||
					key == "Harga_Total")
					{
						if(key == "Harga_Total")
							value = "Rp."+(numberFormat(value));
					s += "<tr><td>"+key+"</td><td>:</td><td>"+ value+"</td></tr>";
					}
			});
		});
		$("#res_tolak").html(s+"</table>");
		id = val;
	},"json");
}

$("#btntolak").click(function(){
	alasan = $("#alasan_tolak").val();
	location="index.php?r=musrenbang-skpd/usulan-tolak&id="+id+"&alasan="+alasan;
});
		
function numberFormat(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

//Ditambah by Ripin G
function hitung(id){
	//alert(id);
	$('#skoringModal').modal('show')
	          .find('#skoringContent')
	          .load('index.php?r=musrenbang-skpd/modal-skoring&id='+id);
	$('#btn_skoring_simpan').attr('disabled', false);
}

$("#btn_skoring_simpan").click(function(){
		//alert($("#skoring_form").serialize());
		var id = $("#id_skoring").val();
		var isi_skor = $("#isi_skor").val();

	  $('#btn_skoring_simpan').attr('disabled', true);
	  //alert(1);
		$.ajax({ 
	    type: "POST",
	    url:'index.php?r=musrenbang-skpd/skoring-simpan',
	    data:$("#skoring_form").serialize(),
	    success: function(isi){
	    	$('#skoringContent').html(isi);
	    	$("#pilih-skor"+id).html(isi_skor);
	    	$("#cari-usulan").trigger('click');
	    	//alert(isi);
	    	//$("#btn-hitung"+id).attr('disabled', true);
	    	//$("#slc-prioritas"+id).attr('disabled', true);
				//$("#skpd-"+id).attr('disabled', true);
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});