
$('#dapil').change(function(){
    var dapil=$(this).val();

    $.post('index.php?r=ajax/getuserdapil&Kd_Dapil='+dapil, function(data){

        $('#Kd_Dewan').html(data);
    })
})
