$('#cari-button').click(function(){
    //alert($('#search-usulan').serialize()); die();
      $('#body-tabel').html('<h3>Mohon Tunggu Sebentar...</h3>');
    $.ajax({
       type: "POST",
       data: $('#search-usulan').serialize(),
       url: 'index.php?r=ta-musrenbang-kecamatan-cetak/tve312',
       success: function(data){
           //alert(data);
           $('#body-tabel').html(data);
       },
       error: function(xhr, status, data){
           alert(xhr.responseText);
       }
    });
});

$('#cari-button-tve313').click(function(){
    //alert($('#search-usulan').serialize()); die();
      $('#body-tabel').html('<h3>Mohon Tunggu Sebentar...</h3>');
    $.ajax({
       type: "POST",
       data: $('#search-usulan').serialize(),
       url: 'index.php?r=ta-musrenbang-kecamatan-cetak/tve313',
       success: function(data){
           //alert(data);
           $('#body-tabel').html(data);
       },
       error: function(xhr, status, data){
           alert(xhr.responseText);
       }
    });
});


$('#cari-button-tve314').click(function(){
    //alert($('#search-usulan').serialize()); die();
      $('#body-tabel').html('<h3>Mohon Tunggu Sebentar...</h3>');
    $.ajax({
       type: "POST",
       data: $('#search-usulan').serialize(),
       url: 'index.php?r=ta-musrenbang-kecamatan-cetak/tve314',
       success: function(data){
           //alert(data);
           $('#body-tabel').html(data);
       },
       error: function(xhr, status, data){
           alert(xhr.responseText);
       }
    });
});

$('#kata-kunci').keydown(function(event){
    if(event.keyCode == 13){
        event.stopPropagation();
        $('#cari-button').click();
    }
    
});
