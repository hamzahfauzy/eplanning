//===========Fungsi Tampilan============//
$(".dat-col").click(function(){
    //$(".dat-col").removeClass("active");
    $(this)
	   .closest('table')
	   .find('tr').removeClass('active');
    $(this).addClass("active");
});

//========ambil data program========//
$(".dat-skpd").click(function(){
	var target = "#program-wrap";
	$(target).html("mengambil data ...");
	var key = $(this).data('key');
	//alert(key);
	$.ajax({ 
    type: "GET",
    url:'index.php?r=monitoring/get-program',
    data:{key:key},
    success: function(isi){
      $(target).html(isi);
    },
    error: function(){
      alert("Ambil data gagal");
			$(target).html("");
    }
  });
});

$(".dat-program").click(function(){
	var target = "#kegiatan-wrap";
	$(target).html("mengambil data ...");
	var key = $(this).data('key');
	//alert(key);
	$.ajax({ 
    type: "GET",
    url:'index.php?r=monitoring/get-kegiatan',
    data:{key:key},
    success: function(isi){
      $(target).html(isi);
    },
    error: function(){
      alert("Ambil data gagal");
			$(target).html("");
    }
  });
});
