
$("#pilih-skpd").change(function(){
	var urusan = $("#pilih-skpd option").filter(":selected").data('urusan');
	var bidang = $("#pilih-skpd option").filter(":selected").data('bidang');
	var unit = $("#pilih-skpd option").filter(":selected").data('unit');
	var sub = $("#pilih-skpd option").filter(":selected").data('sub');

	$('#urusan').val(urusan);
	$('#bidang').val(bidang);
	$('#unit').val(unit);
	$('#sub').val(sub);
});

$("#pilih-skpd-2").change(function(){
	var urusan = $("#pilih-skpd-2 option").filter(":selected").data('urusan');
	var bidang = $("#pilih-skpd-2 option").filter(":selected").data('bidang');
	var unit = $("#pilih-skpd-2 option").filter(":selected").data('unit');
	var sub = $("#pilih-skpd-2 option").filter(":selected").data('sub');

	$('#urusan').val(urusan);
	$('#bidang').val(bidang);
	$('#unit').val(unit);
	$('#sub').val(sub);
});

$( ".btn_link" ).click(function( event ) {
  event.preventDefault();  
  var urusan = $('#urusan').val();
	var bidang = $('#bidang').val();
	var unit = $('#unit').val();
	var sub = $('#sub').val();

	var tujuan = $(this).attr('href');
	var variabel = '&urusan='+urusan+'&bidang='+bidang+'&unit='+unit+'&sub='+sub;

	if ($("#pilih-skpd").val() == 0) {
		alert('Pilih SKPD terlebih dahulu');
	}
	else{
		var win = window.open(tujuan+variabel, '_blank');
		if (win) {
	    //Browser has allowed it to be opened
	    win.focus();
		} else {
		    //Browser has blocked it
		    alert('Please allow popups for this website');
		}
	}
});

$( ".btn_link_2" ).click(function( event ) {
  event.preventDefault();  
  var urusan = $('#urusan').val();
	var bidang = $('#bidang').val();
	var unit = $('#unit').val();
	var sub = $('#sub').val();

	var tujuan = $(this).attr('href');
	var variabel = '&urusan='+urusan+'&bidang='+bidang+'&unit='+unit+'&sub='+sub;

	if ($("#pilih-skpd-2").val() == 0) {
		alert('Pilih SKPD terlebih dahulu');
	}
	else{
		var win = window.open(tujuan+variabel, '_blank');
		if (win) {
	    //Browser has allowed it to be opened
	    win.focus();
		} else {
		    //Browser has blocked it
		    alert('Please allow popups for this website');
		}
	}
});

$('#btn_tampil').on('click', function () {
  var Kd_Keg = $('#Kd_Keg').val();
  $("#laporan_rka_tampil").html('<center><img src="http://acceleratedincomesystem.com/img/loading-gif.gif"></center>');
  $.ajax({ 
    type: "post",
    url:'index.php?r=laporan-bappeda/laporan-rka-tampil',
    data:{Kd_Keg : Kd_Keg},
    success: function(isi){
      $("#laporan_rka_tampil").html(isi);
      $('#btn_cetak').prop( "disabled", false );
    },
    error: function(a,b,c){
      $("#laporan_rka_tampil").html('<h3 align=center>Silahkan pilih program</h3>');
    }
  });
});

$('#Kd_Prog').change(function(){
    var Kd_Prog = $('#Kd_Prog').val();
    $('#loading').html('<img src="http://www.worldpoliticsreview.com/images/ajax-loader.gif">');
    $.ajax({ 
    type: "post",
    url:'index.php?r=laporan-bappeda/get-kegiatan',
    data:{Kd_Prog : Kd_Prog},
    success: function(isi){
      $('#loading').html('');
      $("#Kd_Keg").html(isi);
    },
    error: function(a,b,c){
    	alert('failure');
    }
  });
})

