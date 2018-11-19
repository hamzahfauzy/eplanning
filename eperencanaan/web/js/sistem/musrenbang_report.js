$('#cari-button').click(function(){
    //alert($('#search-usulan').serialize());
     $('#body-tabel').html('<h3>Mohon Tunggu Sebentar...</h3>');
    $.ajax({
       type: "POST",
       data: $('#search-usulan').serialize(),
       url: 'index.php?r=ta-musrenbang-kelurahan-report/index',
       success: function(data){
           //alert(data);
           $('#body-tabel').html(data);
       },
       error: function(xhr, status, data){
           alert(data.Message);
       }
    });
});

$('#kata-kunci').keydown(function(event){
    if(event.keyCode == 13){
        event.stopPropagation();
        $('#cari-button').click();
    }
    
});

$('#cari-button-pasca').click(function(){
    //alert($('#search-usulan').serialize());
     $('#body-tabel').html('<h3>Mohon Tunggu Sebentar...</h3>');
    $.ajax({
       type: "POST",
       data: $('#search-usulan').serialize(),
       url: 'index.php?r=ta-musrenbang-kelurahan-report/pasca',
       success: function(data){
           //alert(data);
           $('#body-tabel').html(data);
       },
       error: function(xhr, status, data){
           alert(status);
       }
    });
});

