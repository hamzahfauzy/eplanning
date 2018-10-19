$("#btn-lihat").click(function(){
	$('#isi-wrap').html('<tr><td align="center" colspan="11"><h3 align="center">Mengambil data...</h3></td></tr>');
	$.ajax({ 
        type: "POST",
        url:'index.php?r=musrenbang-kecamatan/get-tve315',
        data:$("#form_cari").serialize(),
        success: function(isi){
        	$('#isi-wrap').html(isi);
        },
        error: function(xhr, a, b){
          alert(xhr.responseText);
        }
    });
});
