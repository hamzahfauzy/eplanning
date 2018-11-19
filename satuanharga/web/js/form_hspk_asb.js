//-----------------skrip asb1 - 3-------------------//
$('#Kd_Asb1').change(function(){
    var Kd_Asb1=$(this).val();
    $('#kdasb1').val(Kd_Asb1);
    //alert(Kd_Urusan);
    $.post('index.php?r=ajax/getasb2&Kd_Asb1='+Kd_Asb1, function(data){
        //alert(data);
        $('#Kd_Asb2').html(data);
    })
})

$('#Kd_Asb2').change(function(){
    var Kd_Asb1=$("#Kd_Asb1").val();
    var Kd_Asb2=$(this).val();
    $.post('index.php?r=ajax/getasb3&Kd_Asb1='+Kd_Asb1+'&Kd_Asb2='+Kd_Asb2, function(data){
        $('#Kd_Asb3').html(data);
    })
})

$('#Kd_Asb3').change(function(){
    var Kd_Asb1=$("#Kd_Asb1").val();
    var Kd_Asb2=$("#Kd_Asb2").val();
    var Kd_Asb3=$(this).val();
    $.post('index.php?r=ajax/getasb4&Kd_Asb1='+Kd_Asb1+
                                    '&Kd_Asb2='+Kd_Asb2+
                                    '&Kd_Asb3='+Kd_Asb3, function(data){
        $('#Kd_Asb4').html(data);
    })
})

//-----------------akhir skrip asb1 - 3-------------------//

//-----------------awal skrip sumber-------------------//
$("#Asal").change(function(){
  var Asal = $(this).val();
  $.post('index.php?r=ref-asb/get-form&Asal='+Asal, function(data){
    $("#borang_wrap").html(data);
  })
});

$("#Kategori_Pekerjaan").change(function(){
  //alert($("#Kategori_Pekerjaan option:selected").text());
  $("#Kategori_Pekerjaan_Nama").val($("#Kategori_Pekerjaan option:selected").text());
});
//-----------------akhir skrip sumber-------------------//

//-----------------awal skrip sumber-------------------//
function get_data_cookie(){
  $.ajax({ 
    type: "GET",
    url: 'index.php?r=ajax/get-cookie',
    data: '',
    success: function(isi){
      $("#wrap-data").html(isi);
      var jumlah_hspk=$("#jumlah_hspk").html();
      $("#harga_asb").val(jumlah_hspk);
    },
    error: function(){
      $("#wrap-data").html('');
    }
  });
}
get_data_cookie();
//-----------------akhir skrip sumber-------------------//