/*
function get_lingkungan(){
	$(".data-kel").click(function(){
		var prov = $(this).data('prov');
		var kab = $(this).data('kab');
		var kec = $(this).data('kec');
		var urut = $(this).data('urut');
		//alert("index.php?r=explorer/getling&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut);
		$.ajax({
	    url: "index.php?r=explorer/getling",
	    data: "Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec+"&Kd_Kel="+urut,
	    success: function(data) {
	    	$('#list-ling').html(data);
	    }
	  });
	});
}
*/

$(".data-kec").click(function(){
	var prov = $(this).data('prov');
	var kab = $(this).data('kab');
	var kec = $(this).data('kec');
	//alert("index.php?r=explorer/getkel?Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec);
	$.ajax({
    url: "index.php?r=explorer/getkel",
    data: "Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec,
    success: function(data) {
	    $('#list-ling').html('');
    	$('#list-kel').html(data);
    	get_lingkungan();
    }
  });
});

$(".detail_kecamatan").click(function(){
	var prov = $(this).data('prov');
	var kab = $(this).data('kab');
	var kec = $(this).data('kec');
	//alert("index.php?r=explorer/modal-detail-kecamatan&Kd_Prov="+prov+"&Kd_Kab="+kab+"&Kd_Kec="+kec);
	$.ajax({
    type: "POST",
    url: "index.php?r=explorer/modal-detail-kecamatan",
    data: {prov:prov, kab:kab, kec:kec},
    success: function(data) {
    	//alert(data);
    	$('#modal_detail_kecamatan').html(data);
    	$('#modal_detail_kecamatan').modal('show');
    }
  });
});

$(".kec-col").click(function(){
	$(".kec-col").removeClass("active");
	$(this).addClass("active");
});