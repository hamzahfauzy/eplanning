
$('#Kd_1').change(function(){
    var Kd_1=$('#Kd_1').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getstandard2&Kd_1='+Kd_1, function(data){
        $('#Kd_2').html(data);
    })
})





