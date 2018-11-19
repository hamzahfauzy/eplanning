
$('#Kd_Aset1').change(function(){
    var Kd_Aset1=$('#Kd_Aset1').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getaset2&Kd_Aset1='+Kd_Aset1, function(data){
        $('#Kd_Aset2').html(data);
    })
})
$('#Kd_Aset2').change(function(){
    var Kd_Aset1=$('#Kd_Aset1').val();
    var Kd_Aset2=$('#Kd_Aset2').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getaset3&Kd_Aset1='+Kd_Aset1+'&Kd_Aset2='+Kd_Aset2, function(data){
        $('#Kd_Aset3').html(data);
    })
})

$('#Kd_Aset3').change(function(){
    var Kd_Aset1=$('#Kd_Aset1').val();
    var Kd_Aset2=$('#Kd_Aset2').val();
    var Kd_Aset3=$('#Kd_Aset3').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getaset4&Kd_Aset1='+Kd_Aset1+'&Kd_Aset2='+Kd_Aset2+'&Kd_Aset3='+Kd_Aset3, function(data){
        $('#Kd_Aset4').html(data);
    })
})

$('#Kd_Aset4').change(function(){
    var Kd_Aset1=$('#Kd_Aset1').val();
    var Kd_Aset2=$('#Kd_Aset2').val();
    var Kd_Aset3=$('#Kd_Aset3').val();
    var Kd_Aset4=$('#Kd_Aset4').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getaset5&Kd_Aset1='+Kd_Aset1+'&Kd_Aset2='+Kd_Aset2+'&Kd_Aset3='+Kd_Aset3+'&Kd_Aset4='+Kd_Aset4, function(data){
        $('#Kd_Aset5').html(data);
    })
})




