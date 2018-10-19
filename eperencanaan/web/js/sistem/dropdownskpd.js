$('#No_Misi').change(function(){
    var No_Misi=$('#No_Misi').val();
    //console.log(Kd_Aset4);
    alert("asdfa");
    $.post('index.php?r=ajax/gettujuan&Kd_Urusan='+Kd_Urusan+'&Kd_Bidang='+Kd_Bidang+ '&Kd_Unit='+Kd_Unit+'&Kd_Sub='+Kd_Sub+'&No_Misi='+No_Misi, function(data){
        $('#No_Tujuan').html(data);
    })
})
