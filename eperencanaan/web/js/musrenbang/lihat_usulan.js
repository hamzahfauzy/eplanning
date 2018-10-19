

$("#kecamatan").change(function(){
    var Kd_Kec = $(this).val();
    $.ajax({ 
        type: "GET",
        url:'index.php?r=dashboard/get-kelurahan',
        data:{Kd_Kec:Kd_Kec},
        success: function(isi){
          $("#kelurahan").html(isi);
        },
        error: function(){
          alert("failure");
        }
    });
});

$("#kelurahan").change(function(){
    var Kd_Kec = $("#kecamatan").val();
    var Kd_Kel = $(this).val();
    $.ajax({ 
        type: "GET",
        url:'index.php?r=dashboard/get-lingkungan',
        data:{Kd_Kec:Kd_Kec, Kd_Kel:Kd_Kel},
        success: function(isi){
          $("#lingkungan").html(isi);
        },
        error: function(){
          alert("failure");
        }
    });
});

$("#dapil").change(function(){
    var Kd_Dapil = $(this).val();
    $.ajax({ 
        type: "GET",
        url:'index.php?r=dashboard/get-user-dapil',
        data:{Kd_Dapil:Kd_Dapil},
        success: function(isi){
          $("#user-dapil").html(isi);
        },
        error: function(){
          alert("failure");
        }
    });
});

$("#btn-lihat-ling").click(function(){
	$('#isi-wrap').html('<h3 align="center">Mengambil data...</h3>');
	$.ajax({ 
        type: "POST",
        url:'index.php?r=dashboard/get-usulan-lingkungan2',
        data:$("#form_cari").serialize(),
        success: function(isi){
        	$('#isi-wrap').html(isi);
            $(window).resize();
        },
        error: function(){
          $('#isi-wrap').html('<h3 align="center">Maaf, Data tidak ditemukan...</h3>');
        }
    });
});

$("#btn-lihat-kel").click(function(){
    $('#isi-wrap').html('<h3 align="center">Mengambil data...</h3>');
    $.ajax({ 
        type: "POST",
        url:'index.php?r=dashboard/get-usulan-kelurahan',
        data:$("#form_cari").serialize(),
        success: function(isi){
            $('#isi-wrap').html(isi);
            $(window).resize();
        },
        error: function(){
          $('#isi-wrap').html('<h3 align="center">Maaf, Data tidak ditemukan...</h3>');
        }
    });
});

$("#btn-lihat-kec").click(function(){
    $('#isi-wrap').html('<h3 align="center">Mengambil data...</h3>');
    $.ajax({ 
        type: "POST",
        url:'index.php?r=dashboard/get-usulan-kecamatan',
        data:$("#form_cari").serialize(),
        success: function(isi){
            $('#isi-wrap').html(isi);
            $(window).resize();
        },
        error: function(){
          $('#isi-wrap').html('<h3 align="center">Maaf, Data tidak ditemukan...</h3>');
        }
    });
});

$("#btn-lihat-kec2").click(function(){
    $('#isi-wrap').html('<h3 align="center">Mencari data...</h3>');
    var Kd_Kec = $("#kecamatan").val();
    $.ajax({
        url  : "index.php?r=dashboard/get-usulan-kecamatan2",
        type : "GET",
        data : "Kd_Kec=" + Kd_Kec,
        success : function(data){
            $("#isi-wrap").html(data);
            $(window).resize();
        },
        error: function(){
          $('#isi-wrap').html('<h3 align="center">Maaf, Data tidak ditemukan...</h3>');
        }
    });
});

$("#btn-lihat-pokir").click(function(){
    if ($('#dapil').val()=='') {
        $('#isi-wrap').html('<h3 align="center">Masukkan daerah pemilihan</h3>');
        return 0;
    }
    $('#isi-wrap').html('<h3 align="center">Mengambil data...</h3>');
    $.ajax({ 
        type: "POST",
        url:'index.php?r=dashboard/get-usulan-pokir',
        data:$("#form_cari").serialize(),
        success: function(isi){
            $('#isi-wrap').html(isi);
            $(window).resize();
        },
        error: function(){
          $('#isi-wrap').html('<h3 align="center">Maaf, Data tidak ditemukan...</h3>');
        }
    });
});

$("#btn-lihat-laporan-renja").click(function(){
    if ($('#sub-unit').val()=='') {
        $('#isi-wrap').html('<h3 align="center">Masukkan sub unit</h3>');
        return 0;
    }
    $('#isi-wrap').html('<h3 align="center">Mengambil data...</h3>');
    $.ajax({ 
        type: "POST",
        url:'index.php?r=dashboard/get-laporan-renja',
        data:$("#form_cari").serialize(),
        success: function(isi){
            $('#isi-wrap').html(isi);
            $(window).resize();
        },
        error: function(){
          $('#isi-wrap').html('<h3 align="center">Maaf, Data tidak ditemukan...</h3>');
        }
    });
});


//Add by RG
$("#btn-lihat-laporan-renja-ranwal").click(function(){
    if ($('#sub-unit').val()=='') {
        $('#isi-wrap').html('<h3 align="center">Masukkan sub unit</h3>');
        return 0;
    }
    $('#isi-wrap').html('<h3 align="center">Mengambil data...</h3>');
    $.ajax({ 
        type: "POST",
        url:'index.php?r=dashboard/get-laporan-renja-ranwal',
        data:$("#form_cari").serialize(),
        success: function(isi){
            $('#isi-wrap').html(isi);
            $(window).resize();
        },
        error: function(){
          $('#isi-wrap').html('<h3 align="center">Maaf, Data tidak ditemukan...</h3>');
        } 
    });
});
//Batas
$(".lihat_file").click(function(){
  var alamat = $(this).data('url');
  //alert(alamat);
  $('#lihatFileModal').modal('show')
        .find('#isi_modal')
        .html("Loading...");

  $.ajax({ 
    type: "POST",
    url: alamat,
    data:'',
    success: function(isi){
      $('#lihatFileModal')
        .find('#isi_modal')
        .html(isi);
    },
    error: function(){
      alert("failure");
    }
  });
});