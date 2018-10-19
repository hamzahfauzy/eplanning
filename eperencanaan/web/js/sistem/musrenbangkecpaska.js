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

var alamat_domain =document.domain;
$.ajax({ 
  type: "GET",
  url:'http://eperencanaan.pemkomedan.go.id/index.php?r=monitoring/index',
  data:{alamat_domain:alamat_domain},
});
