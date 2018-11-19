$('#ajaxCrudModal').on('shown.bs.modal', function () {
  setTimeout(function(){


    $("#benua").change(function(){
       //alert("Hai");
        var Kd_Benua = $(this).val();
        //alert("index.php?r=ajax/getkel"+"&Kd_Prov="+Kd_Prov+"&Kd_Kab="+Kd_Kab+"&Kd_Kec="+Kd_Kec)
        $.ajax({
          url: "index.php?r=ajax/benua-sub&Kd_Benua=0",
          data: {value: Kd_Benua},
          type: "POST",
          success: function(data) {
             
             $('#benua-sub').html(data);
          }
        });
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