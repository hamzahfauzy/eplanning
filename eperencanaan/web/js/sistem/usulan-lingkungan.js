$('.uang').number( true, 2, ',', '.' );

function get_usulan(){
  var Kd_Lingkungan = $('#select-lingkungan').val();
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan%2Fget-usulan&Kd_Lingkungan='+Kd_Lingkungan);
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan%2Fget-usulan',
    data:{Kd_Lingkungan : Kd_Lingkungan},
    success: function(isi){
		//console.log(isi);
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

/*
$("#btn-simpan-terima").click(function(){
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/terima-usulan&'+$('#form-terima').serialize());
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-terima-usulan',
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
*/

$("#btn-simpan-tolak").click(function(){
  //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan&'+$('#form-tolak').serialize());
  //alert($('#form-tolak').serialize());
  var data = $('#form-tolak').serialize();
  var kd = $(this).data('kd');
  //$('#').html('<h3>Menyimpan...</h3>');
  //$(this).hide();
    $.ajax({ 
    type: "POST",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan&Kd_Ta_Forum_Lingkungan=' + kd,
    data:data,
    success: function(isi){
      alert(isi);
      //$('#form_tolak').html('<h3>' + isi + '</h3>');
      get_usulan();
      load_jumlah();
      
      $('#modal_tolak').modal('hide');
    },
    error: function(){
      alert("failure");
    }
  });
});
