function get_usulan(){
  var Kd_Lingkungan = $('#select-lingkungan').val();
  var Kd_Pem = $('#select-bidpem').val();
  var Nm_Permasalahan = $('#cari-permasalahan').val();
  var Jenis_Usulan = $('#cari-usulan').val();
  //alert('index.php?r=ta-musrenbang-kelurahan%2Fget-usulan');
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-musrenbang-kelurahan%2Fget-usulan',
    data:{Kd_Lingkungan : Kd_Lingkungan, Kd_Pem : Kd_Pem, Nm_Permasalahan : Nm_Permasalahan, Jenis_Usulan : Jenis_Usulan},
    success: function(isi){
      $("#body-tabel").html(isi);
    },
    error: function(){
      alert("failure1");
    }
  });
}

function get_usulan_pilih(){
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-musrenbang-kelurahan/get-cookie-usulan',
    data:'',
    success: function(isi){
      $("#usulan_terpilih").html(isi);
      setTimeout(function(){
        var tot=$("#total_jumlah").html();
        $("#jumlah").val(tot);

        var harga = $("#harga").val();
        var harga_total = tot*harga;
        $("#total").val(harga_total);

        //alert(tot);
      }, 1000);
    },
    error: function(){
      alert("Tidak ada usulan terpilih");
    }
  });
}

function sisa_usulan(){
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-musrenbang-kelurahan/sisa-usulan',
    data:'',
    success: function(isi){
      //alert(isi);
      $("#sisa-usulan").html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
}
/*
function jlh_usulan_sisa(){
  //alert('index.php?r=ta-musrenbang-kelurahan/sisa-usulan');
  $.ajax({ 
    type: "GET",
    url:'index.php?r=ta-musrenbang-kelurahan/sisa-usulan',
    data:'',
    success: function(isi){
      //alert(isi);
    },
    error: function(){
      alert("failure");
    }
  });
}

jlh_usulan_sisa();
*/
/*
$("#select-lingkungan").change(function(){
  get_usulan();
});
*/

$("#btn-cari-usulan").click(function(){
  get_usulan();
});

get_usulan_pilih();
sisa_usulan();