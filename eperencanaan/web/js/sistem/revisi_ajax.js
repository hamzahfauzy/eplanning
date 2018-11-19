
$("#btn-revisi").click(function(){
  alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan&');
  var value = $("#btn-revisi").attr("data-kd");
    $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/revisi',
    data:{Kd_Ta_Forum_Lingkungan: value},
    success: function(isi){
      $('#revisi-body').html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
});

$("#btn-simpan-revisi").click(function(){
  alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan&'+$('#form-tolak').serialize());
  $.ajax({ 
    type: "POST",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/revisi',
    data:$('#revisi').serialize(),
    success: function(isi){
      alert(isi);
      get_usulan();
      $('#revisi').modal('hide');
    },
    error: function(){
      alert("failure");
    }
  });
});