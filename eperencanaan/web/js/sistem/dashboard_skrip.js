$('.rupiah').number( true, 2, ',', '.' );
$('.uang').number( true, 2, ',', '.' );

$('.btn-refresh').click(function(){
    location.reload();
});

$("#absen_btn").click(function(){
  setTimeout(function(){// wait for 5 secs(2)
       location.reload(); // then reload the page.(3)
  }, 2000); 
});

