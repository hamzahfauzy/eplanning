/*
$('#Kd_Kec').change(function(){
    var Kd_Kec=$(this).val();
    //alert(Kd_Kec);
    $.post('index.php?r=ajax/getkel&Kd_Kec='+Kd_Kec, function(data){
        //alert(data);
        $('#Kd_Kel').html(data);
    })
})

$('#Kd_Kel').change(function(){
    var Kd_Kel=$(this).val();
    var Kd_Kec=$("#Kd_Kec").val();
    //alert(kode);
    $.post('index.php?r=ajax/getlingkungan&Kd_Kel='+Kd_Kel+'&Kd_Kec='+Kd_Kec, function(data){
        //alert(data);
        $('#Kd_Lingkungan').html(data);
    })
})
*/

$("#drop_kec").change(function(){
    var Kd_Kec = $(this).val();
    $.ajax({
      url: "index.php?r=ajax/getkel",
      data: "Kd_Kec="+Kd_Kec,
      success: function(data) {
         $('#drop_kel').html(data);
      }
    });
});

$("#drop_kel").change(function(){
    var Kd_Kec = $('#drop_kec').val();
    var Kd_Kel = $(this).val();
    //alert("index.php?r=ajax/getling"+"Kd_Kec="+Kd_Kec+"Kd_Kel="+Kd_Kel);
    $.ajax({
      url: "index.php?r=ajax/getling",
      data: "Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel,
      success: function(data) {
        $('#drop_ling').html(data);
      }
    });
});


$("#drop_ling").change(function(){
    var Kd_Kec = $('#drop_kec').val();
    var Kd_Kel = $('#drop_kel').val();
    var Kd_Ling = $(this).val();
    //alert("index.php?r=ajax/getusulan"+"&Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel+"&Kd_Ling="+Kd_Ling);
    $.ajax({
      url: "index.php?r=ajax/getusulan",
      data: "Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel+"&Kd_Ling="+Kd_Ling,
      success: function(data) {
        //alert(data);
        $("#isi_usulan").html(data);
      }
    });
});