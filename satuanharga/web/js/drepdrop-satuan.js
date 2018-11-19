$('#Kd_Ssh1').change(function(){
    var Kd_Ssh1=$(this).val();

   
    $.post('index.php?r=ajax/getssh2&Kd_Ssh1='+Kd_Ssh1, function(data){
        //alert(data);
        $('#Kd_Ssh2').html(data);
    })
})

$('#Kd_Ssh2').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$(this).val();
    $.post('index.php?r=ajax/getssh3&Kd_Ssh1='+Kd_Ssh1+'&Kd_Ssh2='+Kd_Ssh2, function(data){
        $('#Kd_Ssh3').html(data);
    })
})

$('#Kd_Ssh3').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$("#Kd_Ssh2").val();
    var Kd_Ssh3=$(this).val();
    $.post('index.php?r=ajax/getssh4&Kd_Ssh1='+Kd_Ssh1+
                                    '&Kd_Ssh2='+Kd_Ssh2+
                                    '&Kd_Ssh3='+Kd_Ssh3, function(data){
        $('#Kd_Ssh4').html(data);
    })
})

$('#Kd_Ssh4').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$("#Kd_Ssh2").val();
    var Kd_Ssh3=$("#Kd_Ssh3").val();
    var Kd_Ssh4=$(this).val();
    $.post('index.php?r=ajax/getssh5&Kd_Ssh1='+Kd_Ssh1+
                                    '&Kd_Ssh2='+Kd_Ssh2+
                                    '&Kd_Ssh3='+Kd_Ssh3+
                                    '&Kd_Ssh4='+Kd_Ssh4, function(data){
        $('#Kd_Ssh5').html(data);
    })
})

$('#Kd_Ssh5').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$("#Kd_Ssh2").val();
    var Kd_Ssh3=$("#Kd_Ssh3").val();
    var Kd_Ssh4=$("#Kd_Ssh4").val();
    var Kd_Ssh5=$(this).val();

    $.post('index.php?r=ajax/getssh6&Kd_Ssh1='+Kd_Ssh1+
                                    '&Kd_Ssh2='+Kd_Ssh2+
                                    '&Kd_Ssh3='+Kd_Ssh3+
                                    '&Kd_Ssh4='+Kd_Ssh4+
                                    '&Kd_Ssh5='+Kd_Ssh5, function(data){
        $('#Kd_Ssh6').html(data);
    })
})
/*
$('#Kd_Ssh6').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$("#Kd_Ssh2").val();
    var Kd_Ssh3=$("#Kd_Ssh3").val();
    var Kd_Ssh4=$("#Kd_Ssh4").val();
    var Kd_Ssh5=$("#Kd_Ssh5").val();
    var Kd_Ssh6=$(this).val();
    $.post('index.php?r=ajax/get-info-ssh6&Kd_Ssh1='+Kd_Ssh1+
                                    '&Kd_Ssh2='+Kd_Ssh2+
                                    '&Kd_Ssh3='+Kd_Ssh3+
                                    '&Kd_Ssh4='+Kd_Ssh4+
                                    '&Kd_Ssh5='+Kd_Ssh5+
                                    '&Kd_Ssh6='+Kd_Ssh6, function(data){
        alert(data);
    })
})
*/
$('#Kd_Hspk1').change(function(){
    var Kd_Hspk1=$(this).val();
    //alert(Kd_Urusan);
    $.post('index.php?r=ajax/gethspk2&Kd_Hspk1='+Kd_Hspk1, function(data){
        //alert(data);
        $('#Kd_Hspk2').html(data);
    })
})

$('#Kd_Hspk2').change(function(){
    var Kd_Hspk1=$("#Kd_Hspk1").val();
    var Kd_Hspk2=$(this).val();

    $.post('index.php?r=ajax/gethspk3&Kd_Hspk1='+Kd_Hspk1+'&Kd_Hspk2='+Kd_Hspk2, function(data){
        $('#Kd_Hspk3').html(data);
    })
})

/*
$('#Kd_Hspk2').change(function(){
    var Kd_Hspk1=$("#Kd_Hspk1").val();
    var Kd_Hspk2=$(this).val();

    $.post('index.php?r=ajax/get-nomor-hspk3&Kd_Hspk1='+Kd_Hspk1+'&Kd_Hspk2='+Kd_Hspk2, function(data){
        $('#Kd_Hspk3').val(data);
    })
})
*/
//ASB
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

// ========================== ASET ============================

$('#Kd_Aset1').change(function(){
    var Kd_Aset1=$(this).val();
    $.post('index.php?r=ajax/getaset2&Kd_Aset1='+Kd_Aset1, function(data){
        $('#Kd_Aset2').html(data);
    })
})

$('#Kd_Aset2').change(function(){
    var Kd_Aset1=$("#Kd_Aset1").val();
    var Kd_Aset2=$(this).val();
    $.post('index.php?r=ajax/getaset3&Kd_Aset1='+Kd_Aset1+'&Kd_Aset2='+Kd_Aset2, function(data){
        $('#Kd_Aset3').html(data);
    })
})
