$('.uang').number( true, 2, ',', '.' );

function get_usulan(){
  var Kd_Lingkungan = $('#select-lingkungan').val();
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan%2Fget-verifikasi&Kd_Lingkungan='+Kd_Lingkungan+'&status=tolak');
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan%2Fget-verifikasi',
    data:{Kd_Lingkungan : Kd_Lingkungan, status:'tolak'},
    success: function(isi){
      $("#body-tabel").html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
}

$("#select-lingkungan").change(function(){
  get_usulan();
});

$("#btn-simpan-terima").click(function(){
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/terima-usulan&'+$('#form-terima').serialize());
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-terima-usulan2',
    data:$('#form-terima').serialize(),
    success: function(isi){
      alert(isi);
      get_usulan();
      load_jumlah();
      $('#modal_terima').modal('hide');
    },
    error: function(){
      alert("failure");
    }
  });
});