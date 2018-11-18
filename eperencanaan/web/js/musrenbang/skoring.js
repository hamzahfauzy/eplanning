$("#btn-lihat").click(function(){
    $('#isi-wrap').html('<tr><td align="center" colspan="11"><h3 align="center">Mengambil data...</h3></td></tr>');
    $('.isi-cek').html('');
    //alert('index.php?r=musrenbang-kecamatan/get-usulan&'+$("#form_cari").serialize());
    $.ajax({ 
        type: "POST",
        url:'index.php?r=musrenbang-kecamatan/cek-usulan',
        data:$("#form_cari").serialize(),
        success: function(isi){
        	$('.isi-cek').html(isi);
        }
    });

	$.ajax({ 
        type: "POST",
        url:'index.php?r=musrenbang-kecamatan/get-usulan',
        data:$("#form_cari").serialize(),
        success: function(isi){
        	$('#isi-wrap').html(isi);
        }
    });
});

function lihatPrioritas(){
    $('#isi-wrap').html('<tr><td align="center" colspan="11"><h3 align="center">Mengambil data...</h3></td></tr>');

	$.ajax({ 
        type: "POST",
        url:'index.php?r=musrenbang-kecamatan/get-usulan-prioritas',
        data:$("#form_cari").serialize(),
        success: function(isi){
        	$('#isi-wrap').html(isi);
        }
    });
}


$("#kelurahan").change(function(){
    var Kd_Kel = $(this).val();
    $.ajax({ 
        type: "GET",
        url:'index.php?r=musrenbang-kecamatan/get-lingkungan',
        data:{Kd_Kel:Kd_Kel},
        success: function(isi){
          $("#lingkungan").html(isi);
        },
        error: function(){
          alert("failure");
        }
    });
});