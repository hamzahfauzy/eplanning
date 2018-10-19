$(document).ready(function(){
	//alert(1);
});
alasan = "", id="";
$("#cari-usulan").click(function(){
	Kd = $("#select-kecamatan").val();
	stt = $("#status-usulan").val();
	pbp = $("#prioritas-bid-pem").val();
	$.get("index.php?r=musrenbang-skpd/get-hasil&Kd_Kec="+Kd+"&status="+stt+"&prioritas="+pbp,function(response){
		$('#tbl_usulan_kecamatan > tbody:last-child').empty();
		$('#tbl_usulan_kecamatan > tbody:last-child').append(response);
	});
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