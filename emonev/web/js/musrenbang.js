

$(".lihat_file").click(function(){
  var alamat = $(this).data('url');
 alert(alamat);
  $('#lihatFileModal').modal('show')
        .find('#isi_modal')
        .html("Loading...");

  $.ajax({ 
    type: "GET",
    url: alamat,
    data:'',
    success: function(isi){
      $('#lihatFileModal')
        .find('#isi_modal')
        .html(isi);
		//$('#res_foto').html(isi);
		
    },
    error: function(){
      alert("gagal");
    }
  });
});
/*
$(".lihat_file").click(function(){
	 var alamat = $(this).data('url');
	 alert (alamat);
		$.get('url', function(response){
			
			$("#response-modal").html(response);
			$("#myModal").modal();
			
		});
		
	} */