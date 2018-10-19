$('#Kd_Urusan').change(function(){
    var Kd_Urusan=$(this).val();
    //alert(Kd_Urusan);
    $.post('index.php?r=ajax/getbidang&Kd_Urusan='+Kd_Urusan, function(data){
        //alert(data);
        $('#Kd_Bidang').html(data);
    })
})

$('#Kd_Bidang').change(function(){
    var Kd_Bidang=$(this).val();
    var Kd_Urusan=$("#Kd_Urusan").val();
    //alert(kode);
    $.post('index.php?r=ajax/getprogram&Kd_Bidang='+Kd_Bidang+'&Kd_Urusan='+Kd_Urusan, function(data){
        //alert(data);
        $('#Kd_Prog').html(data);
    })
})

$('#Kd_Prog').change(function(){
    var Kd_Prog=$(this).val();
    var Kd_Bidang=$("#Kd_Bidang").val();
    var Kd_Urusan=$("#Kd_Urusan").val();
    //alert(Kd_Prog+Kd_Bidang+Kd_Urusan);
    //alert('index.php?r=ajax/getkegiatan&Kd_Prog='+Kd_Prog+'Kd_Bidang='+Kd_Bidang+'&Kd_Urusan='+Kd_Urusan);
    $.post('index.php?r=ajax/getkegiatan&Kd_Prog='+Kd_Prog+'&Kd_Bidang='+Kd_Bidang+'&Kd_Urusan='+Kd_Urusan, function(data){
        //alert(data);
        $('#Kd_Keg').html(data);
    })
})

$('#Kd_Keg').change(function(){
    var Kd_Keg=$(this).val();
    var Kd_Prog=$("#Kd_Prog").val();
    var Kd_Bidang=$("#Kd_Bidang").val();
    var Kd_Urusan=$("#Kd_Urusan").val();
    //alert(Kd_Keg+Kd_Prog+Kd_Bidang+Kd_Urusan);
    //alert('index.php?r=ajax/getjenisusulan&Kd_Keg='+Kd_Keg+'&Kd_Prog='+Kd_Prog+'&Kd_Bidang='+Kd_Bidang+'&Kd_Urusan='+Kd_Urusan);
    $.post('index.php?r=ajax/getjenisusulan&Kd_Keg='+Kd_Keg+'&Kd_Prog='+Kd_Prog+'&Kd_Bidang='+Kd_Bidang+'&Kd_Urusan='+Kd_Urusan, function(data){
        //alert(data);
        $('#Kd_Klasifikasi').html(data);
    })
})

