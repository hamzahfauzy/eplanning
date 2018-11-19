$('#ajaxCrudModal').on('shown.bs.modal', function () {
  setTimeout(function(){


    $("#benua").change(function(){
       alert("Hai");
        var Kd_Benua = $(this).val();
        //alert("index.php?r=ajax/getkel"+"&Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec)
        /*$.ajax({
          url: "index.php?r=ajax/benua-sub",
          data: "Kd_Benua="+Kd_Benua,
          success: function(data) {
             
             $('#benua-sub').html(data);
          }
        });*/
    });
    //ajaxCrudModal
    $("#refjalan-kd_prov").change(function(){
        var Kd_Prov = $(this).val();
        //alert("index.php?r=ajax/getkab"+"&Kd_Prov="+Kd_Prov)
        $.ajax({
          url: "index.php?r=ajax/getkab",
          data: "Kd_Prov="+Kd_Prov,
          success: function(data) {
             $('#refjalan-kd_kab').html(data);
          }
        });
    });

    $("#refjalan-kd_kab").change(function(){
        var Kd_Prov = $("#refjalan-kd_prov").val();
        var Kd_Kab = $(this).val();
        //alert("index.php?r=ajax/getkec"+"&Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab)
        $.ajax({
          url: "index.php?r=ajax/getkec",
          data: "Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab,
          success: function(data) {
             $('#refjalan-kd_kec').html(data);
          }
        });
    });

    $("#refjalan-kd_kec").change(function(){
        var Kd_Prov = $("#refjalan-kd_prov").val();
        var Kd_Kab = $("#refjalan-kd_kab").val();
        var Kd_Kec = $(this).val();
        //alert("index.php?r=ajax/getkel"+"&Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec)
        $.ajax({
          url: "index.php?r=ajax/getkel",
          data: "Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec,
          success: function(data) {
             $('#refjalan-kd_urut_kel').html(data);
             $('#refjalan-kd_kel').val('');
          }
        });
    });


    $('#refjalan-kd_urut_kel').change(function(){
        var Kd_Prov = $("#refjalan-kd_prov").val();
        var Kd_Kab = $("#refjalan-kd_kab").val();
        var Kd_Kec = $("#refjalan-kd_kec").val();
        var Kd_Kel = $(this).val();
        //alert("index.php?r=ajax/getling"+"&Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel);
        $.ajax({
          url: "index.php?r=ajax/getling",
          data: "Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel,
          success: function(data) {
            $('#refjalan-kd_lingkungan').html(data);
          }
        });
        //alert('index.php?r=ajax/getkelkode'+"&Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel);
        $.ajax({
          url: "index.php?r=ajax/getkelkode",
          data: "Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel,
          success: function(dat) {
            $('#refjalan-kd_kel').val(dat);
          }
        });
    });
    /*
    $("#drop_ling").change(function(){
        var Kd_Kec = $('#drop_kec').val();
        var Kd_Kel = $('#drop_kel').val();
        var Kd_Ling = $(this).val();
        //alert("index.php?r=ajax/getusulan"+"&Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel+"&Kd_Ling="+Kd_Ling);
        $.ajax({
          url: "index.php?r=ajax/getusulan",
          data: "Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel+"&Kd_Ling="+Kd_Ling,
          success: function(data) {
            //alert(data);
            $("#isi_usulan").html(data);
          }
        });
    });
    */
    $("#Kd_Kec_Id").change(function(){
        var Kd_Prov = $("#Kd_Prov_Id").val();
        var Kd_Kab = $("#Kd_Kab_Id").val();
        var Kd_Kec = $(this).val();
        //alert("index.php?r=ajax/getkel"+"&Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec)
        $.ajax({
          url: "index.php?r=ajax/getkel",
          data: "Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec,
          success: function(data) {
             $('#Kd_Kel_Urut_Id').html(data);
             $('#Kd_Kel_Id').val('');
          }
        });
    });

    $('#Kd_Kel_Urut_Id').change(function(){
        var Kd_Prov = $("#Kd_Prov_Id").val();
        var Kd_Kab = $("#Kd_Kab_Id").val();
        var Kd_Kec = $("#Kd_Kec_Id").val();
        var Kd_Kel = $(this).val();
        //alert('index.php?r=ajax/getkelkode'+"&Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel);
        $.ajax({
          url: "index.php?r=ajax/getkelkode",
          data: "Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec+"&Kd_Kel="+Kd_Kel,
          success: function(dat) {
            $('#Kd_Kel_Id').val(dat);
          }
        });
    });
  }, 100);
});


