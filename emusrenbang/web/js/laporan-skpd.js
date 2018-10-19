$('#btn_tampil').on('click', function () {
  var Kd_Keg = $('#Kd_Keg').val();
  $("#laporan_rka_tampil").html('<center><img src="http://acceleratedincomesystem.com/img/loading-gif.gif"></center>');
  $.ajax({ 
    type: "post",
    url:'index.php?r=laporan-skpd/laporan-rka-tampil',
    data:{Kd_Keg : Kd_Keg},
    success: function(isi){
      $("#laporan_rka_tampil").html(isi);
      $('#btn_cetak').prop( "disabled", false );
    },
    error: function(a,b,c){
      $("#laporan_rka_tampil").html('<h3 align=center>Silahkan pilih program</h3>');
    }
  });
});

$('#Kd_Prog').change(function(){
    var Kd_Prog = $('#Kd_Prog').val();
    $('#loading').html('<img src="http://www.worldpoliticsreview.com/images/ajax-loader.gif">');
    $.ajax({ 
    type: "post",
    url:'index.php?r=laporan-skpd/get-kegiatan',
    data:{Kd_Prog : Kd_Prog},
    success: function(isi){
      $('#loading').html('');
      $("#Kd_Keg").html(isi);
    },
    error: function(a,b,c){
      $("#laporan_rka_tampil").html('<h3 align=center>Silahkan pilih kegiatan</h3>');
    }
  });
})
/*
$('#btn_tampil1').on('click', function () {
  var Kd_Kec = $('#Kd_Kec').val();
  $("#rekapskpd1").html('<center><img src="http://acceleratedincomesystem.com/img/loading-gif.gif"></center>');
  $.ajax({ 
    type: "post",
    url:'index.php?r=laporan-skpd/rekapskpd',
    data:{Kd_Kec : Kd_Kec},
    success: function(isi){
      $("#rekapskpd1").html(isi);
      $('#btn_cetak').prop( "disabled", false );
    },
    error: function(a,b,c){
      $("#rekapskpd1").html('<h3 align=center>Silahkan pilih program</h3>');
    }
  });
}); */