$('#Asal').change(function(){
    var Asal=$(this).val();

    if($('#Asal').val()==1){
     $.post('index.php?r=ajax/getssh&Asal='+Asal,
    function(data){ 
     $('#dataSH').html(data);
    })

    }else{
     $.post('index.php?r=ajax/gethspk&Asal='+Asal,
     function(data){  
        $('#dataSH').html(data);
    })
    }
})

$('#dataSH').change(function(){
    var Asal=$("#Asal").val();
    var dataSH=$(this).val();

    if($('#Asal').val()==1){
    $.post('index.php?r=ajax/getssh2&Kd_Ssh1='+dataSH, function(data){
        $('#Kd_Hspk_Ssh2').html(data);
    })
    }else{
    $.post('index.php?r=ajax/gethspk2&Kd_Hspk1='+dataSH, function(data){
        $('#Kd_Hspk_Ssh2').html(data);
     })       
    }
})

$('#Kd_Hspk_Ssh2').change(function(){
    var Asal=$("#Asal").val();
    var dataSH=$("#dataSH").val();
    var Kd_Hspk_Ssh2=$(this).val();

    if($('#Asal').val()==1){
    $.post('index.php?r=ajax/getssh3&Kd_Ssh1='+dataSH+'&Kd_Ssh2='+Kd_Hspk_Ssh2, function(data){
        
        $('#Kd_Hspk_Ssh3').html(data);
    })
    }else{
    $.post('index.php?r=ajax/gethspk3&Kd_Hspk1='+dataSH+'&Kd_Hspk2='+Kd_Hspk_Ssh2, function(data){
        $('#Kd_Hspk_Ssh3').html(data);
     })       
    }
})


$('#Kd_Hspk_Ssh3').change(function(){
    var Asal=$("#Asal").val();
    var dataSH=$("#dataSH").val();
    var Kd_Hspk_Ssh2=$("#Kd_Hspk_Ssh2").val();
    var Kd_Hspk_Ssh3=$(this).val();

    if($('#Asal').val()==1){
    $.post('index.php?r=ajax/getssh4&Kd_Ssh1='+dataSH+'&Kd_Ssh2='+Kd_Hspk_Ssh2+'&Kd_Ssh3='+Kd_Hspk_Ssh3, function(data){
        
        $('#Kd_Hspk_Ssh4').html(data);
    })
    }else{
    $.post('index.php?r=ajax/gethspk4&Kd_Hspk1='+dataSH+'&Kd_Hspk2='+Kd_Hspk_Ssh2+'&Kd_Hspk3='+Kd_Hspk_Ssh3, function(data){
        $('#Kd_Hspk_Ssh4').html(data);
     })       
    }
})

// $('#Kd_Hspk_Ssh4').change(function(){
//     var Asal=$("#Asal").val();
//     var dataSH=$("#dataSH").val();
//     var Kd_Hspk_Ssh2=$("#Kd_Hspk_Ssh2").val();
//     var Kd_Hspk_Ssh3=$("#Kd_Hspk_Ssh3").val();
//     var Kd_Hspk_Ssh4=$(this).val();

//     if($('#Asal').val()==1){
//     $.post('index.php?r=ajax/getssh5&Kd_Ssh1='+dataSH+'&Kd_Ssh2='+Kd_Hspk_Ssh2+'&Kd_Ssh3='+Kd_Hspk_Ssh3+'&Kd_Ssh4='+Kd_Hspk_Ssh4, function(data){      
//         $('#Kd_Ssh5').html(data);
//     })
//     }else{
//         // alert("asdf")
//     $.post('index.php?r=ajax/gethargahspk&Kd_Hspk1='+dataSH+'&Kd_Hspk2='+Kd_Hspk_Ssh2+'&Kd_Hspk3='+Kd_Hspk_Ssh3+'&Kd_Hspk4='+Kd_Hspk_Ssh4, function(data){
//         alert(data);
//         $('#dataHarga').html(data);
//          })  
//     }
// })

$('#Kd_Hspk_Ssh4').change(function(){
    var Asal=$("#Asal").val();
    var dataSH=$("#dataSH").val();
    var Kd_Hspk_Ssh2=$("#Kd_Hspk_Ssh2").val();
    var Kd_Hspk_Ssh3=$("#Kd_Hspk_Ssh3").val();
    var Kd_Hspk_Ssh4=$(this).val();

    if($('#Asal').val()==1){
    $.post('index.php?r=ajax/getssh5&Kd_Ssh1='+dataSH+'&Kd_Ssh2='+Kd_Hspk_Ssh2+'&Kd_Ssh3='+Kd_Hspk_Ssh3+'&Kd_Ssh4='+Kd_Hspk_Ssh4, function(data){      
        $('#Kd_Ssh5').html(data);
    })
    }else{
     $.post('index.php?r=ajax/get-info-hspk-asb&Kd_Hspk1='+dataSH+
                                '&Kd_Hspk2='+Kd_Hspk_Ssh2+
                                '&Kd_Hspk3='+Kd_Hspk_Ssh3+
                                '&Kd_Hspk4='+Kd_Hspk_Ssh4, function(data){
        var hspk = data.split('|');
        $("#uraian").val(hspk[0]);
        $("#kdsatuan-ss").val(hspk[1]);
        $("#satuan").val(hspk[2]);
        $("#harga-ss").val(hspk[3]);
        $("#koefisien").val(0);
        $("#harga").val(0);
    })
    }
})