$('#Kd_Rek_1').change(function(){
    var Kd_Rek_1=$('#Kd_Rek_1').val();
    $.post('index.php?r=ajax/getrek2&Kd_Rek_1='+Kd_Rek_1, function(data){
        $('#Kd_Rek_2').html(data);
    })
})


$('#Kd_Urusan').change(function(){
    var Kd_Urusan=$('#Kd_Urusan').val();
    $.post('index.php?r=ajax/getbidang&Kd_Urusan='+Kd_Urusan, function(data){
        $('#Kd_Bidang').html(data);
    })
})

$('#Kd_Bidang').change(function(){
    var Kd_Urusan=$('#Kd_Urusan').val();
    var Kd_Bidang=$('#Kd_Bidang').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getunit&Kd_Urusan='+Kd_Urusan+'&Kd_Bidang='+Kd_Bidang, function(data){
        $('#Kd_Unit').html(data);
    })
})

$('#Kd_Unit').change(function(){
    var Kd_Urusan=$('#Kd_Urusan').val();
    var Kd_Bidang=$('#Kd_Bidang').val();
    var Kd_Unit=$('#Kd_Unit').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getsubunit&Kd_Urusan='+Kd_Urusan+'&Kd_Bidang='+Kd_Bidang+ '&Kd_Unit='+Kd_Unit , function(data){
        $('#Kd_Sub').html(data);
    })
})

$('#Kd_Sub').change(function(){
    var Kd_Urusan=$('#Kd_Urusan').val();
    var Kd_Bidang=$('#Kd_Bidang').val();
    var Kd_Unit=$('#Kd_Unit').val();
    var Kd_Sub=$('#Kd_Sub').val();

    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getmisi&Kd_Urusan='+Kd_Urusan+'&Kd_Bidang='+Kd_Bidang+ '&Kd_Unit='+Kd_Unit+'&Kd_Sub='+Kd_Sub , function(data){
        $('#No_Misi').html(data);
    })
})


$('#No_Misi').change(function(){
    var Kd_Urusan=$('#Kd_Urusan').val();
    var Kd_Bidang=$('#Kd_Bidang').val();
    var Kd_Unit=$('#Kd_Unit').val();
    var Kd_Sub=$('#Kd_Sub').val();
    var No_Misi=$('#No_Misi').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/gettujuan&Kd_Urusan='+Kd_Urusan+'&Kd_Bidang='+Kd_Bidang+ '&Kd_Unit='+Kd_Unit+'&Kd_Sub='+Kd_Sub+'&No_Misi='+No_Misi, function(data){
        $('#No_Tujuan').html(data);
    })
})


$('#dataMisi').change(function(){
    var Kd_Urusan=$('#Kd_Urusan').val();
    var Kd_Bidang=$('#Kd_Bidang').val();
    var Kd_Unit=$('#Kd_Unit').val();
    var Kd_Sub=$('#Kd_Sub').val();
    var No_Misi=$('#No_Misi').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/gettujuan&Kd_Urusan='+Kd_Urusan+'&Kd_Bidang='+Kd_Bidang+ '&Kd_Unit='+Kd_Unit+'&Kd_Sub='+Kd_Sub+'&No_Misi='+No_Misi, function(data){
        $('#No_Tujuan').html(data);
    })
})


$('#Kd_Bidang_Prog').change(function(){
    var Kd_Urusan=$('#Kd_Urusan').val();
    var Kd_Bidang=$('#Kd_Bidang_Prog').val();
    //console.log(Kd_Aset4);
    $.post('index.php?r=ajax/getprog&Kd_Urusan='+Kd_Urusan+'&Kd_Bidang='+Kd_Bidang, function(data){
        $('#Kd_Prog').html(data);
    })
})


$('#Kd_Analisa').change(function(){  
    var Kd_Analisa=$('#Kd_Analisa').val();
    $.post('index.php?r=ajax/getanalisasub&Kd_Analisa='+Kd_Analisa, function(data){
      
        $('#Kd_Analisa_Sub').html(data);
    })
})


$('#Kd_Prov').change(function(){
    
    var Kd_Prov=$('#Kd_Prov').val();
    $.post('index.php?r=ajax/getkab&Kd_Prov='+Kd_Prov, function(data){
    $('#Kd_Kab').html(data);
   })
})



