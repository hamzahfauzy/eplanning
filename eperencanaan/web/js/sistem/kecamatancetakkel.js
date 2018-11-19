$('#cari-button').click(function(){
    //alert($('#search-usulan').serialize()); die();
      $('#body-tabel').html('<h3>Mohon Tunggu Sebentar...</h3>');
    $.ajax({
       type: "POST",
       data: $('#search-usulan').serialize(),
       url: 'index.php?r=ta-musrenbang-kecamatan-laporan-kelurahan/index',
       success: function(data){
           //alert(data);
           $('#body-tabel').html(data);
       },
       error: function(xhr, status, data){
           alert(xhr.responseText);
       }
    });
});



