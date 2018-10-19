$('.uang').number( true, 2, ',', '.' );
function get_usulan(){
  var Kd_Lingkungan = $('#select-lingkungan').val();
  var BidPem = $('#select-bidpem').val();
   $("#body-tabel").html("<h3>Mohon tunggu sebentar, data sedang dibuka...</h3>");
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan%2Fget-verifikasi&Kd_Lingkungan='+Kd_Lingkungan+'&status=tolak');
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan%2Fget-terima',
    data:{Kd_Lingkungan : Kd_Lingkungan, status:'terima', bidpem:BidPem},
    success: function(isi){
      $("#body-tabel").html(isi);
    },
    error: function(xhr, status, error){
      $('#body-tabel').html(xhr.responseText);
    }
  });
}

$("#btn-cari").click(function(){
  get_usulan();
});

$("#btn-simpan-tolak").click(function(){
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan&'+$('#form-tolak').serialize());
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan2',
    data:$('#form-tolak').serialize(),
    success: function(isi){
      alert(isi);
      get_usulan();
      load_jumlah();
      $('#modal_tolak').modal('hide');
    },
    error: function(){
      alert("failure");
    }
  });
});



$("#btn-revisi").click(function(){
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan&');
  /*
    var value = $("#btn-revisi").attr("data-kd");
    $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/revisi',
    data:{Kd_Ta_Forum_Lingkungan: value},
    success: function(isi){
      $('#revisi-body').html(isi);
      $('#btn-simpan-revisi').attr("data-kr", value);
    },
    error: function(){
      alert("failure");
    }
  });*/
});