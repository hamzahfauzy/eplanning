
$('#dataUrusan').change(function(){
    var dataUrusan=$(this).val();

    $.post('index.php?r=ajax/getbidangprog&Kd_Urusan='+dataUrusan, function(data){

        $('#Kd_Bidang').html(data);
    })
})

/*
$('#Kd_Bidang').change(function(){

    var dataUrusan=$("#dataUrusan").val();
    var Kd_Bidang=$(this).val();


    $.post('index.php?r=ajax/getrefprog&Kd_Urusan='+dataUrusan+'&Kd_Bidang='+Kd_Bidang, function(data){

        $('#Ket_Prog').html(data);
    })
})
*/


$('#Kd_Bidang').change(function(){
    var dataUrusan=$("#dataUrusan").val();
    var Kd_Bidang=$(this).val();


     $.post('index.php?r=ajax/getunitprog&Kd_Urusan='+dataUrusan+'&Kd_Bidang='+Kd_Bidang, function(data){

         $('#Kd_Unit').html(data);
     })
 })

/*
$('#dataUrusan1').change(function(){
    var dataUrusan=$(this).val();

    $.post('index.php?r=ajax/getbidangprog&Kd_Urusan='+dataUrusan, function(data){

        $('#Kd_Bidang1').html(data);
    })
})


$('#Kd_Bidang').change(function(){

    var dataUrusan=$("#dataUrusan").val();
    var Kd_Bidang=$(this).val();


    $.post('index.php?r=ajax/getunitprog&Kd_Urusan='+dataUrusan+'&Kd_Bidang='+Kd_Bidang, function(data){

        $('#Kd_Unit').html(data);
    })
})

*/

$('#Kd_Unit').change(function(){
    var dataUrusan=$("#dataUrusan").val();
    var Kd_Bidang=$("#Kd_Bidang").val();
    var Kd_Unit=$(this).val();


    $.post('index.php?r=ajax/getsubprog&Kd_Urusan='+dataUrusan+'&Kd_Bidang='+Kd_Bidang+'&Kd_Unit='+Kd_Unit, function(data){

        $('#Kd_Sub').html(data);
    })
})

$('#Kd_Sub').change(function(){
    var dataUrusan=$("#dataUrusan").val();
    var Kd_Bidang=$("#Kd_Bidang").val();
	var Kd_Unit=$("#Kd_Unit").val();
    var Kd_Sub=$(this).val();


    $.post('index.php?r=ajax/getrefprog1&Kd_Urusan='+dataUrusan+'&Kd_Bidang='+Kd_Bidang+'&Kd_Unit='+Kd_Unit+'&Kd_Sub_Unit='+Kd_Sub, function(data){

        $('#Ket_Prog').html(data);
    })
})

$('#Ket_Prog').change(function(){

    var ket=$("#Ket_Prog option:selected").text();
    //$('#ket_prg').val("");
     $('#ket_prg').val(ket);


})