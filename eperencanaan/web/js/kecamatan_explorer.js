$(".kel").click(function(){
    var kel = $(this).data('kel');
    var urut = $(this).data('urut');

    $("#usulan-kelurahan").html('Loading...');
    $("#list-pj").html('Loading...');
    $("#list-lingkungan").html('Loading...');

    $.ajax({
        type: "GET",
        url: "index.php?r=ta-musrenbang-kecamatan-explorer/get-usulan-kelurahan",
        data: {kel:kel, urut:urut},
        success: function (isi) {
            $("#usulan-kelurahan").html(isi);
        },
        error: function(){
          alert("gagal download usulan kelurahan");
        }
    });

    $.ajax({
        type: "GET",
        url: "index.php?r=ta-musrenbang-kecamatan-explorer/get-lingkungan",
        data: {kel:kel, urut:urut},
        success: function (isi) {
            $("#list-lingkungan").html(isi);
        },
        error: function(){
          alert("gagal download list lingkungan");
        }
    });

    $.ajax({
        type: "GET",
        url : "index.php?r=ta-musrenbang-kecamatan-explorer/get-pj",
        data: {kel:kel, urut:urut},
        success: function (data) {
            $("#list-pj").html(data);

        }
    });
});


    // $.ajax({
    //     type: "GET",
    //     url: "index.php?r=ta-musrenbang-kecamatan-explorer/get-usulan-verifikasi",
    //     data: {kel:kel, urut:urut},
    //     success: function (isi) {
    //         $("#list-verifikasi").html(isi);
    //     }
    // });


$(".kel").click(function(){
    $.ajax({
        type: "GET",
        url: "index.php?r=ta-musrenbang-kecamatan-explorer/get-usulan-verifikasi",
        data: {kel:kel, urut:urut},
        success: function (isi) {
            $("#list-verifikasi").html(isi);
        }
    });
});



//===========Fungsi Tampilan============//
$(".kel-col").click(function(){
    $(".kel-col").removeClass("active");
    $(this).addClass("active");
});

function load_acara(){
  $("#list-kelurahan-acara").html('Loading...');
  $.ajax({ 
    type: "GET",
    url: "index.php?r=ta-musrenbang-kecamatan-explorer/get-kelurahan-acara",
    data:'',
    success: function(isi){
      $("#list-kelurahan-acara").html(isi);
    },
    error: function(){
      alert("gagal download kelurahan acara");
      $("#list-kelurahan-acara").html('');
    }
  });
}

load_acara();
