$('#Kd_Sub').change(function(){
    var Kd_Sub=$('#Kd_Sub').val();
    alert("adfadfa");

})


// $('#Kd_Unit').change(function(){
//     var Kd_Unit=$('#Kd_Unit').val();

//     //console.log(Kd_Aset4);
//     $.post('index.php?r=ajax/getsubunit&Kd_Unit='+Kd_Unit, function(data){
//         $('#Kd_Sub').html(data);
//     })
// })


// $('#Kd_Sub').change(function(){
//     var Kd_Unit=$('#Kd_Unit').val();
//      var Kd_Sub=$('#Kd_Sub').val();
     
//     //console.log(Kd_Aset4);
//     $.post('index.php?r=ajax/getbidangsub&Kd_Unit='+Kd_Unit+ '&Kd_Sub='+Kd_Sub , function(data){  
//        $('#Kd_Bidang').html(data);
//     })
// })


// $('#Kd_Asal').change(function(){

//     var Kd_Asal=$(this).val();
//     if($('#Kd_Asal').val()==1){
//      $.post('index.php?r=ajax/getssh&Kd_Asal='+Kd_Asal,
//     function(data){ 
//      $('#dataSH').html(data);
//     })

//     }if($('#Kd_Asal').val()==2){
//     $.post('index.php?r=ajax/gethspk&Kd_Asal='+Kd_Asal,
//     function(data){ 
//      $('#dataSH').html(data);
//     })

//     }else{
//      $.post('index.php?r=ajax/getasb&Kd_Asal='+Kd_Asal,
//      function(data){  
//         $('#dataSH').html(data);
//     })

//     }
// })