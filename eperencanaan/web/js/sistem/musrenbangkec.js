$('#cari-button').click(function(){
 
    //alert($('#search-usulan').serialize()); die();
      $('#body-tabel').html('<tr><td colspan=10><h3>Mohon Tunggu Sebentar...</h3></td></tr>');
    $.ajax({
       type: "POST",
       data: $('#search-usulan').serialize(),
       url: 'index.php?r=ta-musrenbang-kecamatan-report/index',
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



$('#cari-button-pasca').click(function(){
 
    //alert($('#search-usulan').serialize()); die();
      $('#body-tabel').html('<h3>Mohon Tunggu Sebentar...</h3>');
    $.ajax({
       type: "POST",
       data: $('#search-usulan').serialize(),
       url: 'index.php?r=ta-musrenbang-kecamatan-report/pasca',
       success: function(data){
           //alert(data);
           $('#body-tabel').html(data);
       },
       error: function(xhr, status, data){
           alert(xhr.responseText);
       }
    });
});

// $('#cari-button-paska').click(function(){
//   alert("afdfaf");
//     //alert($('#search-usulan').serialize());
//      $('#body-tabel').html('<h3>Mohon Tunggu Sebentar...</h3>');
//     $.ajax({
//        type: "POST",
//        data: $('#search-usulan').serialize(),
//        url: 'index.php?r=ta-musrenbang-kecamatan-report/pasca',
//        success: function(data){
//            //alert(data);
//            $('#body-tabel').html(data);
//        },
//        error: function(xhr, status, data){
//              alert(xhr.responseText);
//        }
//     });
// });


