
  /*
  $("#Kd_Hspk3").change(function(){
    var Kd_Hspk1 = $("#Kd_Hspk1").val();
    var Kd_Hspk2 = $("#Kd_Hspk2").val();
    var Kd_Hspk3 = $("#Kd_Hspk3").val();

    $("#Kd_Hspk4").val(Kd_Hspk1+Kd_Hspk2+Kd_Hspk3);
  });
  */
  $("#Kd_Hspk3").change(function(){
    var Kd_Hspk1 = $("#Kd_Hspk1").val();
    var Kd_Hspk2 = $("#Kd_Hspk2").val();
    var Kd_Hspk3 = $("#Kd_Hspk3").val();

    // var Kd_Hspk4 = $("#Kd_Hspk4").val();

    $.ajax({ 
      type: "GET",
      url:'index.php?r=ref-hspk/get-nomor',
     // data:{Kd_Hspk1:Kd_Hspk1, Kd_Hspk2:Kd_Hspk2, Kd_Hspk3:Kd_Hspk3, Kode1:<?= $model->Kd_Hspk1.$model->Kd_Hspk2.$model->Kd_Hspk3 ?>, Kode2:<?= $model->Kd_Hspk4 ?>},
     // data:{Kd_Hspk1:Kd_Hspk1, Kd_Hspk2:Kd_Hspk2, Kd_Hspk3:Kd_Hspk3, Kode1:Kd_Hspk1+''+Kd_Hspk2+''+Kd_Hspk3, Kode2:Kd_Hspk4},
      data:{Kd_Hspk1:Kd_Hspk1, Kd_Hspk2:Kd_Hspk2, Kd_Hspk3:Kd_Hspk3},
      success: function(isi){
        $("#Kd_Hspk4").val(isi);
      },
      error: function(){
        alert("failure3");
      }
    });
  });

  $('#Kd_Ssh6').change(function(){
    var Kd_Ssh1=$("#Kd_Ssh1").val();
    var Kd_Ssh2=$("#Kd_Ssh2").val();
    var Kd_Ssh3=$("#Kd_Ssh3").val();
    var Kd_Ssh4=$("#Kd_Ssh4").val();
    var Kd_Ssh5=$("#Kd_Ssh5").val();
    var Kd_Ssh6=$(this).val();
    $.post('index.php?r=ajax/get-info-ssh6&Kd_Ssh1='+Kd_Ssh1+
                                    '&Kd_Ssh2='+Kd_Ssh2+
                                    '&Kd_Ssh3='+Kd_Ssh3+
                                    '&Kd_Ssh4='+Kd_Ssh4+
                                    '&Kd_Ssh5='+Kd_Ssh5+
                                    '&Kd_Ssh6='+Kd_Ssh6, function(data){
        var ssh = data.split('|');
        $("#uraian-ssh").val(ssh[0]);
        $("#kdsatuan-ssh").val(ssh[1]);
        $("#satuan-ssh").val(ssh[2]);
        $("#harga-ssh").val(ssh[3]);
        $("#koefisien").val(0);
        $("#harga").val(0);
    })
  })

  $("#koefisien").keyup(function(){
    var harga_ssh = parseFloat($("#harga-ssh").val());
    var koefisien = parseFloat($("#koefisien").val()); 

    var harga = harga_ssh*koefisien;
    $("#harga").val(harga); 
  });
  //harga-ssh
  //koefisien
  //harga
  //$("#wrap-ssh").html('isi');
  function get_ssh(){
    $.ajax({ 
      type: "GET",
      url: 'index.php?r=ref-hspk/get-cookie',
      data: '',
      success: function(isi){
        $("#wrap-ssh").html(isi);
        var jumlah_hspk=$("#jumlah_hspk").html();
        $("#harga_hspk").val(jumlah_hspk);
      },
      error: function(){
        alert("Belum ada SSH Terpilih");
      }
    });
  }
  get_ssh();

  $("#btn-tambah-ssh").click(function(){
    //alert('index.php?r=ref-hspk/set-cookie');
    $.ajax({ 
      type: "POST",
      url:'index.php?r=ref-hspk/set-cookie',
      data:$("#w0").serialize(),
      success: function(isi){
        alert(isi);
        get_ssh();
      },
      error: function(){
        alert("failure1");
      }
    });
  });