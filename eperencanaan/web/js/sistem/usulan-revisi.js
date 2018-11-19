$('.uang').number( true, 2, ',', '.' );

function get_usulan(){
  var Kd_Lingkungan = $('#select-lingkungan').val();
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan%2Fget-verifikasi',
    data:{Kd_Lingkungan : Kd_Lingkungan, status:'revisi'},
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
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-terima-usulan-verifikasi&'+$('#form-terima').serialize());
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-terima-usulan-verifikasi',
    data:$('#form-terima').serialize(),
    success: function(isi){
      alert(isi);
      get_usulan();
      $('#modal_terima').modal('hide');
    },
    error: function(){
      alert("failure");
    }
  });
});

$("#btn-simpan-revisi").click(function(){
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-revisi-usulan&'+$('#form-revisi').serialize());
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-revisi-usulan-verifikasi',
    data:$('#form-revisi').serialize(),
    success: function(isi){
      alert(isi);
      get_usulan();
      $('#modal_revisi').modal('hide');
    },
    error: function(){
      alert("failure");
    }
  });
});

$("#btn-simpan-tolak").click(function(){
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan&'+$('#form-tolak').serialize());
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan',
    data:$('#form-tolak').serialize(),
    success: function(isi){
      alert(isi);
      get_usulan();
      $('#modal_tolak').modal('hide');
    },
    error: function(){
      alert("failure");
    }
  });
});