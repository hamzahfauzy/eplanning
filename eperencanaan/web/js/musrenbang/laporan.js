
$("#btn_cari").click(function(){
    $('#isi-cetak').html('<h3 align="center">Mengambil data...</h3>');
    $.ajax({ 
    type: "POST",
    url:'index.php?r=ta-musrenbang-kecamatan-cetak/get-usulan',
    data:$("#form_cetak").serialize(),
    success: function(isi){
        $('#isi-cetak').html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
});

$("#kelurahan2").change(function(){
    var Kd_Kel = $(this).val();
    $.ajax({ 
        type: "GET",
        url:'index.php?r=ta-musrenbang-kecamatan-cetak/get-lingkungan',
        data:{Kd_Kel:Kd_Kel},
        success: function(isi){
          $("#lingkungan2").html(isi);
        },
        error: function(){
          alert("failure");
        }
    });
});