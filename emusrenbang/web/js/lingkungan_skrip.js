
$('.rupiah').number( true, 2, ',', '.' );
$('.uang').number( true, 2, ',', '.' );

$('.nomor').number( true, 2, ',', '.' );

$(".hitung").keyup(function(){
    var jumlah = $('#jumlah').val();
    var harga = $('#harga').val();
    var total = jumlah*harga;
    //alert(total);
    $('#total').val(total);
});

