function load_jumlah(){
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/jumlah-usulan',
    data:'',
    success: function(isi){
      var result=isi.split('|');
      var usulan = result[0];
      var ditolak = result[1];
      var diterima = result[2];
      $("#jlh-usulan").html(usulan);
      $("#jlh-ditolak").html(ditolak);
      $("#jlh-diterima").html(diterima);
    },
    error: function(){
      alert("failure");
    }
  });
}

load_jumlah();