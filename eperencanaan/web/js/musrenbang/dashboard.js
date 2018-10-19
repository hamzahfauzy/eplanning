
$("#btn_load").click(function(){
	$('#ambilModal').modal('show')
          .find('#ambilContent')
          .load('index.php?r=ta-musrenbang-kecamatan/modal-ambil');
  
});
$("#btn_load_opd").click(function(){
	$('#ambilModal').modal('show') 
          .find('#ambilContent')
          .load('index.php?r=musrenbang-skpd/show');
  $('#btn_ambil_simpan').attr('disabled', false);
});


 
$("#btn_ambil_simpan").click(function(){
	$("#btn_ambil_simpan").attr('disabled', true);
	$('#modal_ambil_loading').css({'display':'block'});
	$('#modal_ambil_isi').css({'display':'none'});
  $.ajax({ 
    type: "POST",
    url:'index.php?r=musrenbang-kecamatan/import-usulan',
    data:'',
    success: function(isi){
      $("#ambilContent").html(isi);
      $("#btn_ambil_cancel").html('Tutup');
    },
    error: function(){
      alert("failure");
    }
  });
  
});

$("#btn_ambil_simpan_opd").click(function(){
	$("#btn_ambil_simpan_opd").attr('disabled', true);
	$('#modal_ambil_loading').css({'display':'block'});
	$('#modal_ambil_isi').css({'display':'none'});
  $.ajax({ 
    type: "POST",
    url:'index.php?r=musrenbang-skpd/import-usulan',
    data:'',
    success: function(isi){
      $("#ambilContent").html(isi);
      $("#btn_ambil_cancel").html('Tutup');
    },
    error: function(){
      alert("failure");
    }
  });
});

$("#btn_ambil_cancel").click(function(){
  var isi_tbl = $("#btn_ambil_cancel").html();

  if (isi_tbl=='Tutup') {
    location.reload();
  }
});

$("#btn-kirim-skpd").click(function(){
  $("#btn-kirim-skpd").attr('disabled', true);
  //$("#modal-skpd-content").html("Proses ...");
  $('#modal_selesai_loading').css({'display':'block'});
  $('#modal_selesai_isi').css({'display':'none'});
  $.ajax({ 
    type: "POST",
    url:'index.php?r=ta-musrenbang-kecamatan-acara/selesai',
    data:'',
    success: function(isi){
      $("#modal-skpd-content").html(isi);
      location.reload();
    },
    error: function(){
      alert("failure");
    }
  });
});

$("#btn-kirim-opd").click(function(){
  $("#btn-kirim-opd").attr('disabled', true);
  //$("#modal-skpd-content").html("Proses ...");
  $('#modal_selesai_loading').css({'display':'block'});
  $('#modal_selesai_isi').css({'display':'none'});
  $.ajax({ 
    type: "POST",
    url:'index.php?r=musrenbang-skpd-acara/selesai',
    data:'',
    success: function(isi){
      $("#modal-skpd-content").html(isi);
      location.reload();
    },
    error: function(){
      alert("failure");
    }
  });
});