$('#Kd_Ssh5').change(function(){
    var Asal=$("#Asal").val();
    var dataSH=$("#dataSH").val();
    var Kd_Hspk_Ssh2=$("#Kd_Hspk_Ssh2").val();
    var Kd_Hspk_Ssh3=$("#Kd_Hspk_Ssh3").val();
    var Kd_Hspk_Ssh4=$("#Kd_Hspk_Ssh4").val();
    var Kd_Ssh5=$(this).val();

    if($('#Asal').val()==1){
    $.post('index.php?r=ajax/getssh6&Kd_Ssh1='+dataSH+'&Kd_Ssh2='+Kd_Hspk_Ssh2+'&Kd_Ssh3='+Kd_Hspk_Ssh3+'&Kd_Ssh4='+Kd_Hspk_Ssh4+'&Kd_Ssh5='+Kd_Ssh5, function(data){    
        $('#Kd_Ssh6').html(data);
    })
    }else{    
    }
})

  $('#Kd_Ssh6').change(function(){
    var Asal=$("#Asal").val();
    var dataSH=$("#dataSH").val();
    var Kd_Hspk_Ssh2=$("#Kd_Hspk_Ssh2").val();
    var Kd_Hspk_Ssh3=$("#Kd_Hspk_Ssh3").val();
    var Kd_Hspk_Ssh4=$("#Kd_Hspk_Ssh4").val();
    var Kd_Ssh5=$("#Kd_Ssh5").val();
    var Kd_Ssh6=$(this).val();

    if($('#Asal').val()==1){
    $.post('index.php?r=ajax/get-info-ssh-asb&Kd_Ssh1='+dataSH+
                                '&Kd_Ssh2='+Kd_Hspk_Ssh2+
                                '&Kd_Ssh3='+Kd_Hspk_Ssh3+
                                '&Kd_Ssh4='+Kd_Hspk_Ssh4+
                                '&Kd_Ssh5='+Kd_Ssh5+
                                '&Kd_Ssh6='+Kd_Ssh6, function(data){
        var ssh = data.split('|');
        $("#uraian").val(ssh[0]);
        $("#kdsatuan-ss").val(ssh[1]);
        $("#satuan").val(ssh[2]);
        $("#harga-ss").val(ssh[3]);
        $("#koefisien").val(0);
        $("#harga").val(0);
    })
    }else{    
    }
})



// $('#Kd_Ssh6').change(function(){
//     var Asal=$("#Asal").val();
//     var dataSH=$("#dataSH").val();
//     var Kd_Hspk_Ssh2=$("#Kd_Hspk_Ssh2").val();
//     var Kd_Hspk_Ssh3=$("#Kd_Hspk_Ssh3").val();
//     var Kd_Hspk_Ssh4=$("#Kd_Hspk_Ssh4").val();
//     var Kd_Ssh5=$("#Kd_Ssh5").val();
//     var Kd_Ssh6=$(this).val();

//     if($('#Asal').val()==1){
//     $.post('index.php?r=ajax/gethargassh&Kd_Ssh1='+dataSH+'&Kd_Ssh2='+Kd_Hspk_Ssh2+'&Kd_Ssh3='+Kd_Hspk_Ssh3+'&Kd_Ssh4='+Kd_Hspk_Ssh4+'&Kd_Ssh5='+Kd_Ssh5+'&Kd_Ssh6='+Kd_Ssh6, function(data){        
//         $('#dataHarga').html(data);
//     })
//     }else{    
//     }
// })


// $('#Kd_Ssh6').change(function(){
//     var Asal=$("#Asal").val();
//     var dataSH=$("#dataSH").val();
//     var Kd_Hspk_Ssh2=$("#Kd_Hspk_Ssh2").val();
//     var Kd_Hspk_Ssh3=$("#Kd_Hspk_Ssh3").val();
//     var Kd_Hspk_Ssh4=$("#Kd_Hspk_Ssh4").val();
//     var Kd_Ssh5=$("#Kd_Ssh5").val();
//     var Kd_Ssh6=$(this).val();

//     if($('#Asal').val()==1){
//     $.post('index.php?r=ajax/getsatuanssh&Kd_Ssh1='+dataSH+'&Kd_Ssh2='+Kd_Hspk_Ssh2+'&Kd_Ssh3='+Kd_Hspk_Ssh3+'&Kd_Ssh4='+Kd_Hspk_Ssh4+'&Kd_Ssh5='+Kd_Ssh5+'&Kd_Ssh6='+Kd_Ssh6, function(data){        
//         $('#dataKdsatuan').html(data);
//     })
//     }else{    
//     }
// })