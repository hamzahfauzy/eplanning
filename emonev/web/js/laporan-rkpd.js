$('#btn_tampil').on('click', function () {
  var Kd_Sub = $('#Kd_Sub').val();
  $("#laporan_rencana_program_daerah").html('<center><img src="">Mengambil data...</center>');
  $.ajax({ 
    type: "post",
    url:'index.php?r=laporan-rkpd%2Frencana-program-daerah-tampil',
    data:{Kd_Sub : Kd_Sub},
    success: function(isi){
      $("#laporan_rencana_program_daerah").html(isi);
      $('#btn_cetak').prop( "disabled", false );
    },
    error: function(a,b,c){
      $('#btn_cetak').prop( "disabled", true );
      $("#laporan_rencana_program_daerah").html('<h3 align=center>Silahkan pilih Sub Unit</h3>');
    }
  });
});





$(document).ready(function () {
  var Kd_Sub = $('#Kd_Sub').val();
  $("#laporan_rencana_program_daerah1").html('<center><img src="">Mengambil data...</center>');
  $.ajax({ 
    url:'index.php?r=laporan-rkpd%2Fcetak-lampiran3',
    data:{Kd_Sub : Kd_Sub},
    success: function(isi){
      $("#laporan_rencana_program_daerah1").html(isi);
      if ($("#laporan_rencana_program_daerah1").html()) {$('#btn_cetak').prop( "disabled", false );}
    },
    error: function(a,b,c){
      alert(b);
    }
  });
});
