
    $('#No_Misi').change(function(){
        var No_Misi=$(this).val();
        $.post('index.php?r=ta-rpjmd-program-prioritas/get-tujuan&No_Misi='+No_Misi, function(data){
            //alert(data);
            $('#No_Tujuan').html(data);
        })
    })

    $('#No_Tujuan').change(function(){
        var No_Misi=$('#No_Misi').val();
        var No_Tujuan=$(this).val();
        $.post('index.php?r=ta-rpjmd-program-prioritas/get-sasaran&No_Misi='+No_Misi+'&No_Tujuan='+No_Tujuan, function(data){
            //alert(data);
            $('#No_Sasaran').html(data);
        })
    })

    $(".selects").select2({
      allowClear: true
    });